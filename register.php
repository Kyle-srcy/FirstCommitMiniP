<?php
session_start();
require_once "db.php"; // Make sure this file connects properly to your MySQL database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect and sanitize form data
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: register.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format!";
        header("Location: register.php");
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: register.php");
        exit;
    }

    // Check if email already exists
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email is already registered!";
        $stmt->close();
        $mysqli->close();
        header("Location: register.php");
        exit;
    }

    $stmt->close();

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $stmt = $mysqli->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! You can now log in.";
        header("Location: login.php");
    } else {
        $_SESSION['error'] = "Database error: " . $stmt->error;
        header("Location: register.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    // Redirect if accessed directly
    header("Location: register.php");
    exit;
}
?>
