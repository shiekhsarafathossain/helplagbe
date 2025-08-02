<?php
// This file should be included within your main admin index.php, so it has access to the $con variable.
// Using prepared statements to prevent SQL injection
if (isset($_GET['edit_booking'])) {
    $booking_id = $_GET['edit_booking'];

    // Fetch the current booking data along with service and user details
    $query = "SELECT b.*, s.title AS service_title 
              FROM `bookings` b
              JOIN `service` s ON b.service_id = s.id
              WHERE b.booking_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $service_name = $row['service_title'];
        $customer_name = $row['user_name'];
        $customer_email = $row['user_email'];
        $customer_phone = $row['user_phone'];
        $location = $row['location'];
        $booking_date = date('d M, Y', strtotime($row['booking_date']));
        $booking_time = date('h:i A', strtotime($row['booking_time']));
        $current_status = $row['booking_status'];
    } else {
        echo "<script>alert('Booking not found!'); window.location.href='index.php?list_bookings';</script>";
        exit;
    }
}

// Updating the booking status
if (isset($_POST['update_booking_status'])) {
    $new_status = $_POST['booking_status'];

    $update_query = "UPDATE bookings SET booking_status = ? WHERE booking_id = ?";
    $stmt_update = $con->prepare($update_query);
    $stmt_update->bind_param("si", $new_status, $booking_id);

    if ($stmt_update->execute()) {
        echo "<script>alert('Booking Status Updated Successfully'); window.location.href='index.php?list_bookings';</script>";
    } else {
        echo "<script>alert('Failed to Update Booking Status');</script>";
    }
}
?>

<style>
    .details-list .list-group-item {
        border: none;
        padding-left: 0;
        display: flex;
        align-items: flex-start; /* Align items to the top */
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
    .details-list .fa-fw {
        margin-right: 15px;
        color: #6c757d;
        font-size: 1.1rem;
        margin-top: 5px;
    }
</style>

<div class="container mt-3">
    <h2 class="text-center mb-4">Manage Booking</h2>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <div class="row">
                        <!-- Left Column: Booking Details -->
                        <div class="col-md-6 border-end pe-md-4">
                            <h4 class="mb-3">Booking #<?php echo htmlspecialchars($booking_id); ?></h4>
                            <ul class="list-group list-group-flush details-list">
                                <li class="list-group-item">
                                    <i class="fas fa-concierge-bell fa-fw"></i>
                                    <div><strong>Service:</strong><br><?php echo htmlspecialchars($service_name); ?></div>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user fa-fw"></i>
                                    <div><strong>Customer:</strong><br><?php echo htmlspecialchars($customer_name); ?></div>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <div><strong>Email:</strong><br><?php echo htmlspecialchars($customer_email); ?></div>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-phone fa-fw"></i>
                                    <div><strong>Phone:</strong><br><?php echo htmlspecialchars($customer_phone); ?></div>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-map-marker-alt fa-fw"></i>
                                    <div><strong>Location:</strong><br><?php echo htmlspecialchars($location); ?></div>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-day fa-fw"></i>
                                    <div><strong>Date & Time:</strong><br><?php echo htmlspecialchars($booking_date . ' at ' . $booking_time); ?></div>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Right Column: Update Status Form -->
                        <div class="col-md-6 ps-md-4 mt-4 mt-md-0">
                            <h4 class="mb-3">Update Status</h4>
                            <form method="post">
                                <div class="alert alert-info">
                                    Current Status: <strong><?php echo htmlspecialchars($current_status); ?></strong>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="booking_status" id="booking_status" class="form-select">
                                        <option value="Pending" <?php if ($current_status == 'Pending') echo 'selected'; ?>>Pending</option>
                                        <option value="Confirmed" <?php if ($current_status == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                                        <option value="Completed" <?php if ($current_status == 'Completed') echo 'selected'; ?>>Completed</option>
                                        <option value="Cancelled" <?php if ($current_status == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                    </select>
                                    <label for="booking_status">New Status</label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" name="update_booking_status" class="btn btn-primary btn-lg">Update Booking</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
