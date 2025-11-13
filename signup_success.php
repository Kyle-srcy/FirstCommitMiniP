<?php
session_start();
if (!isset($_SESSION["signup_name"])) {
    header("Location: html/signup.html");
    exit;
}

$fullname = $_SESSION["signup_name"];
// Clear session after showing message
unset($_SESSION["signup_name"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Successful</title>
<link rel="stylesheet" href="css/signup.css">

<style>
  body, html {
    height: 100%;
    margin: 0;
    font-family: 'Roboto', sans-serif;
  }
  .background-container {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: -1;
  }
  .message-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }
  .message-box {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 40px 60px;
    border-radius: 15px;
    text-align: center;
    color: #fff;
  }
  .message-box h1 {
    margin-bottom: 20px;
    font-size: 2rem;
  }
  .message-box a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 30px;
    background: #fff;
    color: #000;
    text-decoration: none;
    border-radius: 10px;
    font-weight: bold;
    transition: 0.3s;
  }
  .message-box a:hover {
    background: #f0f0f0;
  }
</style>

</head>
<body>

<div class="background-container">
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
</div>

<div class="message-container">
  <div class="message-box">
    <h1>Welcome, <?php echo htmlspecialchars($fullname); ?>!</h1>
    <p>Your account has been successfully created.</p>
    <a href="html/login.html">Go to Login</a>
  </div>
</div>

</body>
</html>
