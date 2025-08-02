<?php
include("../Includes/connect.php");
include("../functions/common_function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="style.css">
    
    <style>
/* font start */
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap');

.open-sans-font {
  font-family: "Open Sans", sans-serif;
  font-optical-sizing: auto;
  font-weight: 500;
  font-style: normal;
  font-variation-settings:
    "wdth" 100;
}

/* font end */

/* body {
  background: linear-gradient(135deg, #FFFFFF 0%, #F0F4FF 100%) !important;
  margin: 0;
  padding: 0;
} */

.logo{
  width:70px;
}

/* card style start */
.card-img-top{
  height: 200px;
}

.top-bar {
    text-align: center !important;
    background: linear-gradient(135deg, #C4D9FF 0%, #5A8DFF 100%) !important;
    
}


/* card style end */

.nav-custom{
  background: linear-gradient(135deg, #C5BAFF 0%, #8A77FF 100%) !important;
}


/* cart.php start */
.cart_img {
  width: 100px;
  height: 100px;
  object-fit: contain;
}
/* cart.php end */

.footer-custom{
  background: linear-gradient(135deg, #C5BAFF 0%, #8A77FF 100%) !important;
}

/* button start */
.button-addtocart-color {
  background: linear-gradient(135deg, #C4D9FF, #91B9FF) !important;
  font-weight: bold;
  color: #000;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.button-addtocart-color:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.button-viewmore-color {
  background-color: rgba(0, 0, 0, 0.05) !important;
  color: #000;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.button-viewmore-color:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}


/* button end */

/* sidebar start */

.side-bar{
  height: 100%;
  background: linear-gradient(135deg, #E8F9FF 10%, #A0D8FF 100%) !important;
}
.category-title{
  background: linear-gradient(135deg, #E8F9FF 10%, #A0D8FF 100%) !important;
  font-size: large;
  font-weight: bold;

}
.category-item {
  background: linear-gradient(135deg, #E8F9FF 10%, #A0D8FF 100%) !important;
  margin: 5px;
  border-radius: 5px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.category-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  background: linear-gradient(135deg, #C4D9FF 10%, #91B9FF 100%) !important;
  transition: all 0.3s ease;
}

/* sidebar end */


/* card style start*/
.card {
  background: #ffffffcc; /* white with slight transparency */
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
  padding: 20px;
  border-radius: 10px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  backdrop-filter: blur(8px); /* soft blur behind card for depth */
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
}

.title-fixed {
  height: 1.5em; /* fits 1-2 lines */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.description-fixed {
  height: 4em; /* fits around 4-5 lines */
  /* overflow: hidden;
  text-overflow: ellipsis; */
}

.price{
  font-size: large;
  font-weight: bolder;
}

/* card style end */

</style>

</head>
<body style="overflow-x: hidden !important;">

<div class="container-fluid m-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">

                <!-- Username -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required name="user_username">
                </div>

                <!-- Email -->
                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required name="user_email">
                </div>

                <!-- User Image -->
                <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" id="user_image" class="form-control" required name="user_image">
                </div>

                <!-- Password -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter password" autocomplete="off" required name="user_password">
                </div>

                <!-- Confirm Password -->
                <div class="form-outline mb-4">
                    <label for="confirm_user_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_user_password" class="form-control" placeholder="Confirm password" autocomplete="off" required name="confirm_user_password">
                </div>

                <!-- Address -->
                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required name="user_address">
                </div>

                <!-- Contact -->
                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact Number</label>
                    <input type="text" id="user_contact" class="form-control" placeholder="Enter your contact number" autocomplete="off" required name="user_contact">
                </div>

                <!-- Submit Button -->
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="button-addtocart-color py-3 px-3 border-0 w-100" name="user_register">
                </div>

                <p class="small fw-bold mt-2 pt-1 mb-0">
                    Already have an account? <a href="user_login.php" class="text-danger">Login</a>
                </p>

            </form>
        </div>
    </div>
</div>

</body>
</html>

<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_password = $_POST['user_password'];
    $confirm_user_password = $_POST['confirm_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_ip = getIPAddress();
    $user_shipping_address = $user_address;

    // Check if passwords not match
    if ($user_password !== $confirm_user_password) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
        exit();
    }

    // password hashing

    $hash_password = password_hash($user_password,PASSWORD_DEFAULT); 

    // Move uploaded image
    move_uploaded_file($user_image_tmp, "../assets/images/user_images/$user_image");

    //select query

    $select_query = "SELECT * FROM user_table WHERE username='$user_username' OR user_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);

    if($rows_count>0){
        echo "<script>alert('User already exist');</script>";
    }
    else{
    // Insert query
    $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_image, user_ip, user_address, user_shipping_address, user_mobile) 
    VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_shipping_address', '$user_contact')";

    $sql_execute = mysqli_query($con, $insert_query);

    if ($sql_execute) {
        echo "<script>alert('Data inserted successfully');</script>";
    }else {
        die(mysqli_error($con));
    }
    }

    //selecting cart items

    $select_cart = "SELECT * FROM cart_details WHERE ip_address ='$user_ip'";
    $result_cart = mysqli_query($con,$select_cart);
    $rows_count = mysqli_num_rows($result_cart);

    if($rows_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('You have items in your cart');</script>";
        echo "<script>window.open('checkout.php','_self');</script>";
    }
    else{
        echo "<script>window.open('../index.php','_self');</script>";
    }
}
?>
