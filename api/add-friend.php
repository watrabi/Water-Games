<?php

            include("../base/conn.php");
            
            $uscid = $_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];
            
            $stmt = $pdo->prepare('SELECT id, username, uscid FROM accounts WHERE uscid=?');
            $stmt->execute([$uscid]);
    
            foreach ($stmt as $row) {
                $id = $row["id"];
                $username = $row["username"];
            }
            
            $friendid = $_GET["id"];
            
            $stmt = $pdo->prepare('SELECT * FROM friends WHERE sender=? AND reciever=? AND (accepted=0 OR accepted=1)');
            $stmt->execute([$id, $friendid]);
    
            if ($stmt->rowCount() > 0) {
                die("You are already friends with this person or you have already sent a request that is pending!!");
            }
            else {
                $query = "INSERT INTO friends (sender, reciever) VALUES (?, ? )";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$id, $friendid]);
                header("Location: /profile/$friendid");
            }
            
            
            
        