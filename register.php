<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match!");
    }

    // Check email
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        die("Email already registered. Try logging in instead.");
    }
    $check_email->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $hashed_password);

    if ($stmt->execute()) {
        // ✅ Save name in session and redirect
        $_SESSION["signup_name"] = $fullname;
        header("Location: signup_success.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: signup.html");
    exit();
}
