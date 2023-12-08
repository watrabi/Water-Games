    <?php if(isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /home");
    }
    ?>

<?php define("tabname","Home"); ?>
<?php include_once("base/header.php"); ?>
<div class="main" id="main">
    <h1>Water Games | V4</h1>
    <h2>Yeah. We're on v4 already! Choose an option below</h2>
    <br><br>
    <button onclick="window.location.href = '/login'">Login</button><button onclick="window.location.href = '/register'">Register</button><button onclick="alert('not done')">Play as Guest</button>
    </div>
    <?php include_once("base/footer.php"); ?>
</body>
</html>