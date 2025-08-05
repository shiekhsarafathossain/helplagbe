<?php
// All PHP logic is now at the top for best practice.
include("../includes/connect.php");
include("../functions/common_function.php");

if (isset($_POST['provider_register'])) {
    $provider_name = $_POST['provider_name'];
    $provider_email = $_POST['provider_email'];
    $provider_password = $_POST['provider_password'];
    $confirm_password = $_POST['confirm_password'];
    $provider_address = $_POST['provider_address'];
    $provider_contact = $_POST['provider_contact'];
    
    $provider_image = $_FILES['provider_image']['name'];
    $provider_image_tmp = $_FILES['provider_image']['tmp_name'];

    // Password validation
    if ($provider_password != $confirm_password) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
        exit();
    }

    // Hash the password for security
    $hash_password = password_hash($provider_password, PASSWORD_DEFAULT);

    // Check if email already exists using prepared statements
    $select_query = "SELECT * FROM service_provider WHERE provider_email=?";
    $stmt = $con->prepare($select_query);
    $stmt->bind_param("s", $provider_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('A provider with this email already exists.');</script>";
    } else {
        // Move the uploaded image to a dedicated folder
        move_uploaded_file($provider_image_tmp, "./provider_images/$provider_image");

        // Insert the new provider into the database
        $insert_query = "INSERT INTO service_provider (provider_name, provider_email, provider_password, provider_image, provider_contact, provider_address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $con->prepare($insert_query);
        $stmt_insert->bind_param("ssssss", $provider_name, $provider_email, $hash_password, $provider_image, $provider_contact, $provider_address);
        
        if ($stmt_insert->execute()) {
            echo "<script>alert('Registration successful! Please login.');</script>";
            echo "<script>window.open('login.php','_self');</script>";
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
    <title>Provider Registration - Help Lagbe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
<style>
    /* Modern Registration Page Design */
    body {
      font-family: "Open Sans", sans-serif;
    }
    .register-wrapper {
        background: url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2940&auto=format&fit=crop') no-repeat center center;
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
        max-width: 600px;
    }
    .btn-primary {
        background-color: #5A8DFF;
        border: none;
        padding: 12px;
        font-weight: 600;
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
            <h2 class="mb-4">Become a Provider</h2>
        </div>
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="provider_name" placeholder="Full Name" required name="provider_name">
                        <label for="provider_name">Full Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="provider_email" placeholder="Email Address" required name="provider_email">
                        <label for="provider_email">Email Address</label>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                 <label for="provider_image" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="provider_image" required name="provider_image">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="provider_password" placeholder="Password" required name="provider_password">
                        <label for="provider_password">Password</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required name="confirm_password">
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="provider_address" placeholder="Address" required name="provider_address">
                        <label for="provider_address">Address</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="provider_contact" placeholder="Contact Number" required name="provider_contact">
                        <label for="provider_contact">Contact Number</label>
                    </div>
                </div>
            </div>
            
            <div class="d-grid gap-2 mt-2">
                <button type="submit" class="btn btn-primary py-2" name="provider_register">Register</button>
            </div>
            <p class="small fw-bold text-center mt-3 pt-1 mb-0">
                Already have an account? <a href="login.php" style="color: #5A8DFF; text-decoration: none;">Login</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
