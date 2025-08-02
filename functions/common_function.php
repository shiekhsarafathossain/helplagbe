<?php

// getting service function start
function getservice(){
    global $con;
    // if categories is not set, display random services
    if(!isset($_GET['category'])){
        $select_query = "SELECT * FROM service ORDER BY rand() LIMIT 0,6";
        $result_query = mysqli_query($con,$select_query);
        while($row = mysqli_fetch_assoc($result_query)){
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $image1 = $row['image1'];
            $price = $row['price'];
            $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;

            echo "<div class='col-md-4'>
                    <div class='service-card'>
                      <img src='./assets/images/service_images/$image1' class='card-img-top' alt='$title'>
                      <div class='card-body'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text'>$short_description</p>
                        <p class='price'>৳ " . number_format($price) . "</p>
                        <div class='d-flex justify-content-between align-items-center mt-3'>
                            <a href='details.php?id=$id' class='btn btn-sm btn-outline-primary'>View Details</a>
                            <a href='booking.php?id=$id' class='btn btn-sm btn-primary'>Book Now</a>
                        </div>
                      </div>
                    </div>
                  </div>";
        }
    }
}
// getting service function end

// getting all services
function getAllservice(){
  global $con;
  if(!isset($_GET['category'])){
    $order_by = "ORDER BY rand()"; // default
    if(isset($_GET['sort'])){
      $sort = $_GET['sort'];
      if($sort == "price_asc"){
        $order_by = "ORDER BY price ASC";
      } elseif($sort == "price_desc"){
        $order_by = "ORDER BY price DESC";
      } elseif($sort == "title_asc"){
        $order_by = "ORDER BY title ASC";
      } elseif($sort == "title_desc"){
        $order_by = "ORDER BY title DESC";
      }
    }
    $select_query = "SELECT * FROM service $order_by";
    $result_query = mysqli_query($con,$select_query);
    while($row = mysqli_fetch_assoc($result_query)){
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $image1 = $row['image1'];
        $price = $row['price'];
        $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;

        echo "<div class='col-md-4'>
                <div class='service-card'>
                  <img src='./assets/images/service_images/$image1' class='card-img-top' alt='$title'>
                  <div class='card-body'>
                    <h5 class='card-title'>$title</h5>
                    <p class='card-text'>$short_description</p>
                    <p class='price'>৳ " . number_format($price) . "</p>
                    <div class='d-flex justify-content-between align-items-center mt-3'>
                        <a href='details.php?id=$id' class='btn btn-sm btn-outline-primary'>View Details</a>
                        <a href='booking.php?id=$id' class='btn btn-sm btn-primary'>Book Now</a>
                    </div>
                  </div>
                </div>
              </div>";
    }
  }
}

// getting service by category
function getServiceByCategories(){
    global $con;
    if(isset($_GET['category'])){
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM service WHERE category_id = $category_id ORDER BY rand()";
        $result_query = mysqli_query($con,$select_query);
        $numOfRows = mysqli_num_rows($result_query);
        if($numOfRows==0){
            echo "<h1 class='text-center mb-5 fw-bold text-primary'>
        No services in this category.
      </h1>";
        } else {
            while($row = mysqli_fetch_assoc($result_query)){
              $id = $row['id'];
              $title = $row['title'];
              $description = $row['description'];
              $image1 = $row['image1'];
              $price = $row['price'];
              $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;

              echo "<div class='col-md-4'>
                      <div class='service-card'>
                        <img src='./assets/images/service_images/$image1' class='card-img-top' alt='$title'>
                        <div class='card-body'>
                          <h5 class='card-title'>$title</h5>
                          <p class='card-text'>$short_description</p>
                          <p class='price'>৳ " . number_format($price) . "</p>
                          <div class='d-flex justify-content-between align-items-center mt-3'>
                              <a href='details.php?id=$id' class='btn btn-sm btn-outline-primary'>View Details</a>
                              <a href='booking.php?id=$id' class='btn btn-sm btn-primary'>Book Now</a>
                          </div>
                        </div>
                      </div>
                    </div>";
            }
        }
    }
}

// getting category function
// getting category function
function getCategory(){
    global $con;
    
    // Get the name of the current script (e.g., 'index.php' or 'service.php')
    $current_page = basename($_SERVER['PHP_SELF']);

    $select_category = "SELECT * FROM categories";
    $result_category = mysqli_query($con,$select_category);
    
    while($row_data = mysqli_fetch_assoc($result_category)){
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        
        $active_class = (isset($_GET['category']) && $_GET['category'] == $category_id) ? 'active' : '';

        // Use the $current_page variable to create a dynamic link
        echo "<a href='$current_page?category=$category_id' class='btn $active_class'>$category_title</a>";
    }
}

// searching function// searching function
function searchServices(){
  global $con;
    // Check if the search form was submitted
    if(isset($_GET['search_data_product'])){
      // Sanitize the user input to prevent SQL injection
      $searchValue = mysqli_real_escape_string($con, $_GET['search_data']);
      
      // Updated query to search in both title and description
      $search_query = "SELECT * FROM service WHERE title LIKE '%$searchValue%' OR description LIKE '%$searchValue%'";
      
      $result_query = mysqli_query($con,$search_query);
      $numOfRows = mysqli_num_rows($result_query);

      // If no results, show a friendly message
      if($numOfRows==0){
          echo "<h1 class='text-center mb-5 fw-bold text-primary'>
        No services found matching your search.
      </h1>";
      }

      

      // Loop through results and display them
      while($row = mysqli_fetch_assoc($result_query)){
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $image1 = $row['image1'];
          $price = $row['price'];
          $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;

          // Uses the same modern service card style
          echo "<div class='col-md-4 mb-4'>
                  <div class='service-card'>
                    <img src='./assets/images/service_images/$image1' class='card-img-top' alt='$title'>
                    <div class='card-body'>
                      <h5 class='card-title'>$title</h5>
                      <p class='card-text'>$short_description</p>
                      <p class='price'>৳ " . number_format($price) . "</p>
                      <div class='d-flex justify-content-between align-items-center mt-3'>
                          <a href='details.php?id=$id' class='btn btn-sm btn-outline-primary'>View Details</a>
                          <a href='booking.php?id=$id' class='btn btn-sm btn-primary'>Book Now</a>
                      </div>
                    </div>
                  </div>
                </div>";
      }
    }
}
// view details function
function view_details(){
  global $con;
  if(isset($_GET['id']) && !isset($_GET['category'])){
      $id = $_GET['id'];
      $select_query = "SELECT * FROM service WHERE id='$id'";
      $result_query = mysqli_query($con, $select_query);
      while($row = mysqli_fetch_assoc($result_query)){
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $image1 = $row['image1'];
          $image2 = $row['image2'];
          $image3 = $row['image3'];
          $name = $row['name'];
          $contact = $row['contact'];
          $address = $row['address'];
          $price = $row['price'];

          // This function now creates its own styled container
          echo "
            <div class='bg-white p-4 rounded shadow-sm'>
              <div class='row g-5'>
                <div class='col-lg-6'>
                  <div id='serviceCarousel' class='carousel slide' data-bs-ride='carousel'>
                    <div class='carousel-inner'>
                      <div class='carousel-item active'>
                        <img src='./assets/images/service_images/$image1' class='d-block w-100 rounded' alt='$title'>
                      </div>
                      <div class='carousel-item'>
                        <img src='./assets/images/service_images/$image2' class='d-block w-100 rounded' alt='$title'>
                      </div>
                      <div class='carousel-item'>
                        <img src='./assets/images/service_images/$image3' class='d-block w-100 rounded' alt='$title'>
                      </div>
                    </div>
                    <button class='carousel-control-prev' type='button' data-bs-target='#serviceCarousel' data-bs-slide='next'>
                      <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                      <span class='visually-hidden'>Previous</span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#serviceCarousel' data-bs-slide='next'>
                      <span class='carousel-control-next-icon' aria-hidden='true'></span>
                      <span class='visually-hidden'>Next</span>
                    </button>
                  </div>
                </div>
                <div class='col-lg-6'>
                  <h1 class='fw-bold'>$title</h1>
                  <p class='lead text-muted'>$description</p>
                  <hr class='my-4'>
                  <ul class='list-group list-group-flush'>
                    <li class='list-group-item d-flex justify-content-between align-items-center'>
                      Service Provider: <span class='fw-bold'>$name</span>
                    </li>
                    <li class='list-group-item d-flex justify-content-between align-items-center'>
                      Provider Contact: <span class='fw-bold'>$contact</span>
                    </li>
                    <li class='list-group-item d-flex justify-content-between align-items-center'>
                      Service Area: <span class='fw-bold'>$address</span>
                    </li>
                  </ul>
                  <div class='mt-4 p-3 bg-light rounded text-center'>
                    <h3 class='fw-normal mb-0'>Price: <span class='fw-bold text-primary'>৳ " . number_format($price) . "</span></h3>
                  </div>
                  <div class='d-grid gap-2 mt-4'>
                    <a class='btn btn-primary btn-lg' href='booking.php?id=$id'>Book This Service Now</a>
                  </div>
                </div>
              </div>
            </div>";
      }
  }
}

// view details end

// get ip_address function
function getIPAddress() {
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// cart function start (Restored for compatibility)
function cart(){
  if(isset($_GET['book'])){
    global $con;
    $get_ip_address = getIPAddress();
    $get_product_id = $_GET['book'];
    $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address' and product_id=$get_product_id";
    $result_query = mysqli_query($con, $select_query);
    $numOfRows = mysqli_num_rows($result_query);
    if($numOfRows>0){
        echo "<script>alert('Item already present inside cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
    else{
      $insert_query = "INSERT INTO cart_details (product_id, ip_address,quantity) VALUES ($get_product_id,'$get_ip_address',1)";
      $result_query = mysqli_query($con, $insert_query);
      echo "<script>alert('Item is added to cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
  }
}
// cart function end

// function for get cart item numbers start (Restored for compatibility)
function cart_item(){
  if(isset($_GET['add_to_cart'])){
    global $con;
    $get_ip_address = getIPAddress();
    $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_items=mysqli_num_rows($result_query);
  }
  else{
    global $con;
    $get_ip_address = getIPAddress();
    $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_items=mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}
//function for get cart item numbers end

//get user order details
function get_user_order_details(){
  global $con;
  if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $get_details = "SELECT * FROM user_table WHERE username='$username'";
      $result_query = mysqli_query($con,$get_details);
      while($row_query=mysqli_fetch_array($result_query)){
        $user_id = $row_query['user_id'];
        if(!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])){
          $get_orders="SELECT * FROM user_orders WHERE user_id=$user_id AND order_status='pending'";
          $result_orders_query = mysqli_query($con,$get_orders);
          $row_count = mysqli_num_rows($result_orders_query);
          if($row_count>0){
            echo "<h3 class='text-center my-4'>You have <span class='text-danger'>$row_count</span> pending orders.</h3>
            <p class='text-center'><a href='profile.php?my_orders' class='text-primary fw-bold'>View Order Details</a></p>";
          } else {
            echo "<h3 class='text-center my-4'>You have no pending orders.</h3>
            <p class='text-center'><a href='../index.php' class='text-success fw-bold'>Explore Services</a></p>";
          }
        }
      }
  }
}


// Function to get working zones for a dropdown
function getWorkingZones(){
    global $con;
    $query = "SELECT * FROM working_zone ORDER BY zone_name ASC";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_assoc($result)){
        $zone_id = $row['zone_id'];
        $zone_name = $row['zone_name'];
        echo "<option value='$zone_id'>$zone_name</option>";
    }
}

// Function to get categories available in a specific zone
function getCategoriesByZone($zone_id) {
    global $con;
    // This query finds all unique categories for services that are in the selected zone
    $query = "SELECT DISTINCT c.category_id, c.category_title 
              FROM categories c
              JOIN service s ON c.category_id = s.category_id
              WHERE s.zone_id = ?
              ORDER BY c.category_title ASC";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $zone_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    return $categories;
}



?>