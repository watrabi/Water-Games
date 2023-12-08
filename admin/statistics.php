    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /login");
    }
    ?>

<?php define("tabname","Admin Statistics"); ?>
<?php include_once("../base/header.php"); ?>
<?php   
    
    if($role !== "admin"){
        $domain = $_SERVER['SERVER_NAME'];
        echo '<meta http-equiv="refresh" content="0; url=\'https://'.$domain.'\'" />';
        die("User is not authenticated!");
    }
    
    $stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM accounts ');
    $stmt->execute();
    
    foreach ($stmt as $row) {
        $count = $row["count"];
    }
    
    $stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM accounts WHERE theme = "red_theme" ');
    $stmt->execute();
    
    foreach ($stmt as $row) {
        $redcount = $row["count"];
    }
    
    $stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM accounts WHERE theme = "blue_theme" ');
    $stmt->execute();
    
    foreach ($stmt as $row) {
        $bluecount = $row["count"];
    }
    
        $stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM logs');
    $stmt->execute();
    
    foreach ($stmt as $row) {
        $logcount = $row["count"];
    }
    
    $stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM messages ');
    $stmt->execute();
    
    foreach ($stmt as $row) {
        $messagecount = $row["count"];
    }
    
    $stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM games ');
    $stmt->execute();
    
    foreach ($stmt as $row) {
        $gamescount = $row["count"];
    }
    

?>
<div class="main" id="main">
    <br><br>
    
<h1>Statistics:</h1>
<ul>
    <li><?php echo $count ?> Users</li>
    <li><?php echo $redcount; ?> Red Theme users</li>
    <li><?php echo $bluecount; ?> Blue Theme users</li>
    <li><?php echo $messagecount; ?> Messages</li>
    <li><?php echo $gamescount; ?> Games</li>
    <li><?php echo $logcount; ?> Logs</li>
</ul>
    

  </div>
</div>

<script>


</script>
</body>
</html>