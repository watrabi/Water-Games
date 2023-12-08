<?php

if($_POST["username"]) {
    
    //again put them in variables
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    //grab the password from the database assuming they have a username
    
    include("../base/conn.php");
        $stmt = $pdo->prepare('SELECT username, password, uscid FROM accounts WHERE username=?');
        $stmt->execute([$username]);
    
         foreach ($stmt as $row) {
                $uscid = $row["uscid"];
                $hashed_password = $row["password"];
                $username = $row["username"];
            }
            
            
    
    //make sure they put in the correct password
    
    if(password_verify($password, $hashed_password)) {
    
        $domain = $_SERVER['HTTP_HOST'];
        setcookie("WARNING-DO-NOT-SHARE-WATERGAME-USCID" , $uscid ,  time()+2678400, "/", $domain, 0 );
        
        
        echo $domain;
        header("Location: /home");
        die();
        }
        else {
            header("Location: /login.php?error=2");
            die();
        }
    }
    