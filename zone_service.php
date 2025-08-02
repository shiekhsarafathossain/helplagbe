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
    <title>Available Services - Help Lagbe</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    /* Using the same styles for consistency */
    body {
      font-family: "Open Sans", sans-serif;
      background-color: #f8f9fa;
    }
    .service-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .service-card:hover {
        transform: translateY(-5px);
    }
    .service-card .card-img-top {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        height: 200px;
        object-fit: cover;
    }
    .price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #5A8DFF;
    }
    .btn-primary {
        background-color: #5A8DFF;
        border: none;
    }
</style>
</head>
<body>
<!-- Navbar Start -->
<?php include("./includes/navbar.php"); ?>
<!-- Navbar End -->

<!-- Main Content Area -->
<div class="container my-5">
    
    <h1 class="text-center mb-5 fw-bold">Available Services</h1>

    <div class="row g-4">
        <?php
            // Display services based on selected zone and category
            if(isset($_GET['zone_id']) && isset($_GET['category_id'])){
                $zone_id = (int)$_GET['zone_id'];
                $category_id = (int)$_GET['category_id'];

                $query = "SELECT * FROM service WHERE zone_id = ? AND category_id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("ii", $zone_id, $category_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $num_of_rows = $result->num_rows;

                if($num_of_rows == 0){
                    echo "<h2 class='text-center text-danger w-100'>Sorry, no services found in this category for the selected location.</h2>";
                }

                while($row = $result->fetch_assoc()){
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $image1 = $row['image1'];
                    $price = $row['price'];
                    $short_description = strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description;

                    echo "<div class='col-md-4 mb-4'>
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
            } else {
                echo "<h2 class='text-center text-warning w-100'>Please select a zone and category from the homepage.</h2>";
            }
        ?>
    </div>
</div>

<!-- Footer Start -->
<?php include("./includes/footer.php"); ?>
<!-- Footer End -->
    
<!-- Bootstrap JS Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
