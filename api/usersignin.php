<?php
        
         $domain = $_SERVER['HTTP_HOST'];
         setcookie("WARNING-DO-NOT-SHARE-WATERGAME-USCID" , $_POST["uscid"] ,  time()+2678400, "/", $domain, 0 );
