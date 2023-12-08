<?php 

    if(isset($_POST["username"])){
        
        if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
            die("Please login!");
        }
        else {
            $uscid = $_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];
        }
        
        //so it easier to filter and stuff!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        include("../base/functions.php");
        
        //putem in a variable
        $username = $_POST["username"];
        
        //limit legnth!!!!
        $username = mb_strimwidth($username, 0, 30, "");
        
        //uhhhhh
        
        //remove html characters so that way no xss!!!!
        $username = htmlspecialchars($username);
        
        //filter shizzles
        $username = filterInput($username);
        
                    //connect to database and check if username taken
            include("../base/conn.php");
            
            $stmt = $pdo->prepare('SELECT username FROM accounts WHERE username = ?');
            $stmt->execute([$username]);
            
            if ($stmt->rowCount() > 0) {
                header("Location: /settings?error=2");
                die();
            }
            
            
            //now I think we do the usename update in da dataaaaaa basseee
            
            $query = "UPDATE accounts SET username=? WHERE uscid=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $uscid]);
            
            header("Location: /settings");
    }
    else {
        die("Please enter a username!");
    }

?>