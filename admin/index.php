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
    <h2>Choose an action</h2>
    <button onclick="window.location.href = '/admin/editacct'">Sign in as a user</button><button onclick="window.location.href = '/admin/statistics'">statistics</button><button onclick="window.location.href = '/admin/banuser.php'">Moderate User</button>


  </div>
</div>

<script>


</script>
</body>
</html>