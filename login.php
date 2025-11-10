<?php
session_start();
require_once "db.php";  // ✅ connects to your database

// Check if form is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL
    $stmt = $conn->prepare("SELECT id, fullname, email, password FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    
    // If user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // ✅ Verify password (if hashed)
        if (password_verify($password, $user["password"])) {

            // Save user session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["fullname"] = $user["fullname"];
            $_SESSION["email"] = $user["email"];

            // ✅ Redirect to dashboard or homepage
            header("Location: html/index.html");
            exit();
        } else {
            echo "Wrong password.";
        }

    } else {
        echo "Email not found.";
    }

} else {
    echo "Invalid request.";
}
