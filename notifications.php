    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /home");
    }
    ?>

<?php define("tabname","System Notifications"); ?>
<?php include_once("base/header.php"); ?>
<div class="main" id="main">
    <h1>System Notifications</h1>
    <?php 
    
    $stmt = $pdo->prepare('SELECT * from sys_notif WHERE recipient = ? OR recipient = 0 ');
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() > 0) {
    foreach ($stmt as $row) {
        echo '<p><i class="fas fa-cogs fa-lg"></i>'. $row["message"] .' </p>';
    }
    } else {
    echo '<h2>No system notifications</h2>';
    }
    
    ?>
    </div>
    <?php include_once("base/footer.php"); ?>
</body>
</html>