<?php
session_start();
require_once "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "<pre>"; // for clean debug output


if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to upload files.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filename = trim($_POST['filename']);
    $file = $_FILES['uploaded_file'];

    $target_dir = "uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    $target_file = $target_dir . basename($file["name"]);

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $uploaded_by = $_SESSION['user_id'];

        $stmt = $conn->prepare("INSERT INTO files (filename, filepath, uploaded_by, uploaded_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("ssi", $filename, $target_file, $uploaded_by);

        if ($stmt->execute()) {
            header("Location: /crud.php");
            exit;
        } else {
            die("Database error: " . $stmt->error);
        }
    } else {
        die("Error uploading file.");
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="filename" placeholder="File Name" required>
    <input type="file" name="uploaded_file" required>
    <button type="submit">Upload</button>
</form>
