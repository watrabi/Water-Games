<?php
require_once '../base/conn.php';

// Retrieve messages from the database based on the sender and recipient
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sender = $_GET['sender'];
    $recipient = $_GET['recipient'];

    try {
        $sql = "SELECT * FROM messages WHERE (sender = :sender AND recipient = :recipient) OR (sender = :recipient AND recipient = :sender) ORDER BY id ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':sender', $sender);
        $stmt->bindParam(':recipient', $recipient);
        $stmt->execute();

        $messages = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = [
                'id' => $row['id'],
                'sender' => $row['sender'],
                'recipient' => $row['recipient'],
                'message' => $row['message']
            ];
        }

        // Return the messages as a JSON response
        header('Content-Type: application/json');
        echo json_encode($messages);
    } catch (PDOException $e) {
        // Handle database errors
        http_response_code(500);
        echo json_encode(['error' => 'Database error occurred']);
    }
}
// Insert a message into the database
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];


    try {
        $sql = "INSERT INTO messages (sender, recipient, message) VALUES (:sender, :recipient, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':sender', $sender);
        $stmt->bindParam(':recipient', $recipient);
        $stmt->bindParam(':message', $message);
        $stmt->execute();
        
        $messageId = $pdo->lastInsertId(); // Get the ID of the inserted message

        // Return the message ID as a JSON response
        header('Content-Type: application/json');
        echo json_encode(['id' => $messageId]);
    } catch (PDOException $e) {
        // Handle database errors
        http_response_code(500);
        echo json_encode(['error' => 'Database error occurred']);
    }
}

// Close the database connection
$conn = null;
?>
