<?php
session_start();
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/register.php');
    exit;
}

$username = trim($_POST['username'] ?? ''); // full name
$handle = trim($_POST['handle'] ?? '');   // username/handle
$email = trim($_POST['email'] ?? '');
$pwd = $_POST['password'] ?? '';
$birthdate = trim($_POST['birthdate'] ?? '');

if ($username === '' || $handle === '' || $email === '' || $pwd === '') {
    header('Location: ../html/register.php?error=Please+fill+all+fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../html/register.php?error=Invalid+email');
    exit;
}

if (strlen($pwd) < 6) {
    header('Location: ../html/register.php?error=Password+too+short');
    exit;
}

// validate birthdate if provided (YYYY-MM-DD)
if ($birthdate !== '') {
    $d = DateTime::createFromFormat('Y-m-d', $birthdate);
    if (!($d && $d->format('Y-m-d') === $birthdate)) {
        header('Location: ../html/register.php?error=Invalid+birthdate');
        exit;
    }
}

// Ensure optional columns exist: 'handle' and 'birthdate'
$res = $mysqli->query("SHOW COLUMNS FROM users LIKE 'handle'");
if (!($res && $res->num_rows)) {
    $ok = $mysqli->query("ALTER TABLE users ADD COLUMN handle VARCHAR(80) DEFAULT NULL AFTER username");
    if (!$ok) {
        header('Location: ../html/register.php?error=DB+schema+change+failed');
        exit;
    }
}
$res = $mysqli->query("SHOW COLUMNS FROM users LIKE 'birthdate'");
if (!($res && $res->num_rows)) {
    $ok = $mysqli->query("ALTER TABLE users ADD COLUMN birthdate DATE DEFAULT NULL AFTER email");
    if (!$ok) {
        header('Location: ../html/register.php?error=DB+schema+change+failed');
        exit;
    }
}

// Check if email or handle already exists
if (!($stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ? OR handle = ? LIMIT 1"))) {
    header('Location: ../html/register.php?error=db');
    exit;
}
$stmt->bind_param('ss', $email, $handle);
$stmt->execute();
$res = $stmt->get_result();
if ($res->fetch_assoc()) {
    header('Location: ../html/register.php?error=Email+or+username+already+in+use');
    exit;
}

// Insert new user
// Insert new user (include handle and birthdate if available)
$hash = password_hash($pwd, PASSWORD_DEFAULT);
// Use INSERT with explicit columns
if (!($ins = $mysqli->prepare("INSERT INTO users (username, handle, email, password_hash, birthdate) VALUES (?, ?, ?, ?, ?)"))) {
    header('Location: ../html/register.php?error=db');
    exit;
}
$bd = ($birthdate === '') ? null : $birthdate;
$ins->bind_param('sssss', $username, $handle, $email, $hash, $bd);
if ($ins->execute()) {
    // Set a session flag for the landing page
    $_SESSION['pending_registration'] = true;
    header('Location: ../html/creating-account.php');
    exit;
}

header('Location: ../html/register.php?error=Unable+to+create+account');
exit;
