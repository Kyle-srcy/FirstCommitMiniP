<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) die("Access denied.");

$id = $_GET['id'];

// Get the file and make sure the user owns it
$stmt = $conn->prepare("SELECT * FROM files WHERE id=? AND uploaded_by=?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();
$res = $stmt->get_result();
$file = $res->fetch_assoc();

if (!$file) die("File not found or access denied.");

// Update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newname = trim($_POST['filename']);
    $stmt = $conn->prepare("UPDATE files SET filename=? WHERE id=? AND uploaded_by=?");
    $stmt->bind_param("sii", $newname, $id, $_SESSION['user_id']);
    $stmt->execute();
    header("Location: dashboard.php");
    exit;
}
?>

<form method="POST">
    <input type="text" name="filename" value="<?= htmlspecialchars($file['filename']) ?>" required>
    <button type="submit">Save</button>
</form>
