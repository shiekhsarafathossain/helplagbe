<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Bookings</title>
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">All Booked Services</h3>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Service Name</th>
                                        <th>Customer Name</th>
                                        <th>Price (BDT)</th>
                                        <th>Service Date</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Joining bookings with service table to get the service title
                                    $get_bookings = "SELECT b.*, s.title AS service_title 
                                                     FROM `bookings` AS b 
                                                     JOIN `service` AS s ON b.service_id = s.id 
                                                     ORDER BY b.created_at DESC";

                                    $result = mysqli_query($con, $get_bookings);
                                    $num_of_rows = mysqli_num_rows($result);

                                    if ($num_of_rows == 0) {
                                        echo "<tr><td colspan='8' class='text-center p-4'>No bookings found.</td></tr>";
                                    } else {
                                        while ($row_data = mysqli_fetch_assoc($result)) {
                                            $booking_id = $row_data['booking_id'];
                                            $service_title = $row_data['service_title'];
                                            $customer_name = $row_data['user_name'];
                                            $price = $row_data['total_price'];
                                            $booking_date = date("d M, Y", strtotime($row_data['booking_date']));
                                            $status = $row_data['booking_status'];

                                            // Determine badge color based on status
                                            $status_badge_class = '';
                                            switch ($status) {
                                                case 'Pending':
                                                    $status_badge_class = 'bg-warning text-dark';
                                                    break;
                                                case 'Confirmed':
                                                    $status_badge_class = 'bg-info text-dark';
                                                    break;
                                                case 'Completed':
                                                    $status_badge_class = 'bg-success';
                                                    break;
                                                case 'Cancelled':
                                                    $status_badge_class = 'bg-danger';
                                                    break;
                                                default:
                                                    $status_badge_class = 'bg-secondary';
                                            }

                                            echo "
                                            <tr>
                                                <td>#{$booking_id}</td>
                                                <td class='text-start'>{$service_title}</td>
                                                <td>{$customer_name}</td>
                                                <td>" . number_format($price, 2) . "</td>
                                                <td>{$booking_date}</td>
                                                <td><span class='badge {$status_badge_class}'>{$status}</span></td>
                                                <td>
                                                    <a href='./index.php?edit_booking={$booking_id}' class='text-primary'>
                                                        <i class='fa-solid fa-pen-to-square'></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href='./index.php?delete_booking={$booking_id}' class='text-danger' onclick=\"return confirm('Are you sure you want to delete this booking?');\">
                                                        <i class='fa-solid fa-trash'></i>
                                                    </a>
                                                </td>
                                            </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
