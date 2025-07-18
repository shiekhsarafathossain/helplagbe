<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Help Lagbe?</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

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

    .logo{
      width:70px;
    }

    .title-bar {
        text-align: center !important;
        background: linear-gradient(135deg, #C4D9FF 0%, #5A8DFF 100%) !important;
    }

    .nav-custom{
      background: linear-gradient(135deg, #C5BAFF 0%, #8A77FF 100%) !important;
    }

    .footer-custom{
      background: linear-gradient(135deg, #C5BAFF 0%, #8A77FF 100%) !important;
    }

    .about-hero {
      background: linear-gradient(135deg, #C4D9FF 0%, #5A8DFF 100%);
      padding: 60px 20px;
      color: white;
      text-align: center;
      border-bottom-left-radius: 60px;
      border-bottom-right-radius: 60px;
    }

    .about-hero h1 {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 15px;
    }

    .about-hero p {
      font-size: 1.1rem;
      max-width: 700px;
      margin: 0 auto;
    }

    .about-section {
      padding: 60px 20px;
    }

    .about-icon {
      font-size: 40px;
      color: #5A8DFF;
      margin-bottom: 20px;
    }

    .about-card {
      border: none;
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      height: 100%;
    }

    .about-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      font-weight: bold;
      font-size: 2rem;
      margin-bottom: 40px;
      text-align: center;
    }

    .mission-text {
      font-size: 1.05rem;
      color: #555;
      line-height: 1.7;
    }

    .team-btn {
      background: linear-gradient(135deg, #C4D9FF, #5A8DFF);
      border: none;
      color: #fff;
      padding: 12px 25px;
      border-radius: 30px;
      transition: all 0.3s ease;
      font-weight: 600;
    }

    .team-btn:hover {
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
      transform: translateY(-3px);
    }
  </style>
</head>
<body class="open-sans-font">

<!-- Navbar -->
<?php include("./includes/navbar.php"); ?>

<!-- Hero Section -->
<section class="about-hero">
  <h1>About Help Lagbe?</h1>
  <p>Your trusted local platform for home services — connecting skilled professionals with people who need help, fast and reliably.</p>
</section>

<!-- About Details Section -->
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

<!-- Mission Section -->
<section class="container about-section">
  <div class="section-title">Our Mission</div>
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <p class="mission-text text-center">
        At <strong>Help Lagbe?</strong>, our mission is to simplify your everyday life by providing a platform where you can quickly find and book reliable help from your neighborhood — be it fixing a leaky faucet, deep-cleaning your home, or assembling new furniture. We strive to foster trust and professionalism in every service call, while building a stronger local service economy.
      </p>
      <div class="text-center mt-4">
        <a href="contact.php" class="team-btn">Meet Our Team</a>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<?php include("./includes/footer.php"); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
