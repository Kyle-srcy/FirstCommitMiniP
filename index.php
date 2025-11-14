<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/pfolio.css">
  <link rel="stylesheet" href="css/projects.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

</head>

<body>

  <div class="background-container">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <div class="main-container">
    <div class="login-card">
      <div class="header">
        <h1>Welcome Back</h1>
          <p>Sign in to your account to continue</p>
      </div>

      <form class="form" action="login.php" method="POST"> 
        <div class="form-group">
          <label for="email">Email Address</label>
          <input id="email" type="email" placeholder="you@example.com" name="email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="••••••••" required />
        </div>

        <div class="form-footer">
          <label class="checkbox-group">
            <input type="checkbox" />
            <span>Remember me</span>
          </label>
          <a href="#" class="forgot-password">Forgot password?</a>
        </div>

        <button type="submit" class="submit-btn" id="submitBtn">
          Sign In
        </button>
      </form>

      <div class="divider">
        <div class="divider-line"></div>
        <span class="divider-text">or</span>
        <div class="divider-line"></div>
      </div>

      <p class="signup-text">
        Don't have an account?
        <a href="html/signup.php" class="signup-link">Sign up</a>
      </p>
    </div>
  </div>
  
  <script src="js/login.js"></script>
</body>
</html>
