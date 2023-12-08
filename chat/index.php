    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /login");
    }
    ?>

<?php define("tabname","Chat"); ?>
<?php include_once("../base/header.php"); ?>

<div class="main" id="main">
    <br><br>
    
    <?php if($uusername == "Madison" ){
        die("Failed to Load Chat<br>Reason: You have been temprorarily banned from chat. <br>Content Type: harassment <br> Message Content: OSCAR AND EMERSON IS UGLY<br>Chat will be granted on December 9th, 2023");
    }
    
    ?>
    
<?php

checkpfp($id);

?>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <h2>This page is a work in progress</h2>
    <p>Choose someone below to chat to!</p>

    <h1>Current Users</h1>
    
    <input id="search-input" placeholder="Search">
    <ul class="userlist" id="userlist">
        <?php
        
        $stmt = $pdo->prepare('SELECT username, id, role, verified FROM accounts WHERE NOT id= ? ');
    $stmt->execute([$id]);

    foreach ($stmt as $row) {
        
        
        $role = $row["role"];
        $verified = $row["verified"];
        $id = $row["id"];
        $uusername = $row["username"];
        if($verified == 1){
            //lets add a check mark to the users name if they're verified
            //dont use this worst mistake of my life. 😱
            //$username = $username . '<i class="fa-solid fa-check" style="color: #005eff;"></i>';
            //I'm gonna go uhhh the uhhhhh
            $uusername = $uusername . " ";
            $uusername = $uusername . '<i class="fas fa-check-circle" style="color: #005eff;"></i>';
            //ok I know I said not to use that but for some reason the other icon broke everything but not this one??
            }
            if($role == "admin"){
                $uusername = $uusername . " ";
                $uusername = $uusername . '<i class="fas fa-hammer" style="color: #ff0000;"></i>';
            }
        echo '<div onclick="document.location.href = \'talk?recipient='. $row["username"] .'\'"><li>';
        checkpfp($id);
        echo
        '
        <span class="username">'.$uusername.'</span>
        <span class="status"></span>
      </li></div>';
    }
    ?>
     

      <!-- Add more users here dynamically -->
    </ul>
  </div>
</div>

<script>
    var searchInput = document.getElementById('search-input');
    var listContainer = document.getElementById('userlist');
    var listItems = listContainer.getElementsByTagName('li');
    
    searchInput.addEventListener('input', function() {
      var searchQuery = searchInput.value.trim().toLowerCase();
    
      for (var i = 0; i < listItems.length; i++) {
        var listItem = listItems[i];
        var listItemText = listItem.textContent.toLowerCase();
    
        if (listItemText.includes(searchQuery)) {
          listItem.style.display = 'flex';
        } else {
          listItem.style.display = 'none';
        }
      }
    });

</script>
</body>
</html>