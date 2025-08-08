<?php
// All PHP logic is now at the top for best practice.
if(isset($_GET['edit_account'])){
    $user_session_name = $_SESSION['username'];
    
    // Fetch current user data using prepared statements
    $select_stmt = $con->prepare("SELECT * FROM user_table WHERE username=?");
    $select_stmt->bind_param("s", $user_session_name);
    $select_stmt->execute();
    $result = $select_stmt->get_result();
    $row_fetch = $result->fetch_assoc();
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_image = $row_fetch['user_image'];
    $user_mobile = $row_fetch['user_mobile'];
    $select_stmt->close();
}

if(isset($_POST['user_update'])){
    $update_id = $user_id;
    $username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $new_user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];

    // Check if a new image was uploaded
    if(!empty($new_user_image)){
        move_uploaded_file($user_image_tmp,"../assets/images/user_images/$new_user_image");
    } else {
        // If no new image, keep the old one
        $new_user_image = $user_image;
    }

    // Update query using prepared statements
    $update_stmt = $con->prepare("UPDATE user_table SET username=?, user_email=?, user_image=?, user_address=?, user_mobile=? WHERE user_id=?");
    $update_stmt->bind_param("sssssi", $username, $user_email, $new_user_image, $user_address, $user_mobile, $update_id);
    
    if($update_stmt->execute()){
        echo "<script>alert('Account updated successfully. Please login again.')</script>";
        echo "<script>window.open('logout.php','_SELF')</script>";
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        .edit-account-form {
            max-width: 600px;
            margin: auto;
        }
        .profile-pic-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .btn-update {
            background-color: #5A8DFF;
            color: white;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <h3 class="text-center mb-4 fw-bold">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="edit-account-form">
        <div class="form-outline mb-4">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" value="<?php echo $username ?>" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="<?php echo $user_email ?>" name="user_email">
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" value="<?php echo $user_address ?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <label class="form-label">Contact</label>
            <input type="text" class="form-control" value="<?php echo $user_mobile ?>" name="user_mobile">
        </div>
        <div class="d-flex align-items-center mb-4">
            <img src="../assets/images/user_images/<?php echo $user_image ?>" alt="User Image" class="profile-pic-preview me-3">
            <div class="flex-grow-1">
                <label class="form-label">Update Profile Picture</label>
                <input type="file" class="form-control" name="user_image">
            </div>
        </div>
        <div class="d-grid">
            <input type="submit" value="Update Account" class="btn btn-update" name="user_update">
        </div>
    </form>
</body>
</html>
