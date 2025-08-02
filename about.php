<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Help Lagbe?</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* Global Styles */
    body {
      font-family: "Open Sans", sans-serif;
      background-color: #f8f9fa;
    }
    .logo { width: 70px; }
    
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
    .about-hero {
      background: linear-gradient(135deg, #5A8DFF 0%, #4A7BDE 100%);
      padding: 5rem 1rem;
      color: white;
      text-align: center;
    }
    .about-hero h1 {
      font-weight: 700;
      font-size: 2.8rem;
    }
    .about-hero p {
      font-size: 1.15rem;
      max-width: 700px;
      margin: 0 auto;
      opacity: 0.9;
    }

    /* Section Styles */
    .about-section {
      padding: 60px 20px;
    }
    .section-title {
      font-weight: 700;
      font-size: 2.2rem;
      margin-bottom: 50px;
      text-align: center;
      color: #343a40;
    }

    /* Info Card */
    .about-card {
      background: #ffffff;
      border: 1px solid #e9ecef;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: 100%;
    }
    .about-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    .about-icon {
      font-size: 40px;
      color: #5A8DFF;
      margin-bottom: 20px;
    }
    .about-card h5 {
        font-weight: 700;
    }
    .mission-text {
      font-size: 1.05rem;
      color: #555;
      line-height: 1.7;
    }
    
    /* Button */
    .btn-primary {
        background-color: #5A8DFF;
        border: none;
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #4A7BDE;
        box-shadow: 0 10px 20px rgba(90, 141, 255, 0.2);
        transform: translateY(-3px);
    }
  </style>
</head>
<body class="open-sans-font">

<?php include("./includes/navbar.php"); ?>

<section class="about-hero">
  <h1>About Help Lagbe</h1>
  <p>Your trusted local platform for home services — connecting skilled professionals with people who need help, fast and reliably.</p>
</section>

<section class="about-section container">
  <div class="section-title">Who We Are</div>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="about-card text-center">
        <i class="fas fa-users about-icon"></i>
        <h5 class="fw-bold">Community First</h5>
        <p class="mission-text">We believe in empowering local communities by making home services more accessible, efficient, and trustworthy.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="about-card text-center">
        <i class="fas fa-bolt about-icon"></i>
        <h5 class="fw-bold">Fast & Reliable</h5>
        <p class="mission-text">We connect users with qualified electricians, plumbers, cleaners, and more — with just a few taps.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="about-card text-center">
        <i class="fas fa-shield-alt about-icon"></i>
        <h5 class="fw-bold">Safety & Trust</h5>
        <p class="mission-text">We vet all our service providers and prioritize your security and satisfaction every step of the way.</p>
      </div>
    </div>
  </div>
</section>

<section class="container about-section">
  <div class="section-title">Our Mission</div>
  <div class="row justify-content-center">
    <div class="col-lg-10 text-center">
      <p class="mission-text">
        At <strong>Help Lagbe?</strong>, our mission is to simplify your everyday life by providing a platform where you can quickly find and book reliable help from your neighborhood — be it fixing a leaky faucet, deep-cleaning your home, or assembling new furniture. We strive to foster trust and professionalism in every service call, while building a stronger local service economy.
      </p>
      <div class="text-center mt-4">
        <a href="contact.php" class="btn btn-primary text-decoration-none">Meet Our Team</a>
      </div>
    </div>
  </div>
</section>

<?php include("./includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>