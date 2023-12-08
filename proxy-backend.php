<?php
// Get the URL to proxy from the query string
$url = $_GET['url'];

// Extract the user agent from the HTTP request headers
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Create a CURL handle
$ch = curl_init($url);

// Set CURL options
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent); // Set the user agent

// Execute the CURL request
$response = curl_exec($ch);

// Get the content type of the response
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

// Set the appropriate content type for the response
header("Content-Type: $contentType");

// Output the response
echo $response;

// Close the CURL handle
curl_close($ch);
?>
