<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    die("You must log in to view files.");
}

// Show only files uploaded by this user
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM files WHERE uploaded_by=? ORDER BY uploaded_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; color:white; background:rgba(255,255,255,0.05); border-radius:10px;">
<tr>
    <th>ID</th>
    <th>File Name</th>
    <th>Path</th>
    <th>Date Uploaded</th>
    <th>Actions</th>
</tr>

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['filename']) ?></td>
            <td><a href="<?= htmlspecialchars($row['filepath']) ?>" target="_blank">View</a></td>
            <td><?= $row['uploaded_at'] ?></td>
            <td>
                <a href="crud_update.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="crud_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>

            </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="5">No files uploaded yet.</td></tr>
<?php endif; ?>
</table>

<!-- Centered Alert -->
<div id="deleteAlert" style="
        display:none;
        position:fixed;
        top:50%;
        left:50%;
        transform:translate(-50%, -50%);
        background:rgba(0,0,0,0.85);
        color:#00ffff;
        padding:25px 40px;
        border-radius:12px;
        box-shadow:0 0 20px rgba(0,255,255,0.5);
        font-size:18px;
        font-weight:bold;
        text-align:center;
        z-index:9999;"
>
    File deleted successfully!
</div>

<script src="js/crud.js" defer></script>



