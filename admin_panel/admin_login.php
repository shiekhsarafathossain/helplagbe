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
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <img src="../assets/images/logo.png" alt="Logo" style="height: 60px;">
                        <h3 class="mt-3">Admin Panel Login</h3>
                    </div>
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Enter your username" required>
                            <label for="user_username">Username</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter your password" required>
                            <label for="user_password">Password</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="user_login" class="btn btn-primary btn-lg">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>

</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    // Use prepared statements to prevent SQL injection
    $select_query = "SELECT * FROM admin_table WHERE username = ?";
    $stmt = $con->prepare($select_query);
    $stmt->bind_param("s", $user_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row_data = $result->fetch_assoc();
        // Verify the hashed password
        if(password_verify($user_password, $row_data['password'])){
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials!')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials!')</script>";
    }
}
?>
