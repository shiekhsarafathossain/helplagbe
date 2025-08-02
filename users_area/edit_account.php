<?php
if(isset($_GET['edit_account'])){
  //  session_start(); // Start the session if not already started

    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM user_table WHERE username='$user_session_name'";
    $result_query = mysqli_query($con,$select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_image = $row_fetch['user_image'];
    $user_mobile = $row_fetch['user_mobile'];

    if(isset($_POST['user_update'])){
        $update_id = $user_id;
        $username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];

        if(!empty($_FILES['user_image']['name'])){
            $user_image = $_FILES['user_image']['name'];
            $user_image_tmp = $_FILES['user_image']['tmp_name'];
            move_uploaded_file($user_image_tmp,"../assets/images/user_images/$user_image");
        }

        // Update query
        $update_data = "UPDATE user_table SET username='$username', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$user_id";

        $result_query_update = mysqli_query($con, $update_data);

        if($result_query_update){
            echo "<script>alert('Data updated successfully')</script>";
            echo "<script>window.open('logout.php','_SELF')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <script>
        function updateFileName(input) {
            const fileLabel = document.getElementById('file-label');
            fileLabel.textContent = input.files.length > 0 ? input.files[0].name : 'Choose an image';
        }
    </script>
</head>
<body class="open-sans-font">
    <h3 class="text-center text-success mb-4 fw-bold">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email">
        </div>
        
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>" name="user_mobile">
        </div>
        <div class="form-outline mb-4">
            <label id="file-label" class="text-success mb-4 fw-bold">Choose Picture</label>
            <input type="file" class="form-control w-50 m-auto" name="user_image" onchange="updateFileName(this)">
            
            <!-- <img src="../assets/images/user_images/<?php// echo $user_image ?>" alt="User Image" style="width:100px"> -->
        </div>
        <div class="form-outline mb-4">
            <input type="submit" value="Update" class="btn button-addtocart-color" name="user_update">
        </div>

    </form>
</body>
</html>
