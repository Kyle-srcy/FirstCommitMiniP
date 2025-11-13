<?php
session_start();
require_once "db.php";

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied.");
}

// Validate file ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("Invalid file ID.");
}

// Step 1: Retrieve the file and check ownership
$stmt = $conn->prepare("SELECT * FROM files WHERE id = ? AND uploaded_by = ?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$file = $result->fetch_assoc();
$stmt->close();

// Step 2: If file exists and belongs to user, delete it
if ($file) {
    // Delete file from server
    $fullpath = __DIR__ . '/' . $file['filepath'];
    if (file_exists($fullpath)) {
        unlink($fullpath);
    }

    // Delete file record from database
    $stmt = $conn->prepare("DELETE FROM files WHERE id = ? AND uploaded_by = ?");
    $stmt->bind_param("ii", $id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        $stmt->close();
        // Redirect back to dashboard after successful deletion
        header("Location: dashboard.php");
        exit;
    } else {
        die("Failed to delete file from database: " . $stmt->error);
    }
} else {
    die("File not found or access denied.");
}
