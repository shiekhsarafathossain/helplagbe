<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - Help Lagbe?</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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

    .team-section-title {
      letter-spacing: 1px;
      font-weight: 700;
    }

    .team-card {
      background: #f7f9fc;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      height: 100%;
    }

    .team-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 123, 255, 0.2);
      background: #e6f0ff;
    }

    .team-img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #dee2e6;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      margin-bottom: 15px;
    }

    .icon-text {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-bottom: 8px;
      font-size: 0.95rem;
    }

    .bio-text {
      color: #555;
      font-size: 0.92rem;
    }

    .text-primary {
      color: #5A8DFF !important;
    }
  </style>
</head>
<body class="open-sans-font">
<!-- Navbar -->
<?php include("./includes/navbar.php"); ?>

<!-- Team Section -->
<section class="container my-5">
  <h2 class="text-center mb-5 team-section-title">Meet Our Team</h2>

  <!-- First Row: 3 Members -->
  <div class="row justify-content-center g-4">
    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/sarafat.jpg" alt="Sheikh Sarafat Hossain" class="team-img">
        <h5 class="fw-semibold mb-1">Sheikh Sarafat Hossain</h5>
        <p class="text-primary fw-semibold">CEO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope text-secondary"></i> ceo@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone text-secondary"></i> +880 1923400407</p>
        <p class="bio-text">Leading the team with passion and vision, dedicated to innovation and growth.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/raya.jpeg" alt="Rijia Parveen Raya" class="team-img">
        <h5 class="fw-semibold mb-1">Rijia Parveen Raya</h5>
        <p class="text-primary fw-semibold">CMO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope text-secondary"></i> cmo@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone text-secondary"></i> +880 1937430623</p>
        <p class="bio-text">Marketing expert driving engagement and brand growth with creative strategies.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/sadia.jpg" alt="Sadia Reza" class="team-img">
        <h5 class="fw-semibold mb-1">Sadia Reza</h5>
        <p class="text-primary fw-semibold">CFO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope text-secondary"></i> cfo@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone text-secondary"></i> +880 1422400607</p>
        <p class="bio-text">Focused on financial excellence and sustainable growth management.</p>
      </div>
    </div>
  </div>

  <!-- Second Row: 2 Members -->
  <div class="row justify-content-center g-4 mt-3">
    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/raisa.jpg" alt="Wasifa Motahara Raisa" class="team-img">
        <h5 class="fw-semibold mb-1">Wasifa Motahara Raisa</h5>
        <p class="text-primary fw-semibold">CTO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope text-secondary"></i> cto@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone text-secondary"></i> +880 1997400107</p>
        <p class="bio-text">Focused on technical excellence and infrastructure management.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/ferdowsi.jpg" alt="Ferdowsi Yesmin" class="team-img">
        <h5 class="fw-semibold mb-1">Ferdowsi Yesmin</h5>
        <p class="text-primary fw-semibold">COO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope text-secondary"></i> c00@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone text-secondary"></i> +880 1934450623</p>
        <p class="bio-text">Ensuring our systems stay scalable and secure with every deployment.</p>
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
