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
                <a href="crud_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="5">No files uploaded yet.</td></tr>
<?php endif; ?>
</table>
