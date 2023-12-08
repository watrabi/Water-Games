<?php //header("Location: /maintenance"); ?>
<?php //this stuff is just the basics (yes I opened a php thing just for this, what are you gonna do about it?!?!?) ?>
<?php include("config.php"); ?>
<?php include("conn.php"); ?>
<?php 

$stmt = $pdo->prepare('SELECT * FROM site_settings ');
            $stmt->execute();
    
            foreach ($stmt as $row) {
                $sitemode = $row["site_mode"];
                
                if($sitemode == 1){
                    //this means the site is in maintenance mode (if you cant tell by the redirect)
                    header("Location: /maintenance");
                }
                elseif($sitemode == 2){
                    //this means the site is in debug mode
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                }
            }

?>
<?php include("functions.php"); ?>

<?php

//checks if the user is logged in an grabs a whole bunch of user data (no passwords!)
if(isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
    $user = $_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];
    

    
     $stmt = $pdo->prepare('SELECT id, username, email, theme, role, verified FROM accounts WHERE uscid=? ');
            $stmt->execute([$user]);
    
            foreach ($stmt as $row) {
                $id = $row["id"]; // returns the current users id
                $username = $row["username"]; // returns the current users username (will be modified with html so if you don't want that use $uusername)
                $uusername = $row["username"]; //fallback for stuff like chat :( )
                $email = $row["email"]; // returns the current users email
                $theme = $row["theme"]; //returns theme (e.g blue_theme now with red_theme)
                $role = $row["role"]; //returns either member or admin
                $verified = $row["verified"]; //returns 1 if verified, returns 0 if not.
            }
            
            $stmt = $pdo->prepare('SELECT * FROM bans WHERE userid=? AND ignored = 0');
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
                $page = basename($_SERVER['PHP_SELF']); // uhhhhhh I need this for the current page its on but not really cause I'm retarded
                
                if(tabname !== "Moderated"){
                    header("Location: /moderated"); // SANS, YOU'VE BEEN BANNED 
                }
            } 
            
            if($role !== "admin" && $sitemode == "2"){
                header("Location: /maintenance"); //checks site mode and then redirect to maintenance and sutff
            }
            
            if($sitemode == "0"){
                error_reporting(0);
            }
            
            if($verified == 1){
            //lets add a check mark to the users name if they're verified
            //dont use this worst mistake of my life. 😱
            //$username = $username . '<i class="fa-solid fa-check" style="color: #005eff;"></i>';
            //I'm gonna go uhhh the uhhhhh
            $username = $username . " ";
            $username = $username . '<i class="fas fa-check-circle" style="color: #005eff;"></i>';
            //ok I know I said not to use that but for some reason the other icon broke everything but not this one??
            }
            if($role == "admin"){
                //this basically checks if someone is an admin and puts a space then the icon, nothing too special.
                $username = $username . " ";
                $username = $username . '<i class="fas fa-hammer" style="color: #ff0000;"></i>';
            }
                
            }



        if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"] )){
            //fallback so if the user isn't logged in the site doesn't die (I should have done it the other way but if it ain't broke don't fix it)
            $theme = "blue_theme";
            if($sitemode == "2"){
                header("Location: /maintenance");
            }
        }
        
        $domain = $_SERVER['HTTP_HOST']; //yaaaa

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo tabname; ?>  -  <?php echo sitename; ?></title>
        <!-- ignore everything here, just a crap ton of assets -->
        <link href="/assets/<?php echo $theme; ?>/main.css?t=<?php echo time(); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y6NHKR9GYS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y6NHKR9GYS');
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script async src="https://arc.io/widget.min.js#7LFiJFD3"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3858062298850419"
     crossorigin="anonymous"></script>

    </head>
    <body>
        
    <div class="top-nav" id="top-nav"><a href="javascript:toggleNav()" id="hamburger"><i class="fas fa-bars fa-lg"></i></a> <h1><?php echo sitename; if($sitemode == 2){ echo " - DEBUG MODE"; } ?></h1></div>
    

    
    <div class="sidebar" id="sidebar">
    <a class="nav-item" href="/home"><i class="fas fa-home"></i>Home</a>
    <a class="nav-item" href="/games"><i class="fas fa-gamepad"></i>Games</a>
        <a class="nav-item" href="javascript:openModal()"><i class="fab fa-internet-explorer"></i>Proxy</a>
    <a class="nav-item" href="javascript:openModal()"><i class="fas fa-music"></i>Music</a>
    <a class="nav-item" href="/apps"><i class="fab fa-app-store"></i>Apps</a>
    <a class="nav-item" href="https://discord.gg/b2AKDuFmp8"><i class="fab fa-discord"></i>Discord</a> 
    
    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        //checks if the user isn't logged in and displays the sign in and up buttons
        echo '    <a class="nav-item" href="/login"><i class="fas fa-sign-in-alt"></i>Sign In</a>
    <a class="nav-item" href="/register"><i class="fas fa-user-plus"></i>Sign Up</a>';
    }
    else 
    {   
        //checks if the user is logged in and puts stuff like chat, sign out, stuff like that.
        echo '<a class="nav-item" href="/notifications"><i class="fas fa-cogs"></i>System Notifications</a>';
        echo '<a class="nav-item" href="/chat/index"><i class="fas fa-comments"></i>Chat</a>';
        echo '<a class="nav-item" href="/signout"><i class="fas fa-sign-out-alt"></i>Sign Out</a>';
        
        if($role == "admin"){
            echo '<a class="nav-item" href="/admin/"><i class="fas fa-hammer"></i>Admin</a>';
        }
    }
    
?>
    
    
    
    </div>
    <!-- cookies cookies cookies cookies cookies cookies cookies cookies cookies cookies cookies cookies cookies cookies cookies cookies -->
    <div id="cookie-popup" class="cookie-popup">
        <div class="cookie-popup-content">
            <p>This site uses cookies to improve your experience.</p>
            <button id="accept">Accept</button>
            <a href="/redirect-notice?url=https://www.google.com/">Decline</a>
        </div>
    </div>
        <script>
        //funny little script so stuff changes
        function toggleNav() {
        var width = document.getElementById('sidebar').offsetWidth;

        if(width == 180){
            document.getElementById("sidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.getElementById("top-nav").style.marginLeft = "0";
            document.getElementById("sitebanner").style.marginLeft = "0";
            
        }
        else {
            document.getElementById("sidebar").style.width = "180px";
            document.getElementById("main").style.marginLeft = "180px";
            document.getElementById("top-nav").style.marginLeft = "180px";
            document.getElementById("sitebanner").style.marginLeft = "180px";
        }
    }

// JavaScript for the cookie popup
window.onload = function () {
    var cookiePopup = document.getElementById("cookie-popup");
    var acceptButton = document.getElementById("accept");

    // Check if the user has already accepted cookies
    if (!localStorage.getItem("cookiesAccepted")) {
        cookiePopup.style.display = "block";
    }

    // Handle the accept button click
    acceptButton.addEventListener("click", function () {
        localStorage.setItem("cookiesAccepted", "true");
        cookiePopup.style.display = "none";
    });
};

//yes this is chatgpt generated, wasn't having it with javascript.

</script>
 <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span onclick="closeModal()" class="close">&times;</span>
            <p>This feature is not done yet!</p>
            <p>Please try again later...</p>
        </div>
    </div>

    <script>
        //stuff to open the mododododle
        function openModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";

            // listen for stuff
            modal.addEventListener("click", function(event) {
                //see if user clicked off the modal
                if (event.target === modal) {
                    closeModal();
                }
            });
        }


        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
        
        document.addEventListener("keyup", function(event) {
    if (event.keyCode === 192) {
        //listens for the about:blank button to be pressed
        win = window.open();         win.document.body.style.margin = "0";         win.document.body.style.height = "100vh";             var iframe = win.document.createElement("iframe");         iframe.style.border = "none";         iframe.style.width = "100%";         iframe.style.height = "100%";         iframe.style.margin = "0";         iframe.referrerpolicy = "no-referrer";         iframe.allow = "fullscreen";         win.document.body.appendChild(iframe);         iframe.src = "https://<?php echo $domain; ?>/";         window.close()
        
    }
});

document.addEventListener("keyup", function(event) {
    if (event.keyCode === 27) {
        //listens for the panic button and opens up a new tab and shizzles
        document.title = "My Drive - Google Drive";
        window.open("https://www.google.com/");
        (function() {
    var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = 'https://ssl.gstatic.com/images/branding/product/1x/drive_2020q4_32dp.png';
    document.getElementsByTagName('head')[0].appendChild(link);
})();
        
    }
});



    </script>
    <br><br><br>
    <!--<div id="sitebanner" class="sitebanner"><h1>Apps are out!</h1></div> -->
    
    

