<h2 class="text-center mb-4">My Bookings</h2>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Booking ID</th>
            <th>Service</th>
            <th>Customer Name</th>
            <th>Contact</th>
            <th>Date & Time</th>
            <th>Amount (BDT)</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $provider_id = $_SESSION['provider_id'];
        // The query already selects all booking details with b.*
        $query = "SELECT b.*, s.title as service_title FROM bookings b JOIN service s ON b.service_id = s.id WHERE s.provider_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $provider_id);
        $stmt->execute();
        $result = $stmt->get_result();
        // Updated colspan to 8 for the new column
        if($result->num_rows == 0){
            echo "<tr><td colspan='8' class='text-center'>You have no bookings yet.</td></tr>";
        } else {
            while($row = $result->fetch_assoc()){
                // Formatting the price for display
                $formatted_price = number_format($row['total_price'], 2);
                echo "<tr>
                    <td>{$row['booking_id']}</td>
                    <td>" . htmlspecialchars($row['service_title']) . "</td>
                    <td>" . htmlspecialchars($row['user_name']) . "</td>
                    <td>" . htmlspecialchars($row['user_phone']) . "</td>
                    <td>" . htmlspecialchars($row['booking_date']) . " at " . htmlspecialchars($row['booking_time']) . "</td>
                    <td>{$formatted_price}</td>
                    <td>" . htmlspecialchars($row['booking_status']) . "</td>
                    <td><a href='index.php?edit_booking={$row['booking_id']}' class='btn btn-sm btn-info'>Edit Status</a></td>
                </tr>";
            }
        }
        $stmt->close();
        ?>
    </tbody>
</table>