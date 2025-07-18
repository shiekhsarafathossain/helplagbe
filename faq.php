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
    body {
      font-family: 'Open Sans', sans-serif;
      background-color: #f5f9ff;
      color: #333;
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
<body>

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
