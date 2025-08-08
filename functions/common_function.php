<?php
// This file should be included at the top of your main PHP pages.
// Make sure the connection file is included before this file.

// Function to get working zones for a dropdown
function getWorkingZones(){
    global $con;
    $selected_zone_id = isset($_GET['zone_id']) ? (int)$_GET['zone_id'] : null;
    $query = "SELECT * FROM working_zone ORDER BY zone_name ASC";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_assoc($result)){
        $zone_id = $row['zone_id'];
        $zone_name = $row['zone_name'];
        $selected_attr = ($zone_id == $selected_zone_id) ? 'selected' : '';
        echo "<option value='$zone_id' $selected_attr>$zone_name</option>";
    }
}

// getting category function
function getCategory(){
    global $con;
    $zone_id_filter = isset($_GET['zone_id']) ? (int)$_GET['zone_id'] : null;
    $current_page = basename($_SERVER['PHP_SELF']);
    $query = "SELECT * FROM categories ORDER BY category_title ASC";
    $result = mysqli_query($con, $query);
    while($row_data = mysqli_fetch_assoc($result)){
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        $active_class = (isset($_GET['category']) && $_GET['category'] == $category_id) ? 'active' : '';
        $link = "$current_page?category=$category_id";
        if ($zone_id_filter) {
            $link .= "&zone_id=$zone_id_filter";
        }
        echo "<a href='$link' class='btn $active_class'>$category_title</a>";
    }
}

// getting service function
function getservice(){
    global $con;
    if(!isset($_GET['category'])){
        $zone_id_filter = isset($_GET['zone_id']) ? (int)$_GET['zone_id'] : null;
        $query = "SELECT * FROM service ";
        if ($zone_id_filter) {
            $query .= "WHERE zone_id = ? ";
        }
        if(basename($_SERVER['PHP_SELF']) == 'index.php' && !$zone_id_filter){
            $query .= "ORDER BY rand() LIMIT 6";
        } else {
            $query .= "ORDER BY rand()";
        }
        $stmt = $con->prepare($query);
        if ($zone_id_filter) {
            $stmt->bind_param("i", $zone_id_filter);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0 && $zone_id_filter){
             echo "<h1 class='text-center mb-5 fw-bold text-primary'>Sorry, no services are available in this location yet.</h1>";
        }
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $image1 = $row['image1'];
            $price = $row['price'];
            $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;
            echo "<div class='col-md-4'>
                    <div class='service-card'>
                      <img src='./assets/images/service_images/$image1' class='card-img-top' alt='$title'>
                      <div class='card-body d-flex flex-column'>
                        <h5 class='card-title'>$title</h5>
                        <p class='card-text flex-grow-1'>$short_description</p>
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
        $category_id = (int)$_GET['category'];
        $zone_id_filter = isset($_GET['zone_id']) ? (int)$_GET['zone_id'] : null;
        $query = "SELECT * FROM service WHERE category_id = ? ";
        if ($zone_id_filter) {
            $query .= "AND zone_id = ? ";
        }
        $query .= "ORDER BY rand()";
        $stmt = $con->prepare($query);
        if ($zone_id_filter) {
            $stmt->bind_param("ii", $category_id, $zone_id_filter);
        } else {
            $stmt->bind_param("i", $category_id);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            echo "<h1 class='text-center mb-5 fw-bold text-primary'>No services in this category for the selected location.</h1>";
        } else {
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $image1 = $row['image1'];
                $price = $row['price'];
                $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;
                echo "<div class='col-md-4'>
                        <div class='service-card'>
                          <img src='./assets/images/service_images/$image1' class='card-img-top' alt='$title'>
                          <div class='card-body d-flex flex-column'>
                            <h5 class='card-title'>$title</h5>
                            <p class='card-text flex-grow-1'>$short_description</p>
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


function searchServices(){
  global $con;
    if(isset($_GET['search_data_product'])){
      $searchValue = mysqli_real_escape_string($con, $_GET['search_data']);
      $search_query = "SELECT * FROM service WHERE title LIKE '%$searchValue%' OR description LIKE '%$searchValue%'";
      $result_query = mysqli_query($con,$search_query);
      $numOfRows = mysqli_num_rows($result_query);
      if($numOfRows==0){
          echo "<h1 class='text-center mb-5 fw-bold text-primary'>No services found matching your search.</h1>";
      }
      while($row = mysqli_fetch_assoc($result_query)){
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $image1 = $row['image1'];
          $price = $row['price'];
          $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;
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

// view details function - LOGIC CORRECTED
function view_details(){
  global $con;
  if(isset($_GET['id']) && !isset($_GET['category'])){
      $id = $_GET['id'];
      
      // UPDATED QUERY: Join service table with service_provider table
      $select_query = "SELECT s.*, sp.provider_name, sp.provider_contact, sp.provider_address, sp.status 
                       FROM service s 
                       JOIN service_provider sp ON s.provider_id = sp.provider_id 
                       WHERE s.id=?";
      
      $stmt = $con->prepare($select_query);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result_query = $stmt->get_result();

      
    while($row = mysqli_fetch_assoc($result_query)){
    // Existing variables
    $id = $row['id'];
    $title = $row['title'];
    $description = $row['description'];
    $image1 = $row['image1'];
    $image2 = $row['image2'];
    $image3 = $row['image3'];
    $name = $row['provider_name'];
    $contact = $row['provider_contact'];
    $address = $row['provider_address'];
    $price = $row['price'];
    $status = $row['status'];  // verified status

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
              <button class='carousel-control-prev' type='button' data-bs-target='#serviceCarousel' data-bs-slide='prev'>
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
              <li class='list-group-item d-flex justify-content-between align-items-center'>
                Verify Status: ";
                  if ($status === 'true') {
                      echo "<span class='badge bg-success'>Verified</span>";
                  } else {
                      echo "<span class='badge bg-danger'>Not Verified</span>";
                  }
            echo "
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
      $stmt->close();
  }
}

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

?>
