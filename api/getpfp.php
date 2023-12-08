<?php
include("../base/functions.php");
// Retrieve the username from the query string parameter
$username = $_GET['username'];

$pfpUrl = getid($username);

// Implement your logic to fetch the pfp source based on the username
$pfpSrc = "/assets/uspfp/$pfpUrl.png"; // Replace '...' with the logic to fetch the pfp source

// Set the appropriate Content-Type header
header('Content-Type: text/plain');

// Return the pfp source
echo $pfpSrc;
