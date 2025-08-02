<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Payments</title>
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Completed Bookings & Payments</h3>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Service Name</th>
                                        <th>Customer Name</th>
                                        <th>Amount Paid (BDT)</th>
                                        <th>Payment Method</th>
                                        <th>Completion Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Joining bookings with service table to get the service title for completed bookings
                                    $get_payments = "SELECT b.*, s.title AS service_title 
                                                     FROM `bookings` AS b 
                                                     JOIN `service` AS s ON b.service_id = s.id 
                                                     WHERE b.booking_status = 'Completed'
                                                     ORDER BY b.booking_date DESC";

                                    $result = mysqli_query($con, $get_payments);
                                    $num_of_rows = mysqli_num_rows($result);

                                    if ($num_of_rows == 0) {
                                        echo "<tr><td colspan='7' class='text-center p-4'>No completed payments found.</td></tr>";
                                    } else {
                                        while ($row_data = mysqli_fetch_assoc($result)) {
                                            $booking_id = $row_data['booking_id'];
                                            $service_title = $row_data['service_title'];
                                            $customer_name = $row_data['user_name'];
                                            $amount_paid = $row_data['total_price'];
                                            $payment_method = $row_data['payment_method'];
                                            $completion_date = date("d M, Y", strtotime($row_data['booking_date']));
                                            $status = $row_data['booking_status'];

                                            echo "
                                            <tr>
                                                <td>#{$booking_id}</td>
                                                <td class='text-start'>{$service_title}</td>
                                                <td>{$customer_name}</td>
                                                <td>" . number_format($amount_paid, 2) . "</td>
                                                <td>{$payment_method}</td>
                                                <td>{$completion_date}</td>
                                                <td><span class='badge bg-success'>{$status}</span></td>
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
