    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /login");
    }
    ?>

<?php define("tabname","Admin - Ban User"); ?>
<?php include_once("../base/header.php"); ?>
<?php   
    
    if($role !== "admin"){
        $domain = $_SERVER['SERVER_NAME'];
        echo '<meta http-equiv="refresh" content="0; url=\'https://'.$domain.'\'" />';
        die("User is not authenticated!");
    }

?>
<div class="main" id="main">
    <br><br>
    
<?php

checkpfp($id);

?>
    <h1>Welcome to the admin panel, <?php echo $username; ?>!</h1>
    <h2>Ban a user</h2>
    <form method="post" action="/api/banuser.php">
        <input type="text" placeholder="User ID" name="userid" required=""><br>
        <input type="text" placeholder="Reason" name="reason" required><br>
        <input type="text" placeholder="Offensive Content" name="offsensivecontent" required><br>
        <input type="text" placeholder="type" name="type" required><br>
        <p>pls write 1 for account ban and 2 for chat warn..</p>
        <br>
        
        <input type="submit" value="take action">
    </form>


  </div>
</div>

<script>


</script>
</body>
</html>