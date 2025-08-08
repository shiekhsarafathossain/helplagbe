<h3 class="text-center mb-4">My Booked Services</h3>
<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Service Name</th>
            <th>Service Provider</th>
            <th>Provider Contact</th>
            <th>Booking Date</th>
            <th>Location</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Get the username from the session
        $username = $_SESSION['username'];
        
        // Prepare a statement to get the user_id from the username
        $get_user = $con->prepare("SELECT user_id FROM user_table WHERE username = ?");
        $get_user->bind_param("s", $username);
        $get_user->execute();
        $result_user = $get_user->get_result();
        $row_user = $result_user->fetch_assoc();
        $user_id = $row_user['user_id'];
        $get_user->close();

        // Prepare a statement to get all bookings for this user, including provider details
        $get_bookings = $con->prepare("SELECT b.*, s.title as service_title, sp.provider_name, sp.provider_contact 
                                       FROM bookings b 
                                       JOIN service s ON b.service_id = s.id 
                                       LEFT JOIN service_provider sp ON s.provider_id = sp.provider_id
                                       WHERE b.user_id = ? ORDER BY b.booking_date DESC");
        $get_bookings->bind_param("i", $user_id);
        $get_bookings->execute();
        $result_bookings = $get_bookings->get_result();
        
        if($result_bookings->num_rows == 0){
            echo "<tr><td colspan='8' class='text-center'>You have not booked any services yet.</td></tr>";
        } else {
            $count = 1;
            while($row_booking = $result_bookings->fetch_assoc()){
                $service_title = $row_booking['service_title'];
                // Use null coalescing operator to handle cases where provider might be null
                $provider_name = $row_booking['provider_name'] ?? 'N/A';
                $provider_contact = $row_booking['provider_contact'] ?? 'N/A';
                $booking_date = date("d M, Y", strtotime($row_booking['booking_date']));
                $location = $row_booking['location'];
                $price = $row_booking['total_price'];
                $status = $row_booking['booking_status'];

                echo "<tr>
                        <td>{$count}</td>
                        <td>{$service_title}</td>
                        <td>{$provider_name}</td>
                        <td>{$provider_contact}</td>
                        <td>{$booking_date}</td>
                        <td>{$location}</td>
                        <td>৳ " . number_format($price) . "</td>
                        <td>{$status}</td>
                      </tr>";
                $count++;
            }
        }
        $get_bookings->close();
        ?>
    </tbody>
</table>
