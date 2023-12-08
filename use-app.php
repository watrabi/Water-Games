<?php
    $id = $_GET["id"];
    include("base/conn.php");
    include("base/config.php");
    $stmt = $pdo->prepare('SELECT * FROM apps WHERE id=?');
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() > 0) {
        foreach ($stmt as $row) {
            $url = $row["url"];
            $name = $row["name"];
        }
    } else {
        echo "<a href=\"/\">Go Back</a>";
        die("<script>alert(\"No app found.\");</script>");
    }
    
    //checks if the user is logged in an grabs a whole bunch of user data (no passwords!)
if(isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
    $user = $_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];
    
     $stmt = $pdo->prepare('SELECT id, username, email, theme, role, verified FROM accounts WHERE uscid=? ');
     $stmt->execute([$user]);
     foreach ($stmt as $row) {
        $theme = $row["theme"];
    }
}
else {
    $theme = "blue_theme";
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $name ." - ". sitename; ?></title>
<script src="https://kit.fontawesome.com/25552dd253.js" crossorigin="anonymous"></script>
<script async src="https://arc.io/widget.min.js#7LFiJFD3"></script>
<iframe src="/app-files/<?php echo $url; ?>index.html" class="game"></iframe>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y6NHKR9GYS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y6NHKR9GYS');
</script>

<link href="/assets/<?php echo $theme; ?>/gameheader.css?t=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>
<footer id="bottom-bar">
    <a class="nav-item" href="/home"><i class="fas fa-home fa-xl"></i></a>
    <a class="nav-item" href="/games"><i class="fas fa-gamepad fa-xl"></i></a>
    <a class="nav-item" href="/proxy"><i class="fab fa-internet-explorer fa-xl"></i></a>
    <a class="nav-item" href="/music"><i class="fas fa-music fa-xl"></i></a>
    <a class="nav-item" href="/apps"><i class="fab fa-app-store fa-xl"></i></a>
    <a class="nav-item" href="#"><i class="fas fa-heart fa-xl"></i>    Likes: ---</a>
</footer>


<script>
    let timeout;
    const footer = document.getElementById('bottom-bar');
    const footerHeight = footer.offsetHeight;
    const screenHeight = window.innerHeight;

    function slideFooterOff() {
        footer.style.transform = 'translate(-50%, ' + footerHeight + 'px)';
    }

    function slideFooterIn() {
        footer.style.transform = 'translate(-50%, 0)';
    }

    function resetTimer() {
        clearTimeout(timeout);
        slideFooterIn();
        timeout = setTimeout(slideFooterOff, 5000);
    }

    // Add event listeners to handle mouseover and mouseout events on the entire document
    document.addEventListener('mouseover', resetTimer);
    document.addEventListener('mouseout', resetTimer);

    // Initial call to start the timer
    resetTimer();
    
     // Function to close the modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
        
        document.addEventListener("keyup", function(event) {
    if (event.keyCode === 192) {
        win = window.open();         win.document.body.style.margin = "0";         win.document.body.style.height = "100vh";             var iframe = win.document.createElement("iframe");         iframe.style.border = "none";         iframe.style.width = "100%";         iframe.style.height = "100%";         iframe.style.margin = "0";         iframe.referrerpolicy = "no-referrer";         iframe.allow = "fullscreen";         win.document.body.appendChild(iframe);         iframe.src = "https://watergamesv4dev.watercdn.gq/";         window.close()
        
    }
});

document.addEventListener("keyup", function(event) {
    if (event.keyCode === 27) {
        window.open("https://www.google.com/");
        document.title = "My Drive - Google Drive";
        (function() {
    var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = 'https://ssl.gstatic.com/images/branding/product/1x/drive_2020q4_32dp.png';
    document.getElementsByTagName('head')[0].appendChild(link);
})();
        
    }
});

        document.addEventListener("keyup", function(event) {
    if (event.keyCode === 192) {
        var elem = document.getElementById("gameframe");
        elem.focus();
    }
});


        var elem = document.getElementById("gameframe");
        elem.focus();
                var elem = document.getElementById("gameframe");
        elem.focus();
                var elem = document.getElementById("gameframe");
        elem.focus();
                var elem = document.getElementById("gameframe");
        elem.focus();
                var elem = document.getElementById("gameframe");
        elem.focus();
                var elem = document.getElementById("gameframe");
        elem.focus();

</script>
</body>
</html>