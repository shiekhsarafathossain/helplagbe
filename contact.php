<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - Help Lagbe?</title>

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
      width:70px;
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
    
    /* Section Title */
    .section-title {
      font-weight: 700;
      color: #343a40;
    }

    /* Team Card */
    .team-card {
      background: #ffffff;
      border: 1px solid #e9ecef;
      border-radius: 12px;
      padding: 30px 20px;
      text-align: center;
      height: 100%;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .team-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(90, 141, 255, 0.2);
    }

    .team-img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #5A8DFF;
      margin-bottom: 20px;
    }
    
    .team-card h5 {
        font-weight: 700;
    }
    
    .team-card .text-primary {
      color: #5A8DFF !important;
      font-weight: 600;
    }

    .icon-text {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 8px;
      font-size: 0.95rem;
      color: #6c757d;
    }
    .icon-text i {
        color: #5A8DFF;
    }

    .bio-text {
      color: #6c757d;
      font-size: 0.92rem;
      line-height: 1.6;
    }
  </style>
</head>
<body class="open-sans-font">
<?php include("./includes/navbar.php"); ?>

<section class="container my-5 py-5">
  <h2 class="text-center mb-5 section-title">Meet Our Team</h2>

  <div class="row justify-content-center g-4">
    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/sarafat.jpg" alt="Sheikh Sarafat Hossain" class="team-img">
        <h5 class="mb-1">Sheikh Sarafat Hossain</h5>
        <p class="text-primary mb-3">CEO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope"></i> ceo@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone"></i> +880 1923400407</p>
        <hr class="my-3">
        <p class="bio-text">Leading the team with passion and vision, dedicated to innovation and growth.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/raya.jpeg" alt="Rijia Parveen Raya" class="team-img">
        <h5 class="mb-1">Rijia Parveen Raya</h5>
        <p class="text-primary mb-3">CMO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope"></i> cmo@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone"></i> +880 1937430623</p>
        <hr class="my-3">
        <p class="bio-text">Marketing expert driving engagement and brand growth with creative strategies.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/sadia.jpg" alt="Sadia Reza" class="team-img">
        <h5 class="mb-1">Sadia Reza</h5>
        <p class="text-primary mb-3">CFO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope"></i> cfo@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone"></i> +880 1422400607</p>
        <hr class="my-3">
        <p class="bio-text">Focused on financial excellence and sustainable growth management.</p>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/raisa.jpg" alt="Wasifa Motahara Raisa" class="team-img">
        <h5 class="mb-1">Wasifa Motahara Raisa</h5>
        <p class="text-primary mb-3">CTO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope"></i> cto@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone"></i> +880 1997400107</p>
        <hr class="my-3">
        <p class="bio-text">Focused on technical excellence and infrastructure management.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="team-card">
        <img src="./assets/images/team_images/ferdowsi.jpg" alt="Ferdowsi Yesmin" class="team-img">
        <h5 class="mb-1">Ferdowsi Yesmin</h5>
        <p class="text-primary mb-3">COO</p>
        <p class="icon-text"><i class="fa-solid fa-envelope"></i> coo@helplagbe.com</p>
        <p class="icon-text"><i class="fa-solid fa-phone"></i> +880 1934450623</p>
        <hr class="my-3">
        <p class="bio-text">Ensuring our systems stay scalable and secure with every deployment.</p>
      </div>
    </div>
  </div>
</section>

<?php include("./includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>