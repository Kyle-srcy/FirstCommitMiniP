<?php
$host = "localhost";
$user = "root";       // default XAMPP username
$pass = "";           // default XAMPP password is empty
$db   = "project";    // your database name

$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
