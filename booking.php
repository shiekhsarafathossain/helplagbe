<?php
include("./includes/connect.php");
include("./functions/common_function.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login to book a service.')</script>";
    // You might need to adjust the path to your login page
    echo "<script>window.open('./user_area/user_login.php', '_self')</script>"; 
    exit(); // Stop the script from running further
}

// Redirect if no service is selected for booking
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$service_id = $_GET['id'];

// Fetch service details for the summary
$query_service = "SELECT * FROM `service` WHERE `id` = ?";
$stmt_service = $con->prepare($query_service);
$stmt_service->bind_param("i", $service_id);
$stmt_service->execute();
$service_result = $stmt_service->get_result();

if ($service_result->num_rows == 0) {
    echo "<h2 class='text-center text-danger'>Invalid Service Selected!</h2>";
    exit();
}
$service_data = $service_result->fetch_assoc();
$service_title = $service_data['title'];
$service_price = $service_data['price'];
$service_image = $service_data['image1'];

// Handle the booking form submission
if (isset($_POST['confirm_booking'])) {
    // Sanitize and retrieve form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
    $payment_method = $_POST['payment_method'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Server-side validation
    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($location) || empty($payment_method)) {
        echo "<script>alert('Please fill in all required fields.')</script>";
    } else {
        // Prepare and execute the insert query
        $insert_query = "INSERT INTO `bookings` (service_id, user_id, user_name, user_email, user_phone, booking_date, booking_time, location, payment_method, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insert_query);
        $stmt->bind_param("iisssssssd", $service_id, $user_id, $name, $email, $phone, $date, $time, $location, $payment_method, $service_price);
        
        if ($stmt->execute()) {
            echo "<script>alert('Booking successful! We will contact you soon.')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Error: Could not process your booking.')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Global Styles */
        body {
          font-family: "Open Sans", sans-serif;
          background-color: #f8f9fa;
        }

        /* Card Styles */
        .card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        /* Form Styling */
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.8rem 1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #5A8DFF;
            box-shadow: 0 0 0 0.25rem rgba(90, 141, 255, 0.25);
        }

        /* Booking Summary Card */
        .booking-summary .card {
            background-color: #ffffff;
        }
        .booking-summary img {
            width: 100px; 
            height: 100px; 
            object-fit: cover;
        }
        .booking-summary .price-display {
            font-size: 1.5rem;
            font-weight: 700;
            color: #5A8DFF;
        }

        /* Button */
        .btn-primary {
            background-color: #5A8DFF;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #4A7BDE;
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="open-sans-font">
    <?php include("./includes/navbar.php"); ?>

    <div class="container my-5">
        <h1 class="text-center mb-5 fw-bold">Confirm Your Booking</h1>
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="card p-4">
                    <h3 class="mb-4 fw-bold">Your Details</h3>
                    <form action="" method="post" id="bookingForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Preferred Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">Preferred Time</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Your Address/Location</label>
                            <textarea class="form-control" id="location" name="location" rows="3" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="" disabled selected>Select a payment method</option>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                                <option value="Card Payment">Card Payment (Online)</option>
                            </select>
                        </div>
                        <button type="submit" name="confirm_booking" class="btn btn-primary w-100 py-3">Confirm Booking</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="booking-summary">
                    <div class="card p-4">
                        <h3 class="mb-4 fw-bold">Booking Summary</h3>
                        <div class="d-flex align-items-center mb-4">
                            <img src="./assets/images/service_images/<?php echo $service_image; ?>" class="img-fluid rounded me-3" alt="<?php echo $service_title; ?>">
                            <div>
                                <h5 class="mb-1 fw-bold"><?php echo $service_title; ?></h5>
                                <p class="mb-0 text-muted">Service Fee</p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0 h5">Total Price:</p>
                            <p class="mb-0 price-display">BDT <?php echo number_format($service_price, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("./includes/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>