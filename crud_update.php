<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) die("Access denied.");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) die("Invalid file ID.");

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
    $filepath = $file['filepath'];

    // Check if a new file was uploaded
    if (!empty($_FILES['uploaded_file']['name'])) {
        $uploadedFile = $_FILES['uploaded_file'];
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $target_file = $target_dir . basename($uploadedFile["name"]);

        if (move_uploaded_file($uploadedFile["tmp_name"], $target_file)) {
            // Delete old file
            if (file_exists($file['filepath'])) unlink($file['filepath']);
            $filepath = $target_file;
        } else {
            die("Error uploading new file.");
        }
    }

    // Update database
    $stmt = $conn->prepare("UPDATE files SET filename=?, filepath=? WHERE id=? AND uploaded_by=?");
    $stmt->bind_param("ssii", $newname, $filepath, $id, $_SESSION['user_id']);
    if ($stmt->execute()) {
        header("Location: /crud_read.php?updated=1"); // redirect back to main page
        exit;
    } else {
        die("Database error: " . $stmt->error);
    }
}
?>

<h2 style="text-align:center; color:white; margin-bottom:20px;">Edit File</h2>

<div style="display:flex; justify-content:center; align-items:center; flex-direction:column;">
    <form id="editForm" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:15px; width:100%; max-width:450px; background: rgba(0,0,0,0.6); padding:20px; border-radius:12px; box-shadow: 0 0 15px rgba(0,255,255,0.4);">
        <label style="color:white; font-weight:bold;">File Name:</label>
        <input type="text" name="filename" value="<?= htmlspecialchars($file['filename']) ?>" required style="padding:10px; border-radius:6px; border:none; outline:none;">

        <label style="color:white; font-weight:bold;">Replace File (optional):</label>
        <input type="file" name="uploaded_file" style="padding:5px; border-radius:6px; border:none;">

        <button type="submit" style="padding:12px; border:none; border-radius:8px; background:linear-gradient(90deg,#00ffff,#007bff); color:white; font-weight:bold; cursor:pointer;">Save</button>
    </form>

    <div id="editNotification" style="display:none; text-align:center; margin-top:20px; padding:10px 20px; background: rgba(0,255,255,0.1); color:#00ffff; font-size:18px; border-radius:8px; font-weight:bold;"></div>
</div>

<script>
const editForm = document.getElementById('editForm');

editForm.addEventListener('submit', function(e) {
    e.preventDefault(); // stop normal form submission

    const formData = new FormData(editForm);

    fetch('', { // empty URL submits to the same page
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Redirect to table after successful update
        window.location.href = '/crud_read.php';
    })
    .catch(err => {
        alert('Error updating file!');
        console.error(err);
    });
});
</script>


