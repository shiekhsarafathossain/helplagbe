<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FAQs - Help Lagbe?</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet"/>

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

    .faq-header {
      background: linear-gradient(135deg, #2b80ff, #4eb6ff);
      padding: 60px 20px;
      text-align: center;
      color: white;
      border-bottom-left-radius: 60px;
      border-bottom-right-radius: 60px;
    }

    .faq-header h1 {
      font-size: 2.8rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .faq-header p {
      font-size: 1.1rem;
      max-width: 700px;
      margin: 0 auto;
    }

    .faq-container {
      padding: 60px 20px;
      max-width: 900px;
      margin: auto;
    }

    .faq-box {
      background: white;
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 25px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease-in-out;
    }

    .faq-box:hover {
      transform: scale(1.01);
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
    }

    .faq-box h5 {
      font-weight: 700;
      color: #2b80ff;
    }

    .faq-box p {
      margin-top: 10px;
      color: #555;
    }
  </style>
</head>
<body class="open-sans-font">

<!-- Navbar -->
<?php include("./includes/navbar.php"); ?>

<!-- FAQ Header -->
<section class="faq-header">
  <h1>Frequently Asked Questions</h1>
  <p>Get quick answers to the most common questions about how Help Lagbe? works.</p>
</section>

<!-- FAQ Section -->
<section class="faq-container">

  <div class="faq-box">
    <h5>What is Help Lagbe?</h5>
    <p>Help Lagbe? is a platform that connects people with trusted local professionals for services like plumbing, electrical work, cleaning, and more.</p>
  </div>

  <div class="faq-box">
    <h5>How do I book a service?</h5>
    <p>Just sign up, browse the service categories, select a provider, pick a time slot, and confirm your booking. It’s quick and easy!</p>
  </div>

  <div class="faq-box">
    <h5>Are the service providers verified?</h5>
    <p>Yes, all providers go through a strict verification process to ensure quality and safety for our users.</p>
  </div>

  <div class="faq-box">
    <h5>What if I’m not satisfied with a service?</h5>
    <p>You can contact our support team within 24 hours of the service, and we’ll make it right — with refunds or rescheduling if needed.</p>
  </div>

  <div class="faq-box">
    <h5>How can I become a service provider?</h5>
    <p>Go to the “Become a Provider” section, fill in your details, and submit the application. Our team will review and approve eligible professionals.</p>
  </div>

</section>

<!-- Footer -->
<?php include("./includes/footer.php"); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
