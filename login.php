 
    <?php if(isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /home");
    }
    ?>

<?php define("tabname","Log In"); ?>
<?php include_once("base/header.php"); ?>
<div class="main" id="main">
<h1>Login to your account</h1>
<form action="/api/login.php" method="post">
    <input type="username" name="username" placeholder="Enter Username" autocomplete="on" required>
    <input type="password" name="password" placeholder="Enter Password" autocomplete="on" required>
    <br><br>
    <input type="submit" value="Login">
</form>
<p><a href="/register" style="color: white;">Don't have an account?</a></p>
<?php include_once("base/footer.php"); ?>
</body>
</html>