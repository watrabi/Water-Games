

<?php 

$pdo = new PDO("mysql:host=host; user=username; dbname=username; password=password; charset=utf8mb4");

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);