<?php
$host = "db.fr-pari1.bengt.wasmernet.com";
$user = "6e640300738180007ff81030191e";
$pass = "06916e64-0300-7507-8000-d6ec482bfbd7";
$db   = "project1";
$port = 10272;

// Create connection
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
