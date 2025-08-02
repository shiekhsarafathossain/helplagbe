<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Orders</title>
</head>
<body>
    <h1 class="text-center text-success">All Orders</h1>
    <table class="table table-border mt-5 text-center">
        <thead class="bg-info">
            <tr>
                <th>Order ID</th>
                <th>Invoice Number</th>
                <th>Due Amount</th>
                <th>Order Date</th>
                <th>Estimated Date</th>
                <th>Address</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light text-center">
            <?php
            $get_orders="SELECT * FROM user_orders";
            $result=mysqli_query($con,$get_orders);
            while($row_data=mysqli_fetch_assoc($result)){
                $order_id=$row_data['order_id'];
                $user_id=$row_data['user_id'];
                $invoice_number=$row_data['invoice_number'];
                $amount_due=$row_data['amount_due'];
                $order_date=date("Y-m-d", strtotime($row_data['order_date'])); // Formatting the date
                $estimated_delivery=date("Y-m-d", strtotime($row_data['estimated_delivery'])); // Formatting the date
                $address=$row_data['address'];
                $status=$row_data['order_status'];
                echo "
                <tr class='text-center'>
                <td>$order_id</td>
                <td>$invoice_number</td>
                <td>$amount_due</td>
                <td>$order_date</td>
                <td>$estimated_delivery</td>
                <td>$address</td>
                <td>$status</td>
                <td><a href='./index.php?edit_orders=$order_id' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='./index.php?delete_orders=$order_id' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
        
            </tr>
                ";
            }   
            ?>

            
        </tbody>
    </table>
</body>

</html>