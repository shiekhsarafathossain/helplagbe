<?php
@session_start();
// Security check to ensure only logged-in providers can access this page
if(!isset($_SESSION['provider_id'])){
    echo "<script>alert('Please login to access the provider panel.')</script>";
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}

include("../includes/connect.php");
include("../functions/common_function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    /* Using the same styles as your admin panel for consistency */
    body { 
        background-color: #f4f7f6; 
        font-family: "Open Sans", sans-serif;
    }
    .admin-navbar {
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .admin-sidebar {
        background-color: #2c3e50;
        min-height: 100vh;
    }
    .admin-sidebar .nav-link {
        color: #bdc3c7;
        padding: 0.75rem 1.5rem;
        transition: all 0.2s ease-in-out;
    }
    .admin-sidebar .nav-link:hover, .admin-sidebar .nav-link.active {
        background-color: #34495e;
        color: #ffffff;
    }
    .admin-sidebar .nav-link .fa-fw {
        width: 1.25em;
        margin-right: 0.75rem;
    }
</style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg admin-navbar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="../assets/images/logo.png" alt="logo" style="height:40px;"></a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome, <?php echo $_SESSION['provider_name']; ?></a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0">
                <ul class="navbar-nav admin-sidebar">
                    <li class="nav-item p-3">
                        <h3 class="fw-bold text-white">Dashboard</h3>
                    </li>
                    <li class='nav-item'><a href='index.php?insert_service' class='nav-link'><i class="fas fa-plus-circle fa-fw"></i>Insert Service</a></li>
                    <li class='nav-item'><a href='index.php?view_services' class='nav-link'><i class="fas fa-eye fa-fw"></i>View My Services</a></li>
                    <li class='nav-item'><a href='index.php?view_bookings' class='nav-link'><i class="fas fa-calendar-alt fa-fw"></i>View My Bookings</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-md-4 pt-4">
                <?php
                    // Routing logic to include the correct page content
                    if(isset($_GET['insert_service'])){
                        include('insert_service.php');
                    } elseif(isset($_GET['view_services'])){
                        include('view_services.php');
                    } elseif(isset($_GET['edit_service'])){
                        include('edit_service.php');
                    } elseif(isset($_GET['delete_service'])){
                        include('delete_service.php');
                    } elseif(isset($_GET['view_bookings'])){
                        include('view_bookings.php');
                    } elseif(isset($_GET['edit_booking'])){
                        include('edit_booking.php');
                    } else {
                        // Default view when no other page is selected
                        include('view_bookings.php');
                    }
                ?>
            </main>
        </div>
    </div>
</body>
</html>
