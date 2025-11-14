<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<link rel="stylesheet" href="../css/signup.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

</head>
<body>

<!-- Background Blobs -->
<div class="background-container">
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
</div>

<div class="container">
    <form class="glass-form" id="signupForm" action="../register.php" method="POST">
        <div class="form-header">
            <h1>Create Account</h1>
            <p>Join us today and get started</p>
        </div>

        <div class="form-group">
            <label for="fullname">User Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="Username" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="submit-btn">Sign Up</button>

        <div class="form-footer">
            Already have an account? <a href="../login.php">Sign In</a>
        </div>
    </form>
</div>

</body>
</html>
