<?php
// All PHP logic is now at the top for best practice.
include("../includes/connect.php");
include("../functions/common_function.php");

if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $confirm_user_password = $_POST['confirm_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    
    $user_ip = getIPAddress();

    // Password validation
    if ($user_password != $confirm_user_password) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
        exit();
    }

    // Hash the password for security
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Check if username or email already exists using prepared statements
    $select_query = "SELECT * FROM user_table WHERE username=? OR user_email=?";
    $stmt = $con->prepare($select_query);
    $stmt->bind_param("ss", $user_username, $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Username or email already exists. Please choose another.');</script>";
    } else {
        // Move the uploaded image to the destination folder
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        // Insert the new user into the database
        $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $con->prepare($insert_query);
        $stmt_insert->bind_param("sssssss", $user_username, $user_email, $hash_password, $user_image, $user_ip, $user_address, $user_contact);
        
        if ($stmt_insert->execute()) {
            echo "<script>alert('Registration successful!');</script>";
            // Check cart items and redirect accordingly
            $select_cart = "SELECT * FROM cart_details WHERE ip_address = ?";
            $stmt_cart = $con->prepare($select_cart);
            $stmt_cart->bind_param("s", $user_ip);
            $stmt_cart->execute();
            $result_cart = $stmt_cart->get_result();

            if($result_cart->num_rows > 0){
                $_SESSION['username'] = $user_username;
                echo "<script>alert('You have items in your cart. Proceeding to checkout.');</script>";
                echo "<script>window.open('checkout.php','_self');</script>";
            } else {
                echo "<script>window.open('user_login.php','_self');</script>";
            }
            $stmt_cart->close();
        } else {
            die(mysqli_error($con));
        }
        $stmt_insert->close();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration - Help Lagbe</title>

    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts Link -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
<style>
    /* Modern Registration Page Design */
    body {
      font-family: "Open Sans", sans-serif;
      background-color: #f8f9fa;
    }
    .register-wrapper {
        background: url('https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=2940&auto=format&fit=crop') no-repeat center center;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .register-box {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 600px; /* Increased max-width for two-column layout */
    }
    .register-box h2 {
        font-weight: 700;
        color: #343a40;
    }
    .form-control {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 0.8rem 1rem;
    }
    .form-control:focus {
        border-color: #5A8DFF;
        box-shadow: 0 0 0 0.25rem rgba(90, 141, 255, 0.25);
    }
    .btn-primary {
        background-color: #5A8DFF;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #4A7BDE;
        box-shadow: 0 4px 15px rgba(90, 141, 255, 0.4);
        transform: translateY(-2px);
    }
</style>
</head>
<body>

<div class="register-wrapper">
    <div class="register-box">
        <div class="text-center">
            <a href="../index.php">
                <img src="../assets/images/logo.png" alt="Logo" class="mb-3" style="width: 70px;">
            </a>
            <h2 class="mb-4">Create an Account</h2>
        </div>
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <!-- Username -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="user_username" placeholder="Enter your username" autocomplete="off" required name="user_username">
                        <label for="user_username">Username</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="user_email" placeholder="Enter your email" autocomplete="off" required name="user_email">
                        <label for="user_email">Email</label>
                    </div>
                </div>
            </div>
            
            <!-- User Image -->
            <div class="mb-3">
                 <label for="user_image" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="user_image" required name="user_image">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="user_password" placeholder="Enter password" autocomplete="off" required name="user_password">
                        <label for="user_password">Password</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Confirm Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirm_user_password" placeholder="Confirm password" autocomplete="off" required name="confirm_user_password">
                        <label for="confirm_user_password">Confirm Password</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Address -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="user_address" placeholder="Enter your address" autocomplete="off" required name="user_address">
                        <label for="user_address">Address</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Contact -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="user_contact" placeholder="Enter your contact number" autocomplete="off" required name="user_contact">
                        <label for="user_contact">Contact Number</label>
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="d-grid gap-2 mt-2">
                <button type="submit" class="btn btn-primary py-2" name="user_register">Register</button>
            </div>
            <p class="small fw-bold text-center mt-3 pt-1 mb-0">
                Already have an account? <a href="user_login.php" style="color: #5A8DFF; text-decoration: none;">Login</a>
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
