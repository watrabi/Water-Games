<?php

function checkpfp($id) {
    
    $pfp = $_SERVER['DOCUMENT_ROOT'] . "/assets/uspfp/" . $id . ".png";

if(file_exists($pfp)){
    echo '<img src="/assets/uspfp/' . $id . '.png" width="100" height="100" class="pfp">';
}
else {
    echo '<img src="/assets/img/defaultuser.png" width="100" height="100" class="pfp">';
}
}

function checkpfpreturnedition($id) {
    
    $pfp = $_SERVER['DOCUMENT_ROOT'] . "/assets/uspfp/" . $id . ".png";

if(file_exists($pfp)){
    return '<img src="/assets/uspfp/' . $id . '.png" width="100" height="100" class="pfp">';
}
else {
    return '<img src="/assets/img/defaultuser.png" width="100" height="100" class="pfp">';
}
}

function filterInput($input) {
    // Whitelist pattern: alphanumeric characters, space, underscore, dot, Unicode characters
    $pattern = '/[^\p{L}\p{N}\s_\-.]/u';
    
    // Remove special characters from the input
    $filteredInput = preg_replace($pattern, '', $input);
    
    return $filteredInput;
}


function getid($username) {
    include("conn.php");
    
    $stmt = $pdo->prepare('SELECT id FROM accounts WHERE username=? ');
    $stmt->execute([$username]);
    
    foreach ($stmt as $row) {
    
        $id = $row["id"];
    
    }
    return $id;
}

function getpfpurl($username) {
    include("conn.php");
    
    $stmt = $pdo->prepare('SELECT pfp_url FROM accounts WHERE username = ?');
    $stmt->execute([$username]);
    
    $row = $stmt->fetch();
    $pfpUrl = $row["pfp_url"];
    
    return $pfpUrl;
}
