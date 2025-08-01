<!-- Connect File -->
<?php
  include("../Includes/connect.php");
  include("../functions/common_function.php");
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Panel</title>
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


table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }

    .product_image{
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
        <a class='nav-link' href='./index.php'>Welcome ".$_SESSION['username']."</a>
      </li>";
        }
     
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
        <a class='nav-link' href='./admin_login.php'>Login</a>
      </li>";
        }
        else{
          echo "<li class='nav-item'>
        <a class='nav-link' href='./logout.php'>Logout</a>
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



<div class="row mx-0"> <!-- row m-auto for fixing bug side width -->
    <!-- SideBar Start-->
    <div class="col-md-2 p-0 text-center">
        <ul class="navbar-nav me-auto side-bar">
            <li class="nav-item category-title pt-2">
                <h3 class="fw-bold">Admin Dashboard</h3>
            </li>
            <li class='nav-item category-item'>
                <a href='insert_product.php' class='nav-link'>Insert Product</a>                
            </li>
            <li class='nav-item category-item'>
                <a href='index.php?view_products' class='nav-link'>View Products</a>                
            </li>
            <li class='nav-item category-item'>
                <a href='index.php?insert_category' class='nav-link'>Insert Cateogory</a>                
            </li>
            <li class='nav-item category-item'>
                <a href='./index.php?view_categories' class='nav-link'>View Categories</a>                
            </li>
            <li class='nav-item category-item'>
                <a href='./index.php?list_orders' class='nav-link'>View Order List</a>                
            </li>
            <li class='nav-item category-item'>
                <a href='./index.php?list_payments' class='nav-link'>View Payment List</a>                
            </li>
            <li class='nav-item category-item'>
                <a href='./index.php?list_users' class='nav-link'>View User List</a>                
            </li>
        </ul>
    </div>
    <!-- SideBar End -->

    <div class="col-md-9 pt-3 mx-auto">
        <!-- Product Start -->
        <div class="row">
            <div class="container">
            <?php 
                if(isset($_GET["insert_category"])){
                    include("insert_categories.php");
                }
                if(isset($_GET["view_products"])){
                    include("view_products.php");
                }
                if(isset($_GET["edit_products"])){
                    include("edit_products.php");
                }
                if(isset($_GET["delete_products"])){
                    include("delete_products.php");
                }
                if(isset($_GET["view_categories"])){
                    include("view_categories.php");
                }
                if(isset($_GET["edit_category"])){
                    include("edit_category.php");
                }
                if(isset($_GET["delete_category"])){
                    include("delete_category.php");
                }
                if(isset($_GET["list_orders"])){
                    include("list_orders.php");
                }
                if(isset($_GET["delete_orders"])){
                    include("delete_orders.php");
                }
                if(isset($_GET["edit_orders"])){
                    include("edit_orders.php");
                }
                if(isset($_GET["list_users"])){
                    include("list_users.php");
                }
                if(isset($_GET["list_payments"])){
                    include("list_payments.php");
                }
                if(empty($_GET)){
                  $get_quantity = "SELECT * FROM products WHERE (stock_quantity - sold_quantity) < 5";
                  $result = mysqli_query($con, $get_quantity);

        if ($result && mysqli_num_rows($result) > 0) {
        echo "
        <h2 class='text-center text-danger'>Notice</h2>
        <h3 class='text-center'>Low Stock Products</h3>
        <table class='table table-border mt-3'>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Title</th>
                        <th>Stock Quantity</th>
                        <th>Sold Quantity</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_title']}</td>
                    <td>{$row['stock_quantity']}</td>
                    <td>{$row['sold_quantity']}</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "
        <h2 class='text-center text-danger'>Notice</h2>
        <h3 class='text-center text-success'>No products with low stock.</h3>";
    }
                }
        

                

                
                
            ?>
            </div>
        </div>
        <!-- Product End -->
    </div>

</div>
<!-- Center Part End -->
    

<!-- Footer Start -->
<?php include("../Includes/footer.php"); ?>
<!-- Footer End -->


<!-- Bootstrap JS Link Start -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Bootstrap JS Link End -->
</body>
</html>
