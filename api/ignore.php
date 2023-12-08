<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            if(isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
            include("../base/conn.php");
            
            $uscid = $_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];
            $id = $_GET["banid"];
            
            $ignored = 1;
            $query = "UPDATE bans SET ignored=? WHERE id=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$ignored, $id]);
            
            header("Location: /home");
            }
    
            else {
                echo "please login!";
            
        }
    }
    else {
                echo "why are you here";
            }