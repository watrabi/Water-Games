    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /login");
    }
    ?>

<?php define("tabname","Admin"); ?>
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
    <h2>sign in as a user</h2>
    <form method="post" action="/api/usersignin.php">
        <input type="text" placeholder="uscid" name="uscid">
        <input type="submit" value="sign in">
    </form>


  </div>
</div>

<script>


</script>
</body>
</html>