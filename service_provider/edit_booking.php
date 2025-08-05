<?php
if(isset($_GET['edit_booking'])){
    $booking_id = (int)$_GET['edit_booking'];
    $provider_id = $_SESSION['provider_id'];

    // Security check
    $stmt = $con->prepare("SELECT b.* FROM bookings b JOIN service s ON b.service_id = s.id WHERE b.booking_id = ? AND s.provider_id = ?");
    $stmt->bind_param("ii", $booking_id, $provider_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 0){
        echo "<script>alert('Unauthorized access.'); window.open('index.php?view_bookings','_self');</script>";
        exit();
    }
    $row = $result->fetch_assoc();
}

if(isset($_POST['update_booking'])){
    $booking_id = $_POST['booking_id'];
    $booking_status = $_POST['booking_status'];

    $stmt_update = $con->prepare("UPDATE bookings SET booking_status=? WHERE booking_id=?");
    $stmt_update->bind_param("si", $booking_status, $booking_id);
    if($stmt_update->execute()){
        echo "<script>alert('Booking status updated successfully.'); window.open('index.php?view_bookings','_self');</script>";
    }
    $stmt_update->close();
}
?>
<div class="container mt-3">
    <h2 class="text-center">Edit Booking Status</h2>
    <form action="" method="post" class="w-50 m-auto">
        <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
        <div class="mb-3">
            <strong>Booking ID:</strong> <?php echo $row['booking_id']; ?>
        </div>
        <div class="mb-3">
            <strong>Customer Name:</strong> <?php echo $row['user_name']; ?>
        </div>
        <div class="form-outline mb-4">
            <label for="booking_status" class="form-label">Booking Status</label>
            <select name="booking_status" class="form-select">
                <option <?php if($row['booking_status']=='Pending') echo 'selected'; ?>>Pending</option>
                <option <?php if($row['booking_status']=='Confirmed') echo 'selected'; ?>>Confirmed</option>
                <option <?php if($row['booking_status']=='Completed') echo 'selected'; ?>>Completed</option>
                <option <?php if($row['booking_status']=='Cancelled') echo 'selected'; ?>>Cancelled</option>
            </select>
        </div>
        <div class="form-outline mb-4">
            <input type="submit" name="update_booking" class="btn btn-primary" value="Update Status">
        </div>
    </form>
</div>
