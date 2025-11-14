<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/pfolio.css">
  <link rel="stylesheet" href="../css/projects.css">
  <link rel="stylesheet" href="../css/crud.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

</head>

<body>
  <header class="dashboard">
    <div class="toggle-btn" id="toggleBtn"><i class='bx bx-menu'></i></div>
    <nav class="nav">
      <a href="../html/index.html"><i class='bx bx-home'></i><span>Home</span></a>
      <a href="../html/portfolio.html"><i class='bx bx-id-card'></i><span>Portfolio</span></a>
      <a href="../html/projects.html"><i class='bx bx-briefcase'></i><span>Projects</span></a>
      <a href="../html/crud.html" class="active"><i class='bx bx-folder'></i><span>File Manager</span></a>
      <a href="../index.php"><i class='bx bx-log-out'></i><span>Logout</span></a>
      
      <div id="darkModeToggle"><i class='bx bx-moon'></i></div>
    </nav>
  </header>

  <main class="main-content">
    <section class="home">
      <div class="content-container">
        <div class="content">
          <h1 class="name-glow">File Management Dashboard 📂</h1>
          <p class="tagline">Upload, edit, and manage your files in style.</p>

          <form action="crud_create.php" method="POST" enctype="multipart/form-data" class="upload-form">
            <input type="text" name="filename" placeholder="Enter File Name" required>
            <input type="file" name="uploaded_file" required>
            <button type="submit">Upload File</button>
          </form>

            <div class="table-container">
                <h3>Uploaded Files</h3>
                    <?php include "crud_read.php"; ?>
            </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
    <p>© 2025 Kyle John | Crafted with 
      <span class="heart">❤️</span> HTML | CSS | JavaScript</p>
    </p>
  </footer>

<script src="../js/script.js"></script>
<script src="../js/crud.js"></script>

</body>
</html>
