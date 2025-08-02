<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders Payment</title>
</head>
<body>
    <h1 class="text-center text-success">All Payments</h1>
    <table class="table table-border mt-5 text-center">
        <thead class="bg-info">
            <tr>
                <th>Order ID</th>
                <th>Username</th>
                <th>Invoice Number</th>
                <th>Amount Paid</th>
                <th>Order Date</th>
                <th>User Address</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light text-center">
            <?php
            $get_orders="SELECT * FROM user_orders WHERE order_status='Delivered'";
            $result=mysqli_query($con,$get_orders);
            while($row_data=mysqli_fetch_assoc($result)){
                $order_id=$row_data['order_id'];
                $user_id=$row_data['user_id'];
                $get_user = "SELECT * FROM user_table WHERE user_id=$user_id";
                $result_user = mysqli_query($con, $get_user);
                $row_user = mysqli_fetch_assoc($result_user);
                $username = $row_user['username'];
                $invoice_number=$row_data['invoice_number'];
                $amount_due=$row_data['amount_due'];
                $order_date=date("Y-m-d", strtotime($row_data['order_date'])); // Formatting the date
                $estimated_delivery=date("Y-m-d", strtotime($row_data['estimated_delivery'])); // Formatting the date
                $address=$row_data['address'];
                $status=$row_data['order_status'];
                echo "
                <tr class='text-center'>
                <td>$order_id</td>
                <td>$username</td>
                <td>$invoice_number</td>
                <td>$amount_due</td>
                <td>$order_date</td>
                <td>$address</td>
                <td>$status</td>
               
            </tr>
                ";
            }   
            ?>

            
        </tbody>
    </table>
</body>

</html>