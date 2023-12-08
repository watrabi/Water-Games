<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["theme"] !== NULL){
            if(isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
            include("../base/conn.php");
            
            $uscid = $_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];
            
            $query = "UPDATE accounts SET theme=? WHERE uscid=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$_POST["theme"], $uscid]);
            
            header("Location: /settings");
            }
    
            else {
                echo "please login!";
            }
            
            
        }
        else {
                echo "no theme submitted!";
            }
    }
    else {
                echo "why are you here";
            }