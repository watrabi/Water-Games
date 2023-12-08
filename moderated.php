    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /login");
    }
    ?>
    


<?php define("tabname","Moderated"); ?>
<?php include_once("base/header.php"); ?>
    <?php 
            include("base/conn.php");
            $stmt = $pdo->prepare('SELECT * FROM bans WHERE userid=? AND ignored = 0');
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
               foreach ($stmt as $row) {
                   $banid = $row["id"];
                   $reason = $row["reason"];
                   $bannedcontent = $row["content"];
                   $type = $row["type"];
               } 
            }
            else {
                header("Location: /home");
            }
    
    ?>
<div class="main" id="main">
    <br><br>
<h1>Uh Oh!</h1>
<h2>A moderator/admin has taken an action on you.</h2>
<?php 

    if($type == 1){
        $typee = "Account Banned";
        
    }
    elseif($type == 2) {
        $typee = "Chat Warn";
    }
    
    echo "<p>$typee <br>Reason: $reason <br> Content: $bannedcontent <br></p>";
    
    if($type == 2){
        echo '<form method="post" action="/api/ignore.php?banid='.$banid.'"><input type="submit" value="reactivate account" name="reactivate"></form>';
    }

?>

</div>
<?php include_once("base/footer.php"); ?>
</body>
</html>