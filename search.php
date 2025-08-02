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
    <title>Search Results - Help Lagbe</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    /* Using the same styles from your other pages for consistency */
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
    .btn-primary:hover {
        background-color: #4A7BDE;
    }
</style>
</head>
<body>
<!-- Navbar Start -->
<?php include("./includes/navbar.php"); ?>
<!-- Navbar End -->

<!-- Main Content Area -->
<div class="container my-5">
    
    <!-- Dynamically display the search term -->
    <h1 class="text-center mb-5 fw-bold">
        Search Results for "<?php echo isset($_GET['search_data']) ? htmlspecialchars($_GET['search_data']) : ''; ?>"
    </h1>

    <div class="row g-4">
        <?php
            // This function will find and display the search results
            searchServices();
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
