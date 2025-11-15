<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) die("Access denied.");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) die("Invalid file ID.");

// Get file path to delete actual file
$stmt = $conn->prepare("SELECT filepath FROM files WHERE id=? AND uploaded_by=?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();
$res = $stmt->get_result();
$file = $res->fetch_assoc();

if ($file && file_exists($file['filepath'])) {
    unlink($file['filepath']); // delete the file
}

// Delete from database
$stmt = $conn->prepare("DELETE FROM files WHERE id=? AND uploaded_by=?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();

// Redirect back with success flag
header("Location: crud.php?deleted=1");
exit();
?>


