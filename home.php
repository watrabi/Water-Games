    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /login");
    }
    ?>
    


<?php define("tabname","Home"); ?>


<?php include_once("base/header.php"); ?>
<div class="main" id="main">
    <br><br>
    
<?php

if(isset($id)){
    checkpfp($id);
}

?>
<?php 

    if(isset($_GET["c"])){
        if($_GET["c"] == 1){
            echo "Welcome, " . $username . "!";
        }
    }

?>
<h2>Welcome <?php echo $username ?>!</h2>
    <?php
    
    $stmt = $pdo->prepare('SELECT  join_date FROM accounts WHERE uscid=? ');
            $stmt->execute([$user]);
    
            foreach ($stmt as $row) {
                echo "<h3>You joined " . sitename . " at " . $row["join_date"] . "</h3>";
            }
    
    ?>
    <p>What would you like to do?</p>
    <button onclick="window.location.href = '/settings'">Edit Account</button>
    <button onclick="window.location.href = '/games'">Play a Game!</button>
    <button onclick="window.location.href = '/signout'">Log Out</button>
    
    <p>

            Tips: <br>Press your ESC key to open google<br>Press ` on your keyboard to open about:blank.
    </p>
</div>
<?php include_once("base/footer.php"); ?>
</body>
</html>