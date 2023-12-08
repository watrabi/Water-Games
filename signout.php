<?php

$cookie = $COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];

//setcookie("WARNING-DO-NOT-SHARE-WATERGAME-USCID", $cookie, time() - 2678400 - 2678400 - 2678400 - 2678400);
$domain = $_SERVER['HTTP_HOST'];
setcookie("WARNING-DO-NOT-SHARE-WATERGAME-USCID" , $uscid ,  time()-2678400, "/", $domain, 0 );
header("Location: /");
