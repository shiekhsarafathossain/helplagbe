<?php
// All PHP logic is now at the top for best practice
$username_session = $_SESSION['username'];

if(isset($_POST['delete'])){
    // Use prepared statements to prevent SQL injection
    $delete_query = "DELETE FROM user_table WHERE username=?";
    $stmt = $con->prepare($delete_query);
    $stmt->bind_param("s", $username_session);
    
    if($stmt->execute()){
        session_destroy();
        echo "<script>alert('Account Deleted Successfully')</script>";
        echo "<script>window.open('../index.php','_SELF')</script>";
    }
    $stmt->close();
}

if(isset($_POST['dont_delete'])){
    // Redirect back to the main profile page if the user cancels
    echo "<script>window.open('profile.php','_SELF')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        .delete-container {
            max-width: 500px;
            margin: auto;
            padding: 2rem;
            border: 1px solid #dc3545;
            border-radius: 10px;
            background-color: #f8d7da; /* Light red background for warning */
        }
    </style>
</head>
<body>
    <div class="text-center delete-container">
        <h3 class="text-danger mb-4">Delete Account</h3>
        <p class="mb-4">Are you sure you want to delete your account? This action is permanent and cannot be undone.</p>
        <form action="" method="post">
            <div class="d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-secondary" name="dont_delete">Cancel</button>
                <button type="submit" class="btn btn-danger" name="delete">Delete Account</button>
            </div>
        </form>
    </div>
</body>
</html>
