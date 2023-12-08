    <?php if(isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /home");
    }
    
    session_start();
    $_SESSION["botprotection"] = "hahayes";
    ?>

<?php define("tabname","Sign Up"); ?>
<?php include_once("base/header.php"); ?>
<div class="main" id="main">
<h1>Register an account.</h1>
<form action="/api/register.php" method="post">
    <input type="username" name="username" placeholder="Enter Username" autocomplete="on" required>
    <input type="email" name="email" placeholder="Enter E-Mail" autocomplete="on" required>
    <input type="password" name="password" placeholder="Enter Password" autocomplete="on" required>
    <br><br>
    <input type="submit" value="Make an account!">
</form>
<p><a href="/login" style="color: white;">Already have an account?</a></p>
<?php include_once("base/footer.php"); ?>
</body>
</html>