<?php

    session_start();
    define("HOSTNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","");
    define("DBNAME","tuf_portfolio");

    $con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DBNAME) or die("Can not connect to database. <br>");

    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $serverName = 'http://localhost/Tuf_Portfolio/' # Last Wali Slash add karni ha is ma 
    // if($con) {
    //     echo " You are connect to database. <br>";
    // }

    // $_SERVER['PHP_SELF']

?>
