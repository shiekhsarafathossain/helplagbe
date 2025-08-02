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
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap');
        body { 
            font-family: "Open Sans", sans-serif;
            background-color: #f4f7f6; 
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <h3 class="text-center mb-4">Admin & Staff Registration</h3>
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

                        <!-- Admin Type -->
                        <div class="form-floating mb-4">
                            <select class="form-select" id="admin_verify" name="admin_verify" required>
                                <option value="" selected disabled>Select Role</option>
                                <option value="yes">Admin</option>
                                <option value="no">Service Provider (Staff)</option>
                            </select>
                            <label for="admin_verify">Account Type</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <input type="submit" value="Register" class="btn btn-primary btn-lg" name="user_register">
                        </div>

                        <p class="small fw-bold text-center mt-4 mb-0">
                            Already have an account? <a href="./admin_login.php">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $confirm_user_password = $_POST['confirm_user_password'];
    $user_contact = $_POST['user_contact'];
    $admin_verify = $_POST['admin_verify'];

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
        $insert_query = "INSERT INTO admin_table (username, email, password, contact, admin) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $con->prepare($insert_query);
        $stmt_insert->bind_param("sssss", $user_username, $user_email, $hash_password, $user_contact, $admin_verify);

        if ($stmt_insert->execute()) {
            echo "<script>alert('Registration successful!');</script>";
            echo "<script>window.open('./admin_login.php','_self')</script>";
        } else {
            echo "<script>alert('Error during registration.');</script>";
        }
    }
}
?>
