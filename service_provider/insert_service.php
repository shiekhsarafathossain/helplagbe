<?php
// This file is included in index.php, so connect.php is already included.
if(isset($_POST['insert_service'])){
    $service_title = $_POST['service_title'];
    $service_desc = $_POST['service_desc'];
    $service_price = $_POST['service_price'];
    $category_id = $_POST['category_id'];
    $zone_id = $_POST['zone_id'];
    $provider_id = $_SESSION['provider_id']; // Get provider ID from session

    // Process all three images
    $service_image1 = $_FILES['service_image1']['name'];
    $service_image2 = $_FILES['service_image2']['name'];
    $service_image3 = $_FILES['service_image3']['name'];

    $tmp_image1 = $_FILES['service_image1']['tmp_name'];
    $tmp_image2 = $_FILES['service_image2']['tmp_name'];
    $tmp_image3 = $_FILES['service_image3']['tmp_name'];

    // Move uploaded files to the correct directory
    // Note: The path is corrected to go up one level from the 'service_provider' folder.
    move_uploaded_file($tmp_image1, "../assets/images/service_images/$service_image1");
    move_uploaded_file($tmp_image2, "../assets/images/service_images/$service_image2");
    move_uploaded_file($tmp_image3, "../assets/images/service_images/$service_image3");

    // Insert query updated for three images
    $stmt = $con->prepare("INSERT INTO service (title, description, image1, image2, image3, price, category_id, zone_id, provider_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiiii", $service_title, $service_desc, $service_image1, $service_image2, $service_image3, $service_price, $category_id, $zone_id, $provider_id);
    
    if($stmt->execute()){
        echo "<script>alert('Service has been inserted successfully.')</script>";
        echo "<script>window.open('index.php?view_services','_self')</script>";
    }
    $stmt->close();
}
?>
<div class="container mt-3">
    <h2 class="text-center">Insert New Service</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Title -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_title" class="form-label">Service Title</label>
            <input type="text" name="service_title" id="service_title" class="form-control" required>
        </div>
        <!-- Description -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_desc" class="form-label">Service Description</label>
            <textarea name="service_desc" id="service_desc" class="form-control" rows="3" required></textarea>
        </div>
        <!-- Price -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_price" class="form-label">Service Price</label>
            <input type="text" name="service_price" id="service_price" class="form-control" required>
        </div>
        <!-- Category -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="category_id" class="form-select" required>
                <option value="">Select a Category</option>
                <?php
                    $select_cat = "SELECT * FROM categories";
                    $result_cat = mysqli_query($con, $select_cat);
                    while($row = mysqli_fetch_assoc($result_cat)){
                        echo "<option value='{$row['category_id']}'>{$row['category_title']}</option>";
                    }
                ?>
            </select>
        </div>
        <!-- Zone -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="zone_id" class="form-select" required>
                <option value="">Select a Zone</option>
                <?php
                    $select_zone = "SELECT * FROM working_zone";
                    $result_zone = mysqli_query($con, $select_zone);
                    while($row = mysqli_fetch_assoc($result_zone)){
                        echo "<option value='{$row['zone_id']}'>{$row['zone_name']}</option>";
                    }
                ?>
            </select>
        </div>
        <!-- Image 1 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_image1" class="form-label">Service Image 1 (Main)</label>
            <input type="file" name="service_image1" id="service_image1" class="form-control" required>
        </div>
        <!-- Image 2 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_image2" class="form-label">Service Image 2</label>
            <input type="file" name="service_image2" id="service_image2" class="form-control" required>
        </div>
        <!-- Image 3 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_image3" class="form-label">Service Image 3</label>
            <input type="file" name="service_image3" id="service_image3" class="form-control" required>
        </div>
        <!-- Submit -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="insert_service" class="btn btn-primary" value="Insert Service">
        </div>
    </form>
</div>
