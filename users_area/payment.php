<?php
@session_start(); // Start the session
include("../Includes/connect.php");
include("../functions/common_function.php");

$user_shipping_address = ''; // Initialize

// Get user from session
if (isset($_SESSION['username'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM user_table WHERE username='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);

    if ($result_query && mysqli_num_rows($result_query) > 0) {
        $row_fetch = mysqli_fetch_assoc($result_query);
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_shipping_address = $row_fetch['user_shipping_address'];

        // Update shipping address
        if (isset($_POST['user_update'])) {
            $user_shipping_address = $_POST['user_shipping_address'];
            $update_data = "UPDATE user_table SET user_shipping_address='$user_shipping_address' WHERE user_id=$user_id";
            $result_query_update = mysqli_query($con, $update_data);

            if ($result_query_update) {
                echo "<script>alert('Shipping address updated successfully');</script>";
            }
        }
    }
}

// Calculate cart total
$user_ip = getIPAddress();
$cart_query = "SELECT * FROM cart_details WHERE ip_address='$user_ip'";
$result = mysqli_query($con, $cart_query);

$total_price = 0;

// ✅ Determine delivery charge based on address
if (stripos($user_shipping_address, 'Dhaka') !== false) {
    $delivery = 60;
} else {
    $delivery = 120;
}

if (mysqli_num_rows($result) == 0) {
    $money = 0;
    $delivery = 0;
    echo "<script>alert('Add product to cart');</script>";
    echo "<script>window.open('../display_all.php','_self');</script>";
} else {
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        $product_query = "SELECT * FROM products WHERE product_id = '$product_id'";
        $product_result = mysqli_query($con, $product_query);

        while ($product = mysqli_fetch_array($product_result)) {
            $price = $product['product_price'];
            $sub_total = $price * $quantity;
            $total_price += $sub_total;
        }
    }
}

$money = round($total_price + $delivery);
$link_href = "order.php?user_id=$user_id";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Address</title>
</head>
<body class="open-sans-font">
    <h3 class="text-center text-success mb-4 fw-bold">Shipping Address</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_shipping_address ?>" name="user_shipping_address">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" value="Update" class="btn button-addtocart-color" name="user_update">
        </div>
    </form>

<div class="col-md-9 m-auto my-4">
  <div class="row mx-0">
    <!-- Left: Payment Method -->
    <div class="col-md-7">
      <h4>Payment Method <small class="text-muted">(Please select a payment method)</small></h4>
      <!-- Cash on Delivery -->
      <div class="form-check my-3">
        <input class="form-check-input" type="radio" name="paymentMethod" id="cod">
        <label class="form-check-label" for="cod">
          <img src="../assets/images/cod.png" alt="Cash on Delivery" style="height: 24px;"> <b>Cash on Delivery</b>
        </label>
      </div>

      <!-- Mobile Wallet -->
      <h6 class="mt-4">Mobile Wallet</h6>
      <div class="d-flex flex-wrap gap-3">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="paymentMethod" id="bkash">
          <label class="form-check-label" for="bkash">
            <img src="../assets/images/bkash.png" alt="bKash" style="height: 30px;">
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="paymentMethod" id="nagad">
          <label class="form-check-label" for="nagad">
            <img src="../assets/images/nagad.png" alt="Nagad" style="height: 30px;">
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="paymentMethod" id="rocket">
          <label class="form-check-label" for="rocket">
            <img src="../assets/images/rocket.png" alt="Rocket" style="height: 30px;">
          </label>
        </div>
      </div>

      <!-- Card Payment -->
      <h6 class="mt-4">Debit / Credit Card</h6>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentMethod" id="card">
        <label class="form-check-label" for="card">
          <img src="../assets/images/atm_card.png" alt="Visa Mastercard Amex" style="height: 30px;">
        </label>
      </div>

      <!-- Terms & Confirm -->
      <div class="form-check mt-4">
        <input class="form-check-input" type="checkbox" id="agree">
        <label class="form-check-label" for="agree">
          I agree to the <a href="#">terms & conditions</a>.
        </label>
      </div>
    </div>

    <!-- Right: Checkout Summary -->
    <div class="col-md-5">
      <div class="border p-3 rounded shadow-sm">
        <h5>Checkout Summary</h5>
        <hr>
        <div class="d-flex justify-content-between">
          <span>Subtotal</span>
          <span>TK. <?php echo $total_price; ?></span>
        </div>
        <div class="d-flex justify-content-between">
          <span>Delivery Charge</span>
          <span>TK. <?php echo $delivery; ?></span>
        </div>
        <hr>
        <div class="d-flex justify-content-between fw-bold">
          <span>Total</span>
          <span>TK. <?php echo $money; ?></span>
        </div>

        <!-- Confirm Button -->
        <a href="<?php echo $link_href; ?>">
            <button class="btn btn-primary w-100 mt-4">Confirm Order TK. <?php echo $money; ?></button>
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
