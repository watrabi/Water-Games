<?php
    
    session_start();
    if(!isset($_SESSION["botprotection"])){
        die("Bot protection failed.");
    }

    if(isset($_POST)) {
        if($_POST["username"] && $_POST["email"] && $_POST["password"]){
            
            //make the cookie id
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 40; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    $uscid = $randomString;
     
     include("../base/functions.php");
            
            //put them in variables so they're easier to work with (real)
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            //checking if they're empty
            if($username == NULL || $email == NULL || $password == NULL){
                header("Location: /register?error=1");
            }
            
            //debugging lol
            
            //echo $username . $email . $password;
            
            //limit the length of them cause yk
            $username = mb_strimwidth($username, 0, 30, "");
            $email = mb_strimwidth($email, 0, 50, "");
            $password = mb_strimwidth($password, 0, 255, "");
            //limiting password so sql doesn;t get angry and throw a fit
            
            //now making it not vulnerable
            $username = htmlspecialchars($username);
            $email = htmlspecialchars($email);
            //not gonna do it to pass just incase it mistakes it or smth
            
            //hash the password!1!11! (do this incase the database gets leaked (p.s this is just common practice!!))
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            //ok wait I should check if username taken I forgor lol
            
            //connect to database......
            include("../base/conn.php");
            
            //this method sucks because people keep somehow bypassing it?!?!?
            //$stmt = $pdo->prepare('SELECT username FROM accounts ORDER BY id DESC ');
            //$stmt->execute();
    
            //foreach ($stmt as $row) {
            //if($row["username"] == $username){
            //header("Location: /register?error=2");
            //die();
            //    }
            //}
            
                       $stmt = $pdo->prepare('SELECT uscid FROM accounts WHERE uscid = ? ');
            $stmt->execute([$uscid]);
    
            foreach ($stmt as $row) {
                if($uscid = $row["uscid"]){
                    die("Oops! You've caught an ultra rare error, try signing up again.");
                }
            }
            
            //filter shizzles
            $username = filterInput($username);
            
            $stmt = $pdo->prepare('SELECT username FROM accounts WHERE username = ?');
            $stmt->execute([$username]);
            
            if ($stmt->rowCount() > 0) {
                header("Location: /settings?error=2");
                die();
            }
            
            
            //ok I think they're ready for database!11!1
            
            
            //insert into database
            $query = "INSERT INTO accounts (id, username, email, password, uscid, theme) VALUES (NULL, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $email, $password, $uscid, "blue_theme"]);
        
        /*    
            
            //start the session and stuff
            session_start();
            session_set_cookie_params(86400);
            
            //set the username and tell the user the account was created
            $_SESSION["username"] = $username;
            echo 'account created';
            header("Location: /dashboard?c=1");
            
            */
            
            //set the cookie
            $domain = $_SERVER['HTTP_HOST'];
            setcookie("WARNING-DO-NOT-SHARE-WATERGAME-USCID" , $uscid ,  time()+2678400, "/", $domain, 0 );
            echo 'account created';
            
            //echo $username;
            //echo $email;
            //echo $uscid; 
            
            echo $domain;
            
            header("Location: /home?c=1");
        }
    }