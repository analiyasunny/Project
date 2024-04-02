</head>
<body>
    <header id="navbar">
      <nav class="navbar-container container">
        <a href="homepage.php" class="home-link">
          <div class="navbar-logo"></div>
          Language
        </a>
        <div id="navbar-menu" class="detached">
          <ul class="navbar-links">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
              session_start();
            }         

            if (!empty($_SESSION['username'])) {
              echo '<li class="navbar-item">
                <a class="navbar-link" href="add-lang.php">Add Language</a>
              </li>';
            }            
            ?>
            <li class="navbar-item">
              <a class="navbar-link" href="lang-table.php">Show Library</a>
            </li>
            <?php
            if (!empty($_SESSION['username'])) {
              echo '
              <li class="navbar-item">
                <a class="navbar-link" href="logout.php">Logout</a>
              </li>
              <li class="navbar-item">
                <a class="navbar-link" href="#">' . $_SESSION['username'] . '</a>
              </li>';
            } 
            else {
              echo '<li class="navbar-item">
                <a class="navbar-link" href="register.php">Register</a>
              </li>
              <li class="navbar-item">
                <a class="navbar-link" href="login.php">Login</a>
              </li>';
            }
            ?>
          </ul>
        </div>
      </nav>
    </header>
    <main>