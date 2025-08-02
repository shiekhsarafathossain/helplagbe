<?php

if (isset($_GET['edit_orders'])) {
    $order_id = $_GET['edit_orders'];

    // Fetching the current order data
    $query = "SELECT * FROM user_orders WHERE order_id='$order_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    $invoice_number = $row['invoice_number'];
    $amount_due = $row['amount_due'];
    $estimated_delivery = date('Y-m-d', strtotime($row['estimated_delivery']));
    $address = $row['address'];
    $status = $row['order_status'];
}

// Updating the order
if (isset($_POST['update_order'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount_due = $_POST['amount_due'];
    $estimated_delivery = $_POST['estimated_delivery'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    $update_query = "UPDATE user_orders SET invoice_number='$invoice_number', amount_due='$amount_due', estimated_delivery='$estimated_delivery', address='$address', order_status='$status' WHERE order_id='$order_id'";

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Order Updated Successfully'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Failed to Update Order');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
</head>
<body>
    <div class="container mt-3">
        <h1 class="text-center">Edit Order</h1>
    <form method="post">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="invoice_number" class="form-label">Invoice Number:</label>
            <input type="text" name="invoice_number" id="invoice_number" class="form-control" required value="<?php echo $invoice_number; ?>">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="amount_due" class="form-label">Amount Due:</label>
            <input type="number" step="0.01" name="amount_due" id="amount_due" class="form-control" required value="<?php echo $amount_due; ?>">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="estimated_delivery" class="form-label">Estimated Delivery:</label>
            <input type="date" name="estimated_delivery" id="estimated_delivery" class="form-control" required value="<?php echo $estimated_delivery; ?>">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="address" class="form-label">Address:</label>
            <input type="text" name="address" id="address" class="form-control" required value="<?php echo $address; ?>">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="address" class="form-label">Status:</label>
            <select name="status">
            <option value="Pending" <?php if ($status == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Processing" <?php if ($status == 'Processing') echo 'selected'; ?>>Processing</option>
            <option value="Shipped" <?php if ($status == 'Shipped') echo 'selected'; ?>>Shipped</option>
            <option value="Delivered" <?php if ($status == 'Delivered') echo 'selected'; ?>>Delivered</option>
            <option value="Cancelled" <?php if ($status == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
            </select>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <button type="submit" name="update_order" class="btn button-addtocart-color px-3">Update Order</button>
        </div>
    </form>
    </div>
</body>
</html>
