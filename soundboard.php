
<!DOCTYPE html>
<html>
  <head>
    <style>body {
  font-size: 12px;
  background: #fff !important;
  border-style: none;
  font-family: helvetica, arial, sans-serif;
}
.sound {
  border-style: outset;
  width: 100px;
  height: 170px;
}
.download {
  cursor: pointer;
}
.name {
  text-align: center;
  font-size: 15px;
}
#instants_container {
  margin: 30px auto 0;
  text-align: center;
  border-style: none;
}
.instant {
  position: relative;
  vertical-align: top;
  width: 94px;
  border-style: none;
  text-align: center;
  display: inline-block;
  margin-bottom: 30px;
  margin-right: 5px;
  margin-left: 5px;
  word-wrap: break-word;
}
.small-button {
  width: 94px;
  height: 89px;
  margin-bottom: 0px;
  margin-right: 0px;
  margin-left: 3px;
  margin-top: 0px;
  border-style: none;
  position: absolute;
  background: url(/assets/img/button.png) no-repeat;
  cursor: pointer;
}
.small-button:active {
  background: url(/assets/img/button-pressed.png) no-repeat;
  cursor: progress;
}
.small-button-background {
  width: 86px;
  height: 84px;
  margin-top: 3px;
  margin-left: 6px;
  position: absolute;
}
.small-button-shadow {
  width: 94px;
  height: 89px;
  margin-bottom: 5px;
  background: url(/assets/img/button-shadow.png) no-repeat;
}
.circle {
  border-radius: 50%;
}
.flex-container {
  display: flex;
  flex-wrap: wrap;
  background-color: white;
}
.flex-container > div {
  padding: 5px;
}
div.control {
  position: fixed;
  bottom: 0;
  right: 0;
  width: auto;
  padding: 3px;
  border: 3px solid #000;
  background: #ffffff;
  z-index: 100;
}
.woah {
  cursor: pointer;
}</style>
  </head>
  <body>
    <h1>Online Soundboard</h1>
    <h2>
      Just click on the colorful buttons to play the sound.<br />
      <a href="https://kingman11211.vercel.app/Pages/request.html">Click here to submit a sound to be added!</a>
    </h2>
    <script>
      // functions for audio control menu
      function playAll() {
        const els = document.getElementsByTagName("AUDIO");
        Array.from(els).forEach((el) => {
          el.play();
        });
      }
      function stopAll() {
        const els = document.getElementsByTagName("AUDIO");
        Array.from(els).forEach((el) => {
          el.load();
        });
      }
      // https://stackoverflow.com/q/74351622/18183112 ty <3
    </script>
    <div class="control">
      Audio Controls
      <button class="woah" onclick="playAll()">Provoke Chaos</button>
      <button class="woah" onclick="stopAll()">Stop Everything</button>
    </div>

    <div class="flex-container">
      <div>
        <div class="sound">
          <div class="circle small-button-background" style="background-color: #339900;"></div>
          <audio class="sound" id="fart" src="sounds/fart.mp3" preload="auto"></audio>
          <button class="small-button" onclick="document.getElementById('fart').play();"></button>
          <div class="small-button-shadow"></div>
          <p class="name">
            <a href="/sounds/fart.mp3" download>Download</a><br />
            Fart
          </p>
        </div>
      </div>
      <div>
          
          <?php 

$dir    = 'sounds';
$files1 = scandir($dir);

foreach ($files1 as $sound){
    echo '<div>
  <div class="sound">
    <div class="circle small-button-background" style="background-color:#COLOR;"></div>
    <audio id="SOUND" src="sounds/'.$sound.'" preload="auto"></audio>
    <button class="small-button" onclick="document.getElementById(\'SOUND\').play();"></button>
    <div class="small-button-shadow">'.$sound.'</div>
    <p class="name">
      <a href="/sounds/'.$sound.'" download>Download</a><br />
    </p>
  </div>
</div>';
}

?>
          
      <!-- TEMPLATE TO ADD MORE SOUNDS

<div>
  <div class="sound">
    <div class="circle small-button-background" style="background-color:#COLOR;"></div>
    <audio id="SOUND" src="sounds/SOUND.mp3" preload="auto"></audio>
    <button class="small-button" onclick="document.getElementById('SOUND').play();"></button>
    <div class="small-button-shadow"></div>
    <p class="name">
      <button onclick="window.location.href='sounds/SOUND.mp3'">Download</button><br>
      SOUND<br>
    </p>
  </div>
</div>

-->
    </div>
  </body>
</html>
