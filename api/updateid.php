<?php

// Database connection settings
$host = 'localhost';
$dbname = 'wathdgames';
$user = 'wathdgames';
$password = 'jxXxMPDnaNZDijH6';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set the starting ID
    $startId = 1; // Change this to your desired starting ID

    // Fetch all records from the table starting from the specified ID
    $stmt = $pdo->prepare("SELECT id FROM accounts WHERE id >= :start_id");
    $stmt->bindParam(':start_id', $startId, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through the records and update the IDs
    foreach ($rows as $row) {
        $currentId = $row['id'];
        $newId = $startId;

        // Update the ID in the database
        $updateStmt = $pdo->prepare("UPDATE accounts SET id = :new_id WHERE id = :current_id");
        $updateStmt->bindParam(':new_id', $newId, PDO::PARAM_INT);
        $updateStmt->bindParam(':current_id', $currentId, PDO::PARAM_INT);
        $updateStmt->execute();

        // Increment the start ID for the next iteration
        $startId++;
    }

    echo "IDs fixed successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
