<?php
include("../Includes/connect.php");
include("../functions/common_function.php");
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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

        /* === MODERN FOOTER === */
        .admin-footer {
            background-color: #2c3e50;
            color: #bdc3c7;
            padding: 1rem 0;
            font-size: 0.9rem;
        }

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
                <img src="../assets/images/logo.png" alt="logo" class="logo">
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
                    <li class='nav-item'><a href='./admin_registration.php' class='nav-link'><i class="fas fa-user-plus fa-fw"></i>Register Admin</a></li>
                </ul>
            </div>
            <!-- Sidebar End -->

            <!-- Main Content Start -->
            <main class="col-md-10 ms-sm-auto px-md-4 pt-4">
                <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <h3 class="text-center mb-4">Admin Registration</h3>
                    <hr class="my-4">
                    <form action="" method="post">
                        <!-- Username -->
                        <div class="form-floating mb-4">
                            <input type="text" id="user_username" class="form-control" placeholder="Enter username" required name="user_username">
                            <label for="user_username">Username</label>
                        </div>

                        <!-- Email -->
                        <div class="form-floating mb-4">
                            <input type="email" id="user_email" class="form-control" placeholder="Enter email" required name="user_email">
                            <label for="user_email">Email</label>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-4">
                            <input type="password" id="user_password" class="form-control" placeholder="Enter password" required name="user_password">
                            <label for="user_password">Password</label>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-floating mb-4">
                            <input type="password" id="confirm_user_password" class="form-control" placeholder="Confirm password" required name="confirm_user_password">
                            <label for="confirm_user_password">Confirm Password</label>
                        </div>

                        <!-- Contact -->
                        <div class="form-floating mb-4">
                            <input type="text" id="user_contact" class="form-control" placeholder="Enter contact number" required name="user_contact">
                            <label for="user_contact">Contact Number</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <input type="submit" value="Register" class="btn btn-primary btn-lg" name="user_register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
    
</body>
</html>

<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $confirm_user_password = $_POST['confirm_user_password'];
    $user_contact = $_POST['user_contact'];

    // Check if passwords match
    if ($user_password !== $confirm_user_password) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
        exit();
    }

    // Hash the password for security
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT); 

    // Use prepared statements to prevent SQL injection
    $select_query = "SELECT * FROM admin_table WHERE username = ? OR email = ?";
    $stmt_select = $con->prepare($select_query);
    $stmt_select->bind_param("ss", $user_username, $user_email);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    
    if($result->num_rows > 0){
        echo "<script>alert('Username or email already exists.');</script>";
    } else {
        // Insert query with prepared statements
        $insert_query = "INSERT INTO admin_table (username, email, password, contact) VALUES (?, ?, ?, ?)";
        $stmt_insert = $con->prepare($insert_query);
        $stmt_insert->bind_param("ssss", $user_username, $user_email, $hash_password, $user_contact);

        if ($stmt_insert->execute()) {
            echo "<script>alert('Registration successful!');</script>";
            echo "<script>window.open('./admin_login.php','_self')</script>";
        } else {
            echo "<script>alert('Error during registration.');</script>";
        }
    }
}
?>
