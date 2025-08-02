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
    /* Global Styles */
    body {
      font-family: "Open Sans", sans-serif;
      background-color: #f8f9fa;
    }

    .logo {
      width: 70px;
    }

    /* Navbar & Footer */
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

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, rgba(90, 141, 255, 0.9), rgba(74, 123, 222, 0.95)), url('./assets/images/hero-bg.jpg'); /* Add a background image if you have one */
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
    .hero-section p {
        font-size: 1.2rem;
        max-width: 600px;
        margin: 1rem auto 2rem auto;
    }
    .hero-search-form {
        max-width: 600px;
        margin: auto;
    }
    .hero-search-form .form-control {
        padding: 0.9rem 1.2rem;
        font-size: 1rem;
    }
    .hero-search-form .btn {
        padding: 0.9rem 2rem;
    }
    
    /* Section Title */
    .section-title {
      font-weight: 700;
      color: #343a40;
      margin-bottom: 2.5rem;
      text-align: center;
    }

    /* How It Works Section */
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

    /* Category Filters */
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

    /* Service Card */
    .service-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    .service-card .card-img-top {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        height: 200px;
        object-fit: cover;
    }
    .service-card .card-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .service-card .card-title {
        font-weight: 700;
    }
    .service-card .card-text {
        color: #6c757d;
        flex-grow: 1;
    }
    .service-card .price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #5A8DFF;
    }
    .btn-primary {
        background-color: #5A8DFF;
        border: none;
        font-weight: 600;
    }
    .btn-primary:hover {
        background-color: #4A7BDE;
    }
</style>
</head>
<body>
<?php include("./includes/navbar.php"); ?>

<section class="hero-section">
    <div class="container">
        <h1 class="display-4">Need Help at Home?</h1>
        <p>Find trusted local professionals for any home service you need. Fast, reliable, and just a click away.</p>
        
        <!-- Dynamic Zone and Category Search Form -->
        <form class="d-flex hero-search-form" role="search" action="zone_service.php" method="GET">
            <!-- Zone Dropdown -->
            <select class="form-select me-2" id="zone-select" name="zone_id" aria-label="Select Location" required>
                <option selected disabled value="">Select your location...</option>
                <?php
                    getWorkingZones();
                ?>
            </select>

            <!-- Category Dropdown (Initially disabled) -->
            <select class="form-select me-2" id="category-select" name="category_id" aria-label="Select Category" required disabled>
                <option selected disabled value="">First, select a zone</option>
            </select>

            <button class="btn btn-light" type="submit" id="find-services-btn" disabled>Find Services</button>
        </form>
    </div>
</section>

<!-- Add this script at the bottom of your index.php file, just before the </body> tag -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const zoneSelect = document.getElementById('zone-select');
    const categorySelect = document.getElementById('category-select');
    const findBtn = document.getElementById('find-services-btn');

    zoneSelect.addEventListener('change', function() {
        const zoneId = this.value;
        
        // Reset and disable the category dropdown while fetching data
        categorySelect.innerHTML = '<option selected disabled value="">Loading categories...</option>';
        categorySelect.disabled = true;
        findBtn.disabled = true;

        if (zoneId) {
            // Fetch categories for the selected zone
            fetch(`get_categories_for_zone.php?zone_id=${zoneId}`)
                .then(response => response.json())
                .then(data => {
                    categorySelect.innerHTML = '<option selected disabled value="">Select a category...</option>';
                    if (data.length > 0) {
                        data.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category.category_id;
                            option.textContent = category.category_title;
                            categorySelect.appendChild(option);
                        });
                        categorySelect.disabled = false; // Enable category selection
                    } else {
                        categorySelect.innerHTML = '<option selected disabled value="">No categories found</option>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                    categorySelect.innerHTML = '<option selected disabled value="">Error loading</option>';
                });
        }
    });

    // Enable the find button only when a category is selected
    categorySelect.addEventListener('change', function() {
        if (this.value) {
            findBtn.disabled = false;
        } else {
            findBtn.disabled = true;
        }
    });
});
</script>


<!-- <section class="hero-section">
    <div class="container">
        <h1 class="display-4">Need Help at Home?</h1>
        <p>Find trusted local professionals for any home service you need. Fast, reliable, and just a click away.</p>
        <form class="d-flex hero-search-form" role="search" action="search_product.php" method="GET">
            <input class="form-control me-2" type="search" placeholder="Search for any service..." aria-label="Search" name="search_data">
            <button class="btn btn-light" type="submit" name="search_data_product">Search</button>
        </form>
    </div>
</section> -->

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

<section class="main-content bg-white py-5">
    <div class="container">
        <h2 class="section-title">Browse by Category</h2>
        <div class="category-filters">
            <a href='index.php' class='btn <?php echo !isset($_GET['category']) ? 'active' : '' ?>'>All Services</a>
            <?php
                // Calling function to display category buttons
                getCategory();
            ?>
        </div>

        <div class="row g-4 mt-4">
            <?php
                // Calling functions to display services based on selection
                getservice();
                getServiceByCategories();
            ?>
        </div>
    </div>
</section>

<?php include("./includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>