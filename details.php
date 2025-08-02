<?php
  include("./Includes/connect.php");
  include("./functions/common_function.php");
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details - Help Lagbe?</title>
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
    
    /* Sidebar */
    .sidebar {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      height: 100%;
    }
    .sidebar-title {
      font-weight: 700;
      color: #343a40;
      margin-bottom: 1rem;
      text-align: center;
    }
    .category-list .btn {
      display: block;
      width: 100%;
      text-align: left;
      margin-bottom: 8px;
    }
</style>
</head>
<body class="open-sans-font">
<?php include("./Includes/navbar.php"); ?>
<div class="container my-5">
            <?php
                // The view_details function will now create the white background container
                view_details();
            ?>

    </div>
</div>
<?php include("./Includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>