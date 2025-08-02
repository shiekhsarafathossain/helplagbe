<?php
include("../includes/connect.php");
if(isset($_POST['insert_service'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $keywords = $_POST['keywords'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $status = 'true';


    //Accessing images
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];
    
    //Accessing image temp name

    $temp_image1 = $_FILES['image1']['tmp_name'];
    $temp_image2 = $_FILES['image2']['tmp_name'];
    $temp_image3 = $_FILES['image3']['tmp_name'];

    //Checking empty Condition

    if($title=='' or $address=='' or $description=='' or $keywords=='' or $category=='' or $price=='' or $temp_image1=='' or $temp_image2=='' or $temp_image3==''){
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    }
    else{

        //images
        move_uploaded_file($temp_image1,"../assets/images/service_images/$image1");
        move_uploaded_file($temp_image2,"../assets/images/service_images/$image2");
        move_uploaded_file($temp_image3,"../assets/images/service_images/$image3");

        //insert query
        $insert_services = "INSERT INTO `service` (title, description, keywords, category_id, image1, image2, image3, price, name, contact, address, date, status) VALUES 
        ('$title', '$description', '$keywords', '$category', '$image1', '$image2', '$image3', '$price', '$name', '$contact', '$address', NOW(), '$status')";
        
        $result_query = mysqli_query($con,$insert_services);
        if($result_query){
            echo "<script>alert('Services inserted successfully')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider</title>
    <!-- Bootstrap CSS Link Start -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap CSS Link End -->
    <!-- Font Awesome Link Start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome Link End -->
    <!-- Style.css Link Start -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Style.css Link End -->
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
/* 
body {
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

.service_image{
      width: 100px;
      height: 100px;
      object-fit: contain;
    }


</style>
     
</head>
<body class="open-sans-font">
    <!-- Navbar Start -->
<!-- First Part Start -->
<div class="navbar navbar-expand-lg login-bar">
      <ul class="navbar-nav me-auto">
      <?php
      if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
        <a class='nav-link' href='#'>Welcome Guest</a>
      </li>";
        }
        else{
          echo "<li class='nav-item'>
        <a class='nav-link' href='../users_area/profile.php'>Welcome ".$_SESSION['username']."</a>
      </li>";
        }
     
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
        <a class='nav-link' href='../users_area/user_login.php'>Login</a>
      </li>";
        }
        else{
          echo "<li class='nav-item'>
        <a class='nav-link' href='../users_area/logout.php'>Logout</a>
      </li>";
        }

      ?>
      </ul>

    </div>
<!-- First Part End -->

<!-- Second Part Start -->
        <div class="container-fluid p-0">
        
<nav class="navbar navbar-expand-lg nav-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="../assets/images/logo.png" alt="logo" class="logo"></a>
  </div>
</nav>
    </div>
<!-- Second Part End -->
<!-- Navbar End -->

<!-- Center Part Start -->

<!-- Title Part Start -->
<?php include("../Includes/title_bar.php"); ?>
<!-- Title Part End -->

    <!-- Insert Start -->
    <div class="container mt-2">
        <h1 class="text-center">Insert Services</h1>
        <form action="" method="post" enctype="multipart/form-data">

            <!-- Title Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="title" class="form-label">Service Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter service title" autocomplete="off" required="required">
            </div>
            <!-- Title End -->
            
            <!-- Description Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="description" class="form-label">Service Description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter service description" autocomplete="off" required="required">
            </div>
            <!-- Description End -->

            <!-- Keywords Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="keywords" class="form-label">Service Keywords</label>
            <input type="text" name="keywords" id="keywords" class="form-control" placeholder="Enter service keywords" autocomplete="off" required="required">
            </div>
            <!-- Keywords End -->

            <!-- Category Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <select name="category" id="" class="form-select">
                <option value="">Select a Category</option>
                
                <?php
                    $select_query="Select * from categories";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                    }
                ?>
            </select>
            </div>
            <!-- Category End -->

            <!-- Image 1 Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="image1" class="form-label">Image 1</label>
            <input type="file" name="image1" id="image1" class="form-control" autocomplete="off" required="required">
            </div>
            <!-- Image End -->
            <!-- Image 2 Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="image2" class="form-label">Image 2</label>
            <input type="file" name="image2" id="image2" class="form-control" autocomplete="off" required="required">
            </div>
            <!-- Image 2 End -->
            <!-- Image 3 Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="image3" class="form-label">Image 3</label>
            <input type="file" name="image3" id="image3" class="form-control" autocomplete="off" required="required">
            </div>
            <!-- Image 3 End -->

            <!--  Price Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Enter service price" autocomplete="off" required="required">
            </div>
            <!--  Price End -->


            <!--  Name Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" autocomplete="off" required="required">
            </div>
            <!-- Name  End -->

            <!--  Contact Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter your contact" autocomplete="off" required="required">
            </div>
            <!--  Contact End -->

            <!--  address Start -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required">
            </div>
            <!--  address End -->

            <!-- Button Start -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_service" class="btn button-addtocart-color" value="Insert Service">
            </div>
            <!-- Button End -->
        </form>
    </div>


    <!-- Insert End -->

    <!-- Footer Start -->
    <?php
        include("../Includes/footer.php");
    ?>
    <!-- Footer End -->



<!-- Bootstrap JS Link Start -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Bootstrap JS Link End -->
</body>
</html>