<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
</head>
<body>
    <h1 class="text-center text-success mb-5">Sales Report</h1>
    <h2 class="text-center"><?php total_sales(); ?></h2>
    
</body>

</html>

<?php
    function total_sales(){
    global $con; // Make sure $con is defined globally
    $get_orders = "SELECT SUM(amount_due) as total_sales FROM user_orders WHERE order_status='Delivered'";
    $result = mysqli_query($con, $get_orders);

    if ($row_data = mysqli_fetch_assoc($result)) {
        $total_sales = $row_data['total_sales'];
        echo "Total Sales: " . number_format($total_sales, 2) . " BDT";
    } else {
        echo "Total Sales: 0.00 BDT";
    }
    }

?>