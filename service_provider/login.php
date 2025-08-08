<?php
include("../includes/connect.php");
include("../functions/common_function.php");
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Login - Help Lagbe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
<style>
    body {
      font-family: "Open Sans", sans-serif;
    }
    .login-wrapper {
        background: url('../assets/images/background.png') no-repeat center center;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-box {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 450px;
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

<div class="login-wrapper">
    <div class="login-box text-center">
        <img src="../assets/images/logo_website.png" alt="Logo" class="mb-4" style="width: 80px;">
        <h2 class="mb-4">Provider Login</h2>
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="provider_email" placeholder="Enter your email" required name="provider_email">
                <label for="provider_email">Email</label>
            </div>
            
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="provider_password" placeholder="Enter password" required name="provider_password">
                <label for="provider_password">Password</label>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="provider_login">Login</button>
            </div>
            
            <!-- Link to the new registration page -->
            <p class="small fw-bold text-center mt-4 pt-1 mb-0">
                Don't have an account? <a href="registration.php" style="color: #5A8DFF; text-decoration: none;">Register Now</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>

<?php
if(isset($_POST['provider_login'])){
    $provider_email = $_POST['provider_email'];
    $provider_password = $_POST['provider_password'];

    $stmt = $con->prepare("SELECT * FROM service_provider WHERE provider_email=?");
    $stmt->bind_param("s", $provider_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row_data = $result->fetch_assoc();
        if(password_verify($provider_password, $row_data['provider_password'])){
            $_SESSION['provider_id'] = $row_data['provider_id'];
            $_SESSION['provider_name'] = $row_data['provider_name'];
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials!')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials!')</script>";
    }
    $stmt->close();
}
?>
