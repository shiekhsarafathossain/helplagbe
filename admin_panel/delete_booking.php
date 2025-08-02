<?php
if(isset($_GET['delete_booking'])){
    $delete_id = $_GET['delete_booking'];

    // Security: Using a prepared statement to prevent SQL injection
    $delete_query = "DELETE FROM `bookings` WHERE booking_id = ?";
    
    $stmt = $con->prepare($delete_query);
    // 'i' specifies the variable type is integer
    $stmt->bind_param("i", $delete_id);
    
    if($stmt->execute()){
        echo "<script>alert('Booking has been deleted successfully.')</script>";
        // Redirect back to the list of bookings page
        echo "<script>window.open('./index.php?list_bookings','_self')</script>";
    } else {
        echo "<script>alert('Error: Could not delete the booking.')</script>";
        echo "<script>window.open('./index.php?list_bookings','_self')</script>";
    }
}
?>
