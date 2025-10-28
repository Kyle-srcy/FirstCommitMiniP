<?php
session_start();
// Require login
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/pfolio.css">
  <link rel="stylesheet" href="../css/projects.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

</head>

<body>
 
  <header class="dashboard">
    <div class="toggle-btn" id="toggleBtn">
      <i class='bx bx-menu'></i>
    </div>
      <nav class="nav">
        <a href="index.php" class="active"><i class='bx bx-home'></i><span>Home</span></a>
        <a href="portfolio.html"><i class='bx bx-id-card'></i><span>Portfolio</span></a>
        <a href="projects.html"><i class='bx bx-briefcase'></i><span>Projects</span></a>
        <a href="../auth/logout.php"><i class='bx bx-log-out'></i><span>Logout</span></a>
      
          <div id="darkModeToggle">
            <i class='bx bx-moon'></i>
          </div>
      </nav>
  </header>

  <main class="main-content">
    <section class="home">
      <div class="content-container">
        <div class="content">
          
          <h1 class="name-glow">
            Learning, coding, and creating the future — one project at a time.
          </h1>
          
          <p class="tagline">Futuristic Student Developer ✨</p>
          
          <h4 class="des">
            WHERE IMAGINATION MEETS EXECUTION — CODE IS THE BRIDGE.
          </h4>
          
          <a href="#" class="btn-glow"> 
            Contact <i class='bx bx-down-arrow-alt'></i>
          </a>

            <div class="socials">
              <a href="https://www.facebook.com/kyle.valenzuela.148" target="_blank" title="Facebook"><i class='bx bxl-facebook'></i></a>
              <a href="https://m.me/kyle.valenzuela.148" target="_blank" title="Messenger"><i class='bx bxl-messenger'></i></a>
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to=kylejohnvalenzuela@gmail.com&su=Portfolio%20Inquiry" target="_blank" title="Gmail"><i class='bx bxl-gmail'></i></a>
              <a href="https://www.linkedin.com/in/kyle-john-valenzuela-9a4184389/" target="_blank" title="LinkedIn"><i class='bx bxl-linkedin-square'></i></a>
              <a href="https://ig.me/m/iamhaduken" target="_blank" title="Instagram"><i class='bx bxl-instagram'></i></a>
            </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <p>© 2025 Kyle John | Crafted with 
      <span class="heart">❤️</span> HTML | CSS | JavaScript</p>
    </p>
  </footer>


  <script src="../js/script.js"></script>

</body>
</html>
