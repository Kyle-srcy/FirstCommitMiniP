<?php
session_start();

// If logged in already, redirect to index
if (!empty($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}

// Handle success and error messages
$error = $_GET['error'] ?? null;
$created = isset($_GET['created']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/register.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  </head>
  <body>
    <main class="auth-wrap">
        <div class="flip-container">
            <div class="flip-card">
                <!-- Front of card (Login Preview) -->
                <div class="flip-front">
                    <div class="login-preview">
                        <h2>Welcome Back!</h2>
                        <p class="lead">Already have an account? Sign in to continue your journey.</p>
                        
                        <div class="preview-illustration">
                            <svg width="220" height="140" viewBox="0 0 220 140" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <defs>
                                    <linearGradient id="g" x1="0" x2="1">
                                        <stop offset="0%" stop-color="#7c3aed" />
                                        <stop offset="100%" stop-color="#6d28d9" />
                                    </linearGradient>
                                </defs>
                                <rect x="10" y="10" width="200" height="120" rx="12" fill="url(#g)" opacity="0.12" />
                                <circle cx="60" cy="60" r="18" fill="#7c3aed" opacity="0.9" />
                                <rect x="95" y="45" width="90" height="10" rx="4" fill="#7c3aed" opacity="0.9" />
                                <rect x="95" y="65" width="60" height="8" rx="4" fill="#7c3aed" opacity="0.75" />
                            </svg>
                        </div>

                        <button id="flipToRegister" class="btn-primary">Create Account</button>
                    </div>
                </div>

                <!-- Back of card (Registration Form) -->
                <div class="flip-back">
                    <form action="../register.php" method="post" class="register-form" id="register-form">
                        <h2>Create Account</h2>
                        <p class="lead">Join us to showcase your projects and track progress.</p>

          <?php if ($created): ?>
            <p class="success-msg">✅ Account created successfully! Please sign in.</p>
          <?php endif; ?>

          <?php if ($error): ?>
            <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
          <?php endif; ?>

          <div class="form-row">
            <label for="fullname">Full Name</label>
            <input id="fullname" name="username" type="text" required placeholder="Your full name">
          </div>

          <div class="form-row">
            <label for="handle">Username</label>
            <input id="handle" name="handle" type="text" required placeholder="e.g. kyle123">
          </div>

          <div class="form-row">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" required placeholder="you@example.com">
          </div>

          <div class="form-row">
            <label for="birthdate">Birthdate</label>
            <input id="birthdate" name="birthdate" type="date" required>
          </div>

          <div class="form-row">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required placeholder="Password (min 6 chars)" minlength="6">
            <div class="password-strength" id="password-strength"></div>
          </div>

          <div class="form-row">
            <label for="confirm_password">Confirm Password</label>
            <input id="confirm_password" name="confirm_password" type="password" required placeholder="Re-enter your password">
          </div>

          <button type="submit" class="btn-primary">Create Account</button>

                        <div class="actions">
                            <p>Already have an account? <a href="#" id="flipToLogin">Sign in here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Flip animation controls
        document.getElementById('flipToRegister').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.flip-card').classList.add('flipped');
        });

        document.getElementById('flipToLogin').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'login.php';
        });

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/\d/)) strength++;
            if (password.match(/[^a-zA-Z\d]/)) strength++;
            return strength;
        }

        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strength = checkPasswordStrength(password);
            const strengthIndicator = document.getElementById('password-strength');
            
            strengthIndicator.className = 'password-strength';
            if (password.length === 0) {
                strengthIndicator.className = 'password-strength';
            } else if (strength <= 2) {
                strengthIndicator.classList.add('weak');
            } else if (strength === 3) {
                strengthIndicator.classList.add('medium');
            } else {
                strengthIndicator.classList.add('strong');
            }
        });

        // Form validation
        document.getElementById('register-form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const handle = document.getElementById('handle').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return;
            }

            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long!');
                return;
            }

            if (!/^[a-zA-Z0-9_-]+$/.test(handle)) {
                e.preventDefault();
                alert('Username can only contain letters, numbers, underscores, and hyphens!');
                return;
            }
        });

        // Floating label effect
        document.querySelectorAll('.form-row input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('focused');
            });
        });
    </script>
  </body>
</html>
