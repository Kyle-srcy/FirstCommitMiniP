<?php
session_start();
require_once __DIR__ . '/../db.php';

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/login.html');
    exit;
}

$email = trim($_POST['email'] ?? '');
$pwd = $_POST['password'] ?? '';

if ($email === '' || $pwd === '') {
    header('Location: ../html/login.html?error=empty');
    exit;
}

// Prepare statement to prevent SQL injection
if (!($stmt = $mysqli->prepare("SELECT id, username, email, password_hash FROM users WHERE email = ? LIMIT 1"))) {
    header('Location: ../html/login.html?error=db');
    exit;
}
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($pwd, $user['password_hash'])) {
    // Successful login
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    // Redirect to home or dashboard
    header('Location: ../html/index.php');
    exit;
}

// Invalid credentials
header('Location: ../html/login.html?error=invalid');
exit;
