<!-- Self-contained styles for the navbar components -->
<style>
    .logo {
        width: 60px !important; /* Controls the size of your logo */
        height: auto !important;
    }

    .login-bar {
        background-color: #f8f9fa; /* Light grey for the top bar */
        padding: 0.25rem 1rem;
        font-size: 0.9rem;
    }
    .login-bar .nav-link {
        color: #6c757d !important; /* Muted text color */
        font-weight: 600;
    }
    .login-bar .nav-link:hover {
        color: #343a40 !important;
    }

    .nav-custom {
      background-color: #ffffff;
      border-bottom: 1px solid #dee2e6;
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
    }
    .nav-custom .nav-link {
        color: #343a40 !important;
        font-weight: 600;
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .nav-custom .nav-link.active,
    .nav-custom .nav-link:hover {
        color: #5A8DFF !important;
    }

    .nav-custom .btn-outline-primary {
        border-color: #5A8DFF;
        color: #5A8DFF;
    }
    .nav-custom .btn-outline-primary:hover {
        background-color: #5A8DFF;
        color: white;
    }
</style>

<!-- Top Bar (Login/Welcome) -->
<div class="navbar navbar-expand-lg login-bar">
    <div class="container-fluid">
        <ul class="navbar-nav ms-auto">
        <?php
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>Welcome Guest</a>
          </li>";
          }
          else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='./users_area/profile.php'>Welcome ".$_SESSION['username']."</a>
          </li>";
          }
       
          if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='./users_area/user_login.php'>Login</a>
          </li>";
          }
          else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='./users_area/logout.php'>Logout</a>
          </li>";
          }
        ?>
        </ul>
    </div>
</div>

<!-- Main Navigation -->
<nav class="navbar navbar-expand-lg nav-custom sticky-top shadow-sm">
  <div class="container-fluid">
    
    <a class="navbar-brand" href="index.php"><img src="./assets/images/logo_website.png" alt="logo" class="logo" style="width: 60px !important; height: auto !important;"></a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="./service.php">Services</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="./contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./faq.php">FAQ</a>
        </li>
      </ul>
      <!-- UPDATED SEARCH FORM -->
      <form class="d-flex" role="search" action="search.php" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data" required>
        <button class="btn btn-outline-primary" type="submit" name="search_data_product" value="Search">Search</button>
      </form>
    </div>
  </div>
</nav>
