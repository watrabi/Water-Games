<?php define("tabname","Profile"); ?>
<?php include_once("base/header.php"); ?>

<div class="main" id="main">
    <?php 

    $id = $_GET["id"];

    $stmt = $pdo->prepare('SELECT id, username, theme, role, verified FROM accounts WHERE id=? ');
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() > 0) {
    
            foreach ($stmt as $row) {
                $profileid = $row["id"];
                $profileusername = $row["username"];
                $profiletheme = $row["theme"];
                $profilerole = $row["role"];
                $profileverifie = $row["verified"];
            }
    }
    else {
        die("<h1>Profile doesn't exist!</h1>");
    }
    
?>
<script>document.title = "<?php echo $profileusername; ?> - <?php echo sitename; ?>"</script>
<div id="user" style="width: 80%">
    
    <? checkpfp($profileid) ?>
    <h2>0 Friends</h2>
    <h2><?php echo $profileusername; ?></h2>
    <h2><?php echo $profilerole; ?></h2>
    <?php
    $stmt = $pdo->prepare('SELECT * FROM friends WHERE reciever=? ');
    $stmt->execute([$profileid]);
    
    if ($stmt->rowCount() > 0) {
           foreach ($stmt as $row) {
                $accepted = $row["accepted"];
                if($accepted == 0){
                    echo '<button disabled>Pending...</button>';
                }
                elseif($accepted = 1){
                    echo '<button disabled>Friends</button>';
                }
            }
    }
    else {
            echo '<button onclick="window.location.href = \'/api/add-friend.php?id='. $profileid . '\'" >Add Friend</button>';
        }
    
            
    ?>
        
    
    
</div>
<div id="profile" style="width: 80%">
    <?php 
    
    $stmt = $pdo->prepare('SELECT gameid, COUNT(*) as play_count FROM logs WHERE userid = ? GROUP BY gameid ORDER BY play_count DESC LIMIT 1'); 
    $stmt->execute([$profileid]); 
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(); 
        $mostPlayedGameId = $row["gameid"]; 
        $stmt = $pdo->prepare('SELECT name FROM games WHERE id = ?');
        $stmt->execute([$mostPlayedGameId]);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $topgame = $row["name"];
           } 
            else {
                $topgame = "An error occurred getting the top game";
                } 
        
    } 
            else { $topgame = "No games played by this user"; } 
    
    ?>
    <h2><?php echo $profileusername; ?>'s top game is... <?php echo $topgame; ?></h2>
</div>
    <?php include_once("base/footer.php"); ?>
</body>
</html>