    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /login");
    }
    ?>

<?php define("tabname","Settings"); ?>
<?php include_once("base/header.php"); ?>
<div class="main" id="main">
<?php

    checkpfp($id);

?>
<h1>Hello, <?php echo $username; ?></h1>
<h2>Edit your account below</h2>
    <p>Change theme</p>
    <form method="POST" action="/api/updatetheme">
        <select name="theme">
            <?php
            
            $stmt = $pdo->prepare('SELECT * FROM themes ');
            $stmt->execute();
    
            foreach ($stmt as $row) {
                echo '<option value="'.$row["internal_url"].'">'.$row["name"].'</option>';
            }
            ?>
        </select>
        <input type="submit" value="Change Theme">
    </form>
    <br><br>
<p>Change your Profile Picture</p>
        <form method="POST" action="/api/changepfp" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/jpeg, image/png">
        <input type="submit" value="Upload">
    </form>
    <br><br>
    <p>Change your username</p>
    
    <form method="POST" action="/api/updateusername">
        <input type="username" value="<?php echo $uusername ?>" name="username" placeholder="Username" required>
        <input type="submit" value="Change Username!" ><br>
        <small>WARNING: This deletes all previous messages.</small>
    </form>
    <br>

    
</div>
<?php include_once("base/footer.php"); ?>
</body>
</html>