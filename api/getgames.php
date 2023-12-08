<?php
header('Content-Type: application/json; charset=utf-8');
include_once("../base/conn.php");
// Pagination parameters
$currentPage = $_GET['page'] ?? 1; // Current page number
$itemsPerPage = 6; // Number of games to display per page

// Fetch games for the current page
$query = 'SELECT SQL_CALC_FOUND_ROWS id, name, plays, icon FROM games LIMIT :offset, :limit';
$offset = ($currentPage - 1) * $itemsPerPage;

try {
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count total number of games
    $stmt = $pdo->query('SELECT FOUND_ROWS()');
    $totalGames = $stmt->fetchColumn();

    // Modify the icon URL to use /assets/img/file.png format
    foreach ($games as &$game) {
        $game['icon'] = !empty($game['icon']) ? '/assets/img/' . $game['icon'] : '/assets/img/default-icon.png'; // Provide a default icon URL if the icon field is empty
    }

    $response = array(
        'games' => $games,
        'totalGames' => $totalGames
    );

    // Encode the response as JSON
    $json = json_encode($response);
    echo $json;
} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}
