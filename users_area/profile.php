<?php
include("../includes/connect.php");
include("../functions/common_function.php");
@session_start();

// Security check to ensure only logged-in users can access this page
if(!isset($_SESSION['username'])){
    echo "<script>alert('Please login to access your profile.')</script>";
    echo "<script>window.open('user_login.php','_self')</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Help Lagbe</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts Link -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    /* Styles to precisely match the admin panel design */
    body {
      font-family: "Open Sans", sans-serif;
      background-color: #f4f7f6; /* Light gray background from admin panel */
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .main-wrapper {
        flex: 1;
    }
    .profile-sidebar {
        background-color: #2c3e50; /* Dark blue-grey background from admin panel */
        min-height: 100%;
        padding-top: 1rem;
        color: #ecf0f1; /* Light text color from admin panel */
    }
    .profile-header {
        padding: 1.5rem;
        border-bottom: 1px solid #34495e;
    }
    .profile-picture {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #5A8DFF;
    }
    .profile-sidebar .nav-link {
        color: #bdc3c7; /* Lighter grey text from admin panel */
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        transition: all 0.2s ease-in-out;
        border-radius: 0.25rem;
        margin: 0.25rem 0.5rem;
        font-weight: 600;
    }
    .profile-sidebar .nav-link:hover,
    .profile-sidebar .nav-link.active {
        background-color: #34495e; /* Hover/active color from admin panel */
        color: #ffffff;
    }
    .profile-sidebar .nav-link .fa-fw {
        width: 1.25em;
        margin-right: 0.75rem;
    }
    .profile-content {
        padding: 2rem;
    }
    .content-card {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        min-height: 500px;
    }
    .footer-custom {
      background-color: #2c3e50;
      color: #bdc3c7;
      padding: 1rem 0;
      font-size: 0.9rem;
    }
    .nav-custom {
        background: #ffffff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
</head>
<body>
<div class="main-wrapper">
    <!-- Navbar -->
    <?php include("../includes/navbar.php"); ?>

    <!-- Main Content Area -->
    <div class="container-fluid">
        <div class="row">
            <!-- Profile Sidebar -->
            <div class="col-md-2 p-0">
                <div class="profile-sidebar text-center">
                    <div class="profile-header">
                    <?php
                        $username = $_SESSION['username'];
                        $stmt = $con->prepare("SELECT user_image FROM user_table WHERE username=?");
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row_image = $result->fetch_assoc();
                        $user_image = $row_image['user_image'];
                        
                        echo "<img src='../assets/images/user_images/$user_image' alt='User Image' class='profile-picture mb-2'>";
                        echo "<h5 class='fw-bold mt-2'>$username</h4>";
                        $stmt->close();
                    ?>
                    </div>
                    <ul class="nav flex-column text-start pt-3">
                        <li class="nav-item">
                            <a class="nav-link <?php if(!isset($_GET['edit_account']) && !isset($_GET['delete_account'])) echo 'active'; ?>" href="profile.php?my_orders"><i class="fas fa-box fa-fw"></i>Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['edit_account'])) echo 'active'; ?>" href="profile.php?edit_account"><i class="fas fa-user-edit fa-fw"></i>Edit Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['delete_account'])) echo 'active'; ?>" href="profile.php?delete_account"><i class="fas fa-trash-alt fa-fw"></i>Delete Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt fa-fw"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Profile Content -->
            <main class="col-md-10 ms-sm-auto profile-content">
                <div class="content-card">
                    <?php 
                        if(isset($_GET['edit_account'])){
                          include('edit_account.php');
                        } elseif(isset($_GET['my_orders'])){
                          include('my_orders.php');
                        } elseif(isset($_GET['delete_account'])){
                          include('delete_account.php');
                        } else {
                            include('my_orders.php');
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer-custom text-center">
    <p class="mb-0">&copy; <?php echo date("Y"); ?> Help Lagbe - All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
