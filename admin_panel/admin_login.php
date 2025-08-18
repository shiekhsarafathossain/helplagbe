<?php
include("../Includes/connect.php");
@session_start();

// Redirect if already logged in
if(isset($_SESSION['username'])){
    header("Location: ./index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login</title>
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
        <h2 class="mb-4">Admin Login</h2>
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="admin_username" placeholder="Enter your username" required name="admin_username" re>
                <label for="admin_username">Username</label>
            </div>
            
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="admin_password" placeholder="Enter password" required name="admin_password">
                <label for="admin_password">Password</label>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="admin_login">Login</button>
            </div>
            
        </form>
    </div>
</div>

</body>
</html>

<?php
if(isset($_POST['admin_login'])){
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    $stmt = $con->prepare("SELECT * FROM admin_table WHERE username=?");
    $stmt->bind_param("s", $admin_username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row_data = $result->fetch_assoc();
        if(password_verify($admin_password, $row_data['password'])){
            $_SESSION['admin_id'] = $row_data['admin_id'];
            $_SESSION['username'] = $row_data['username']; 
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
