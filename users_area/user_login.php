<?php
// All PHP logic is now at the top for best practice.
include("../includes/connect.php");
include("../functions/common_function.php");
@session_start();

// Handle the form submission
if(isset($_POST['user_login'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    // Use prepared statements to prevent SQL injection
    $select_query = "SELECT * FROM user_table WHERE username=?";
    $stmt = $con->prepare($select_query);
    $stmt->bind_param("s", $user_username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row_data = $result->fetch_assoc();
        // Verify the hashed password
        if(password_verify($user_password, $row_data['user_password'])){
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Login Successful')</script>";
            // Simplified redirect: always go to the homepage after login
            echo "<script>window.open('../index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials!')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials!')</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Help Lagbe</title>

    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts Link -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
<style>
    /* Modern Login Page Design */
    body {
      font-family: "Open Sans", sans-serif;
      background-color: #f8f9fa;
    }
    .login-wrapper {
        background: url('../assets/images/background.png') no-repeat center center;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    .login-box {
        background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
        backdrop-filter: blur(10px); /* Frosted glass effect */
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 450px;
    }
    .login-box h2 {
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

<div class="login-wrapper">
    <div class="login-box text-center">
        <a href="../index.php">
            <img src="../assets/images/logo_website.png" alt="Logo" class="mb-4" style="width: 80px;">
        </a>
        <h2 class="mb-4">Welcome Back!</h2>
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="user_username" placeholder="Enter your username" autocomplete="off" required name="user_username">
                <label for="user_username">Username</label>
            </div>
            
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="user_password" placeholder="Enter password" autocomplete="off" required name="user_password">
                <label for="user_password">Password</label>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary py-2" name="user_login">Login</button>
            </div>
            
            <p class="small fw-bold text-center mt-4 pt-1 mb-0">
                Don't have an account? <a href="user_registration.php" style="color: #5A8DFF; text-decoration: none;">Register Now</a>
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
