<?php
// Simple admin-creation helper. Run locally only (XAMPP dev).
// Usage:
// 1) Open in browser: http://localhost/MiniProject/migration/create_admin.php
// 2) Fill username, email and password and submit to create a user in mini_project.users.

require_once __DIR__ . '/../db.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pwd = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $pwd === '') {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email.';
    } elseif (strlen($pwd) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        // Ensure DB and table exist
        $check = $mysqli->query("SHOW TABLES LIKE 'users'");
        if (!($check && $check->num_rows)) {
            $error = "Users table not found - run migration/create_users.sql first.";
        } else {
            // Check duplicate
            $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $res->fetch_assoc()) {
                $error = 'Email already in use.';
            } else {
                $hash = password_hash($pwd, PASSWORD_DEFAULT);
                $ins = $mysqli->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
                $ins->bind_param('sss', $username, $email, $hash);
                if ($ins->execute()) {
                    header('Location: /MiniProject/html/login.php?registered=1');
                    exit;
                } else {
                    $error = 'Insert failed: ' . $mysqli->error;
                }
            }
        }
    }
}

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Create admin</title>
    <style>
      body{font-family:Arial,Helvetica,sans-serif;background:#101018;color:#fff;padding:24px}
      .card{background:rgba(255,255,255,0.03);padding:18px;border-radius:10px;border:1px solid rgba(255,0,150,0.08);max-width:520px}
      label{display:block;margin-top:10px}
      input{width:100%;padding:8px;margin-top:6px;border-radius:6px;border:1px solid rgba(255,255,255,0.06);background:transparent;color:#fff}
      .err{color:#ff9090}
      .ok{color:#90ee90}
    </style>
  </head>
  <body>
    <h2>Create admin user (local only)</h2>
    <div class="card">
      <?php if ($error): ?><p class="err"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
      <form method="post">
        <label>Full name
          <input name="username" required value="<?php echo htmlspecialchars($_POST['username'] ?? 'Admin'); ?>">
        </label>
        <label>Email
          <input type="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? 'admin@example.com'); ?>">
        </label>
        <label>Password
          <input type="password" name="password" required placeholder="min 6 chars">
        </label>
        <div style="margin-top:12px">
          <button type="submit">Create user</button>
        </div>
      </form>
      <p style="margin-top:12px;color:#ccc;font-size:90%">After creation you'll be redirected to the login page.</p>
    </div>
  </body>
</html>
