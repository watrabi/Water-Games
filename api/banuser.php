<?php

    if(isset($_POST["userid"])){
        $userid = $_POST["userid"];
        $reason = $_POST["reason"];
        $content = $_POST["offsensivecontent"];
        $type = $_POST["type"];
        include("../base/conn.php");
        
        $uscid = $_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];

        $stmt = $pdo->prepare('SELECT id, username, email, theme, role, verified FROM accounts WHERE uscid=? ');
        $stmt->execute([$uscid]);
    
        foreach ($stmt as $row) {
            $id = $row["id"]; // returns the current users id
        }
        
        $query = "INSERT INTO bans ( userid, modid, reason, content, type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userid, $id, $reason, $content, $type]);
        header("Location: /admin/banuser");
    }