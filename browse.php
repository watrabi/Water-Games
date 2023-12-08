<?php define("tabname","Browse"); ?>
<?php include_once("base/header.php"); ?>
<div class="main" id="main">
    <h1>Browse Users.</h1>
    <h2>Look for a friend!?</h2>
    <?php 
    // Pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Current page
$perPage = 10;  // Number of results per page
$start = ($page - 1) * $perPage;  // Calculate the starting point

// SQL query to retrieve paginated data
$sql = "SELECT id, username, join_date, role, verified FROM accounts LIMIT :start, :perPage";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<ul>

<li><div id="user"><p>Profile Picture</p><p>Username</p> <p>Join Date</p> <p>Profile</p></div></li>
<?php
// Display the results
foreach ($results as $result) {
    
    $browseusername = $result["username"];
    
    if($result["verified"] == 1){
            //lets add a check mark to the users name if they're verified
            //dont use this worst mistake of my life. 😱
            //$username = $username . '<i class="fa-solid fa-check" style="color: #005eff;"></i>';
            //I'm gonna go uhhh the uhhhhh
            $browseusername = $browseusername . " ";
            $browseusername = $browseusername . '<i class="fas fa-check-circle" style="color: #005eff;"></i>';
            //ok I know I said not to use that but for some reason the other icon broke everything but not this one??
            }
            if($result["role"] == "admin"){
                $browseusername = $browseusername . " ";
                $browseusername = $browseusername . '<i class="fas fa-hammer" style="color: #ff0000;"></i>';
            }
    
    echo '<li><div id="user">' . checkpfpreturnedition($result["id"]) . '<p>' . $browseusername . '</p> <p>'.$result["join_date"].'</p> <button onclick="window.location.href = \'/profile/'.$result["id"].'\'">Browse</button></div></li>';

    
    
}
?>
</ul>
<?php

// Pagination links
$sql = "SELECT COUNT(*) as total FROM accounts";
$stmt = $pdo->query($sql);
$total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$pages = ceil($total / $perPage);

// Output pagination links
for ($i = 1; $i <= $pages; $i++) {
    echo "<a href='?page=$i'>$i</a> ";
}

?>
    <?php include_once("base/footer.php"); ?>
</body>
</html>