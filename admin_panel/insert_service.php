<?php
include("../Includes/connect.php");
session_start(); // Start the session to access session variables

// Handle form submission for inserting a new service
if(isset($_POST['insert_service_btn'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $keywords = $_POST['keywords'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $status = 'true';

    // Accessing images and their temporary names
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];
    
    $temp_image1 = $_FILES['image1']['tmp_name'];
    $temp_image2 = $_FILES['image2']['tmp_name'];
    $temp_image3 = $_FILES['image3']['tmp_name'];

    // Checking for empty fields
    if($title=='' || $description=='' || $keywords=='' || $category=='' || $price=='' || $name=='' || $contact=='' || $address=='' || $image1=='' || $image2=='' || $image3==''){
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    } else {
        // Move uploaded files to the destination folder
        move_uploaded_file($temp_image1,"../assets/images/service_images/$image1");
        move_uploaded_file($temp_image2,"../assets/images/service_images/$image2");
        move_uploaded_file($temp_image3,"../assets/images/service_images/$image3");

        // Insert query using prepared statements for security
        $insert_services = "INSERT INTO `service` (title, description, keywords, category_id, image1, image2, image3, price, name, contact, address, date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
        
        $stmt = $con->prepare($insert_services);
        $stmt->bind_param("sssissssiss", $title, $description, $keywords, $category, $image1, $image2, $image3, $price, $name, $contact, $address, $status);
        
        if($stmt->execute()){
            echo "<script>alert('Service has been inserted successfully')</script>";
            echo "<script>window.open('./index.php?view_services','_self')</script>";
        } else {
            echo "<script>alert('Failed to insert service.')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Service</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap');
        body { 
            font-family: "Open Sans", sans-serif;
            background-color: #f4f7f6; 
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-wrapper {
            flex: 1;
        }
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
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
                            <li><a class="dropdown-item" href="./index.php">Dashboard</a></li>
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

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="text-center mb-4">Insert New Service</h3>
                        <hr class="my-4">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- Service Details Section -->
                            <h5 class="mb-3">Service Details</h5>
                            <div class="form-floating mb-4">
                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter service title" required>
                                <label for="title">Service Title</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea id="description" name="description" class="form-control" placeholder="Enter service description" style="height: 100px" required></textarea>
                                <label for="description">Service Description</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Enter service keywords" required>
                                <label for="keywords">Keywords (comma separated)</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-4">
                                        <select name="category" class="form-select" required>
                                            <option value="">Select a Category</option>
                                            <?php
                                            $select_query = "SELECT * FROM categories";
                                            $result_query = mysqli_query($con, $select_query);
                                            while($row = mysqli_fetch_assoc($result_query)){
                                                $category_title = $row['category_title'];
                                                $category_id = $row['category_id'];
                                                echo "<option value='$category_id'>$category_title</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="category">Service Category</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter service price" required>
                                        <label for="price">Price (BDT)</label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Provider Details Section -->
                            <h5 class="mb-3 mt-4">Service Provider Details</h5>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter provider name" required>
                                        <label for="name">Provider Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-floating mb-4">
                                        <input type="text" id="contact" name="contact" class="form-control" placeholder="Enter provider contact" required>
                                        <label for="contact">Provider Contact</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" id="address" name="address" class="form-control" placeholder="Enter provider address" required>
                                <label for="address">Provider Area/Address</label>
                            </div>

                            <!-- Image Uploads Section -->
                            <h5 class="mb-3 mt-4">Service Images</h5>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="image1" class="form-label">Image 1 (Required)</label>
                                    <input type="file" name="image1" id="image1" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="image2" class="form-label">Image 2 (Required)</label>
                                    <input type="file" name="image2" id="image2" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="image3" class="form-label">Image 3 (Required)</label>
                                    <input type="file" name="image3" id="image3" class="form-control" required>
                                </div>
                            </div>

                            <div class="d-grid mt-3">
                                <input type="submit" name="insert_service_btn" value="Insert Service" class="btn btn-primary btn-lg">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Start -->
<footer class="admin-footer text-center mt-auto">
    <div class="container">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Help Lagbe - All Rights Reserved.</p>
    </div>
</footer>
<!-- Footer End -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
