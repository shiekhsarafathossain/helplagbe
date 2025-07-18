<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="style.css">
    <title>Welcome to helplagbe</title>
</head>
<body>
    <!-- Nav bar start -->
    <?php include("./common_function/navbar.php"); ?>
    <!-- Nav bar end -->

    <!-- center start -->
    <div class="container-fluid">
        <div class="row"> <!-- Added proper row wrapper -->

            <!-- sidebar start -->
            <div class="col-md-2">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="height: 100vh;"> 
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"> 
                        <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true">
                            <use xlink:href="#bootstrap"></use>
                        </svg> 
                        <span class="fs-4">Our Services</span> 
                    </a> 
                    <hr> 
                    <ul class="nav nav-pills flex-column mb-auto"> 
                        <li class="nav-item"> 
                            <a href="#" class="nav-link active" aria-current="page"> 
                                <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Electrical Services
                            </a> 
                        </li> 
                        <li> 
                            <a href="#" class="nav-link link-body-emphasis"> 
                                <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#speedometer2"></use>
                                </svg>
                                Renovation Services
                            </a> 
                        </li> 
                        <li> 
                            <a href="#" class="nav-link link-body-emphasis"> 
                                <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#table"></use>
                                </svg>
                                AC Repair Services
                            </a> 
                        </li> 
                        <li> 
                            <a href="#" class="nav-link link-body-emphasis"> 
                                <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#grid"></use>
                                </svg>
                                Computer Repair Services
                            </a> 
                        </li> 
                        <li> 
                            <a href="#" class="nav-link link-body-emphasis"> 
                                <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#people-circle"></use>
                                </svg>
                                Plumbing Solution Services
                            </a> 
                        </li>
                        <li> 
                            <a href="#" class="nav-link link-body-emphasis"> 
                                <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#grid"></use>
                                </svg>
                                Cleaning Services
                            </a> 
                        </li>  
                    </ul> 
                </div>
            </div>
            <!-- sidebar end -->
            
            <!-- main content start -->
            <div class="col-md-10 pt-3">
                <div class="container my-4">
                    <h2 class="mb-4">Available Services</h2>

<div class="d-flex overflow-auto gap-4 pb-3">
    <!-- Card 1 -->
    <div class="card" style="min-width: 300px;">
        <div class="card-body">
            <h5 class="card-title">AC Repair Service</h5>
            <h6 class="card-subtitle mb-2 text-muted">Provider: CoolFix Ltd.</h6>
            <p class="card-text">We fix all types of AC problems including gas refill, cleaning, and compressor issues.</p>
            <p class="card-text mb-1"><strong>Price:</strong> ৳1500</p>
            <p class="card-text mb-1"><strong>Time:</strong> 🕒 2 hours</p>
            <p class="card-text mb-3"><strong>Rating:</strong> ⭐⭐⭐⭐☆</p>
            <a href="#" class="btn btn-primary me-2">Book Now</a>
            <a href="#" class="btn btn-outline-secondary">View Details</a>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="card" style="min-width: 300px;">
        <div class="card-body">
            <h5 class="card-title">Plumbing Solution</h5>
            <h6 class="card-subtitle mb-2 text-muted">Provider: AquaFix Services</h6>
            <p class="card-text">Professional plumbing support for pipe leaks, faucet repair, and bathroom installations.</p>
            <p class="card-text mb-1"><strong>Price:</strong> ৳800</p>
            <p class="card-text mb-1"><strong>Time:</strong> 🕒 1.5 hours</p>
            <p class="card-text mb-3"><strong>Rating:</strong> ⭐⭐⭐⭐⭐</p>
            <a href="#" class="btn btn-primary me-2">Book Now</a>
            <a href="#" class="btn btn-outline-secondary">View Details</a>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="card" style="min-width: 300px;">
        <div class="card-body">
            <h5 class="card-title">Electrical Repair</h5>
            <h6 class="card-subtitle mb-2 text-muted">Provider: ElectroCare</h6>
            <p class="card-text">Certified electricians available for home wiring, socket installation, and lighting issues.</p>
            <p class="card-text mb-1"><strong>Price:</strong> ৳1200</p>
            <p class="card-text mb-1"><strong>Time:</strong> 🕒 2-3 hours</p>
            <p class="card-text mb-3"><strong>Rating:</strong> ⭐⭐⭐⭐☆</p>
            <a href="#" class="btn btn-primary me-2">Book Now</a>
            <a href="#" class="btn btn-outline-secondary">View Details</a>
        </div>
    </div>

    <!-- Add more cards as needed -->
</div>


                </div>
            </div>
            <!-- main content end -->

        </div>
    </div>
    <!-- center end -->
    

    

    

    

    

    <!-- footer start -->
    <?php include("./common_function/footer.php"); ?>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>