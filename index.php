<!-- Connect File -->
<?php
  include("./includes/connect.php");
  include("./functions/common_function.php");
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Lagbe</title>
<!-- Bootstrap CSS Link Start -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Bootstrap CSS Link End -->

<!-- Font Awesome Link Start -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Font Awesome Link End -->

<link rel="stylesheet" href="./style.css">

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

.logo{
  width:70px;
}

.title-bar {
    text-align: center !important;
    background: linear-gradient(135deg, #3061bdff 0%, #5A8DFF 100%) !important;
}

.nav-custom{
  background: linear-gradient(135deg, #C5BAFF 0%, #8A77FF 100%) !important;
}

.footer-custom{
  background: linear-gradient(135deg, #C5BAFF 0%, #8A77FF 100%) !important;
}

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
</style>
</head>
<body class="open-sans-font">
<!-- Navbar Start -->

<?php include("./includes/navbar.php"); ?>

<!-- Navbar End -->

<!-- Center Part Start -->
<!-- Title Part Start -->

<?php include("./includes/title_bar.php"); ?>

<!-- Title Part End -->



<!-- calling cart function start -->
<!-- <?php
//   cart();
?> -->
<!-- calling cart function end -->

<!-- Sidebar Start -->

<div class="row mx-0"> <!-- row m-auto for fixing bug side width -->
  <div class="col-md-2 p-0 text-center">
    <!-- SideBar Start-->
    <ul class="navbar-nav me-auto side-bar">
      <li class="nav-item pt-2">
        <h3 class="fw-bold">Our Services</h3>
      </li>
    
  <?php
    //calling function getCategory()
    getCategory();
    
  ?>
  </ul>
  <!-- SideBar End -->
  </div>

  <div class="col-md-9 pt-3 mx-auto">
    
    <!-- Product Start -->
    <div class="row">
    <div class="container my-4">
</div>
    <!-- Php Code -->

    <?php
    
    //calling function getProducts()
    // getProducts();

    // //calling function getProducts()
    // getProductsbByCategories();

    // $ip = getIPAddress();  
    // echo 'User Real IP Address - '.$ip;  

    ?>

    </div>
    <!-- Product End -->
  </div>

</div>
<!-- Center Part End -->


<!-- Footer Start -->
<?php
  include("./includes/footer.php");
?>
<!-- Footer End -->
    
<!-- Bootstrap JS Link Start -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Bootstrap JS Link End -->
</body>
</html>