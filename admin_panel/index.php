<!-- Connect File -->
<?php
// === SECURITY CHECK ADDED HERE ===
// This must be at the very top of the file
    @session_start();
    if(!isset($_SESSION['username'])){
    echo "<script>alert('Please login to access the admin panel.')</script>";
    echo "<script>window.open('admin_login.php','_self')</script>";
    exit();
}
// === END OF SECURITY CHECK ===


  include("../Includes/connect.php");
  include("../functions/common_function.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS Link Start -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome Link Start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" xintegrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
<style>
/* Global Styles */
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap');
body { 
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f4f7f6; 
    font-family: "Open Sans", sans-serif;
}
.main-wrapper {
    flex: 1;
}

/* === MODERN NAVBAR === */
.admin-navbar {
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.admin-navbar .logo {
    height: 40px;
    width: auto;
}
.admin-navbar .dropdown-menu {
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
}

/* === MODERN SIDEBAR === */
.admin-sidebar {
    background-color: #2c3e50; /* Dark blue-grey background */
    min-height: 100vh;
    padding-top: 1rem;
}
.admin-sidebar .category-title h3 {
    color: #ecf0f1;
    font-weight: bold;
    padding: 0.5rem 1.5rem;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}
.admin-sidebar .nav-link {
    color: #bdc3c7; /* Lighter grey text */
    padding: 0.75rem 1.5rem;
    display: flex;
    align-items: center;
    transition: all 0.2s ease-in-out;
    border-radius: 0.25rem;
    margin: 0.25rem 0.5rem;
}
.admin-sidebar .nav-link:hover, .admin-sidebar .nav-link.active {
    background-color: #34495e; /* Slightly lighter on hover */
    color: #ffffff;
    text-decoration: none;
}
.admin-sidebar .nav-link .fa-fw {
    width: 1.25em;
    margin-right: 0.75rem;
}

/* === DASHBOARD CARD STYLES === */
.dashboard-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease-in-out;
}
.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}
.dashboard-card .card-body {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.dashboard-card .card-icon {
    font-size: 3rem;
    opacity: 0.3;
}

/* === MODERN FOOTER === */
.admin-footer {
    background-color: #2c3e50;
    color: #bdc3c7;
    padding: 1rem 0;
    font-size: 0.9rem;
}
</style>
    
</head>
<body>
<div class="main-wrapper">
    <!-- Top Navbar Start -->
    <nav class="navbar navbar-expand-lg admin-navbar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../assets/images/logo_website.png" alt="logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <?php if(isset($_SESSION['username'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>Welcome, <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./admin_login.php">Login</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Top Navbar End -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Start-->
            <div class="col-md-2 p-0">
                <ul class="navbar-nav admin-sidebar">
                    <li class="nav-item category-title">
                        <h3 class="fw-bold">Dashboard</h3>
                    </li>
                    <li class='nav-item'><a href='index.php?view_services' class='nav-link'><i class="fas fa-eye fa-fw"></i>View Services</a></li>
                    <li class='nav-item'><a href='index.php?insert_category' class='nav-link'><i class="fas fa-folder-plus fa-fw"></i>Insert Category</a></li>
                    <li class='nav-item'><a href='./index.php?view_categories' class='nav-link'><i class="fas fa-folder-open fa-fw"></i>View Categories</a></li>
                    <li class='nav-item'><a href='./index.php?list_bookings' class='nav-link'><i class="fas fa-calendar-alt fa-fw"></i>View Bookings</a></li>
                    <li class='nav-item'><a href='./index.php?list_payments' class='nav-link'><i class="fas fa-credit-card fa-fw"></i>View Payments</a></li>
                    <li class='nav-item'><a href='./index.php?list_users' class='nav-link'><i class="fas fa-users fa-fw"></i>View Users</a></li>
                    <li class='nav-item'><a href='./index.php?list_service_provider' class='nav-link'><i class="fas fa-users fa-fw"></i>View Service Provider</a></li>
                    <li class='nav-item'><a href='./admin_registration.php' class='nav-link'><i class="fas fa-user-plus fa-fw"></i>Register Admin</a></li>
                </ul>
            </div>
            <!-- Sidebar End -->

            <!-- Main Content Start -->
            <main class="col-md-10 ms-sm-auto px-md-4 pt-4">
                <?php 
                    if(empty($_GET)){
                        // Fetching data for the dashboard cards
                        $total_bookings_query = mysqli_query($con, "SELECT COUNT(*) as count FROM bookings");
                        $total_bookings = mysqli_fetch_assoc($total_bookings_query)['count'];

                        $pending_bookings_query = mysqli_query($con, "SELECT COUNT(*) as count FROM bookings WHERE booking_status='Pending'");
                        $pending_bookings = mysqli_fetch_assoc($pending_bookings_query)['count'];

                        $total_services_query = mysqli_query($con, "SELECT COUNT(*) as count FROM service");
                        $total_services = mysqli_fetch_assoc($total_services_query)['count'];

                        $total_users_query = mysqli_query($con, "SELECT COUNT(*) as count FROM user_table");
                        $total_users = mysqli_fetch_assoc($total_users_query)['count'];

                        $total_provider_query = mysqli_query($con, "SELECT COUNT(*) as count FROM service_provider");
                        $total_provider = mysqli_fetch_assoc($total_provider_query)['count'];
                        
                        echo "
                        <h2 class='text-center mb-4'>Dashboard Overview</h2>
                        <div class='row g-4'>
                            <div class='col-md-6 col-lg-6'>
                                <div class='card dashboard-card bg-primary text-white'>
                                    <div class='card-body'>
                                        <div>
                                            <h5 class='card-title'>Total Bookings</h5>
                                            <p class='card-text fs-2 fw-bold'>{$total_bookings}</p>
                                        </div>
                                        <i class='fas fa-calendar-check card-icon'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6 col-lg-6'>
                                <div class='card dashboard-card bg-warning text-dark'>
                                    <div class='card-body'>
                                        <div>
                                            <h5 class='card-title'>Pending Bookings</h5>
                                            <p class='card-text fs-2 fw-bold'>{$pending_bookings}</p>
                                        </div>
                                        <i class='fas fa-hourglass-half card-icon'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6 col-lg-6'>
                                <div class='card dashboard-card bg-success text-white'>
                                    <div class='card-body'>
                                        <div>
                                            <h5 class='card-title'>Total Services</h5>
                                            <p class='card-text fs-2 fw-bold'>{$total_services}</p>
                                        </div>
                                        <i class='fas fa-concierge-bell card-icon'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6 col-lg-6'>
                                <div class='card dashboard-card bg-info text-white'>
                                    <div class='card-body'>
                                        <div>
                                            <h5 class='card-title'>Total Users</h5>
                                            <p class='card-text fs-2 fw-bold'>{$total_users}</p>
                                        </div>
                                        <i class='fas fa-users card-icon'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6 col-lg-6'>
                                <div class='card dashboard-card bg-dark text-white'>
                                    <div class='card-body'>
                                        <div>
                                            <h5 class='card-title'>Total Service Provider</h5>
                                            <p class='card-text fs-2 fw-bold'>{$total_provider}</p>
                                        </div>
                                        <i class='fas fa-users card-icon'></i>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                    
                    // Your existing PHP logic for including other pages remains unchanged
                    if(isset($_GET["insert_category"])){ include("insert_categories.php"); }
                    if(isset($_GET["view_services"])){ include("view_services.php"); }
                    if(isset($_GET["delete_service"])){ include("delete_service.php"); }
                    if(isset($_GET["view_categories"])){ include("view_categories.php"); }
                    if(isset($_GET["edit_category"])){ include("edit_category.php"); }
                    if(isset($_GET["delete_category"])){ include("delete_category.php"); }
                    if(isset($_GET["list_payments"])){ include("list_payments.php"); }
                    if(isset($_GET["list_users"])){ include("list_users.php"); }
                    if(isset($_GET["list_service_provider"])){ include("list_service_provider.php"); }
                    if(isset($_GET["list_bookings"])){ include("list_booking.php"); }
                    if(isset($_GET["edit_booking"])){ include("edit_booking.php"); }
                    if(isset($_GET["delete_booking"])){ include("delete_booking.php"); }
                    if(isset($_GET['edit_provider_status'])){ include('edit_provider_status.php'); }
                ?>
            </main>
            <!-- Main Content End -->
        </div>
    </div>
</div>

<!-- Footer Start -->
<footer class="admin-footer text-center">
    <div class="container">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Help Lagbe - All Rights Reserved.</p>
    </div>
</footer>
<!-- Footer End -->
    
<!-- Bootstrap JS Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
