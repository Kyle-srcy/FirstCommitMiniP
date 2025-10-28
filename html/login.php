<?php
session_start();
// If already logged in, send to protected index
if (!empty($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}

// Read any messages from query params
$error = $_GET['error'] ?? null;
$registered = isset($_GET['registered']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pfolio.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  </head>
  <body>
    <main class="login-wrap">
      <form action="../auth/login.php" method="post" class="login-card">
        <h2>Sign in</h2>
        <p class="lead">Enter your email and password to access the dashboard.</p>

        <?php if ($registered): ?>
          <p class="error-msg" style="color:#90ee90">Please sign in.</p>
        <?php endif; ?>

        <?php if ($error): ?>
          <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <div class="form-row">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" required placeholder="you@example.com">
        </div>

        <div class="form-row">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" required placeholder="Your password">
        </div>

        <div class="actions">
          <label class="remember"><input type="checkbox" name="remember"> Remember me</label>
          <a href="register.php">Create account</a>
        </div>

        <button type="submit" class="btn-primary">Sign in</button>

        <p style="margin-top:12px;color:rgba(255,255,255,0.65)">By signing in you agree to the site's terms.</p>
      </form>
    </main>

    <script src="../js/script.js"></script>
  </body>
</html>
