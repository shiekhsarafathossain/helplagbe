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
    <title>Help Lagbe - Your Local Home Service Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    /* Global Styles from your template */
    html {
        scroll-behavior: smooth; /* Ensures smooth scrolling */
    }
    body {
      font-family: "Open Sans", sans-serif;
      background-color: #f8f9fa;
    }
    .logo {
      width: 70px;
    }
    .nav-custom, .footer-custom {
      background: #ffffff;
      border-bottom: 1px solid #dee2e6;
    }
    .footer-custom {
      border-top: 1px solid #dee2e6;
      border-bottom: none;
      color: #6c757d;
    }
    .nav-link {
        color: #343a40 !important;
        font-weight: 600;
    }
    .nav-link.active, .nav-link:hover {
        color: #5A8DFF !important;
    }
    .hero-section {
        background: linear-gradient(135deg, rgba(90, 141, 255, 0.9), rgba(74, 123, 222, 0.95));
        background-size: cover;
        background-position: center;
        padding: 6rem 1rem;
        text-align: center;
        color: white;
    }
    .hero-section h1 {
        font-weight: 700;
        font-size: 3rem;
    }
    .hero-search-form {
        max-width: 600px;
        margin: auto;
    }
    .section-title {
      font-weight: 700;
      color: #343a40;
      margin-bottom: 2.5rem;
      text-align: center;
    }
    .how-it-works-card {
        text-align: center;
        padding: 2rem 1rem;
    }
    .how-it-works-icon {
        font-size: 3rem;
        color: #5A8DFF;
        margin-bottom: 1rem;
    }
    .how-it-works-card h5 {
        font-weight: 700;
        color: #343a40;
    }
    .how-it-works-card p {
        color: #6c757d;
    }
    .category-filters {
        text-align: center;
        margin-bottom: 3rem;
    }
    .category-filters .btn {
        margin: 5px;
        border-radius: 30px;
        font-weight: 600;
        background-color: #e9ecef;
        border: 1px solid #dee2e6;
        color: #343a40;
        transition: all 0.3s ease;
    }
    .category-filters .btn:hover, .category-filters .btn.active {
        background-color: #5A8DFF;
        color: white;
        border-color: #5A8DFF;
    }
    .service-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        height: 100%;
    }
    .service-card .card-img-top {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        height: 200px;
        object-fit: cover;
    }
    .service-card .card-body {
        padding: 20px;
    }
    .service-card .card-title {
        font-weight: 700;
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
<?php include("./includes/navbar.php"); ?>

<section class="hero-section">
    <div class="container">
        <h1 class="display-4">Need Help at Home?</h1>
        <p>Find trusted local professionals for any home service you need. Fast, reliable, and just a click away.</p>
        
        <form class="d-flex hero-search-form" role="search" action="index.php" method="GET">
            <select class="form-select me-2" name="zone_id" aria-label="Select Location" required>
                <option selected disabled value="">Select your location...</option>
                <?php
                    getWorkingZones();
                ?>
            </select>
            <button class="btn btn-light" type="submit">Find Services</button>
        </form>
    </div>
</section>

<section class="container my-5 py-4">
    <h2 class="section-title">How It Works</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="how-it-works-card">
                <i class="fas fa-search how-it-works-icon"></i>
                <h5>1. Find a Service</h5>
                <p>Search for the service you need or browse through our categories.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="how-it-works-card">
                <i class="fas fa-calendar-check how-it-works-icon"></i>
                <h5>2. Book a Time</h5>
                <p>Select a convenient date and time that works for you.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="how-it-works-card">
                <i class="fas fa-check-circle how-it-works-icon"></i>
                <h5>3. Get It Done</h5>
                <p>A verified professional will arrive on time and complete the job.</p>
            </div>
        </div>
    </div>
</section>

<!-- LOGIC CHANGE: Added an id to this section for scrolling -->
<section id="category-section" class="main-content bg-white py-5">
    <div class="container">
        <h2 class="section-title">Browse by Category</h2>
        <div class="category-filters">
            <?php
                $zone_param = isset($_GET['zone_id']) ? 'zone_id=' . (int)$_GET['zone_id'] : '';
                $all_active = !isset($_GET['category']) ? 'active' : '';
                echo "<a href='index.php?$zone_param' class='btn $all_active'>All Services</a>";
                
                getCategory();
            ?>
        </div>

        <div class="row g-4 mt-4">
            <?php
                getservice();
                getServiceByCategories();
            ?>
        </div>
    </div>
</section>


<?php include("./includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- LOGIC CHANGE: Added this script to handle auto-scrolling -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create a URLSearchParams object to easily read the URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Check if the 'zone_id' parameter exists in the URL
    if (urlParams.has('zone_id')) {
        // Find the category section element by its ID
        const categorySection = document.getElementById('category-section');
        
        // If the element exists, scroll to it smoothly
        if (categorySection) {
            categorySection.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
</script>

</body>
</html>
