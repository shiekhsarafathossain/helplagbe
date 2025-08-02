<?php
include("../Includes/connect.php");
include("../functions/common_function.php");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

// Get user shipping address
$shipping_address = '';
$get_user_query = "SELECT user_shipping_address FROM user_table WHERE user_id = $user_id";
$result_user = mysqli_query($con, $get_user_query);
if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $shipping_address = mysqli_real_escape_string($con, $row_user['user_shipping_address']);
}

// Getting total items and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);

$invoice_number = mt_rand();
$status = 'Pending';
$count_products = mysqli_num_rows($result_cart_price);

// Loop through cart items to calculate total
while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "SELECT * FROM products WHERE product_id=$product_id";
    $run_price = mysqli_query($con, $select_product);

    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = $row_product_price['product_price'];
        $total_price += $product_price;
    }
}

// Getting quantity from cart (first row only)
$get_cart = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address'";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];
$product_id = $get_item_quantity['product_id']; // capture product_id here for pending orders

// quantity sold update

$quantity_sold = "UPDATE products SET sold_quantity=sold_quantity+$quantity WHERE product_id=$product_id";
$run_quantity = mysqli_query($con, $quantity_sold);

// end


if ($quantity == 0 || $quantity == 1) {
    $quantity = 1;
    $subtotal = $total_price;
} else {
    $subtotal = $total_price * $quantity;
}
$date_after_3_days = date('Y-m-d H:i:s', strtotime('+3 days'));
// Insert into user_orders (now including shipping address)
$insert_orders = "INSERT INTO user_orders 
(user_id, amount_due, invoice_number, total_products, order_date, estimated_delivery, order_status, user_shipping_address) 
VALUES ($user_id, $subtotal, $invoice_number, $count_products, NOW(),'$date_after_3_days', '$status', '$shipping_address')";

$result_query = mysqli_query($con, $insert_orders);

if ($result_query) {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

// Insert into order_pending (now including shipping address)
$insert_pending_orders = "INSERT INTO order_pending 
(user_id, invoice_number, product_id, quantity, order_status, user_shipping_address) 
VALUES ($user_id, $invoice_number, $product_id, $quantity, '$status', '$shipping_address')";

$result_pending_orders = mysqli_query($con, $insert_pending_orders);

// Clear the cart
$empty_cart = "DELETE FROM cart_details WHERE ip_address='$get_ip_address'";
$result_delete = mysqli_query($con, $empty_cart);
?>
