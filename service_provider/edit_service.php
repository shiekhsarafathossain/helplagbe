<?php
if(isset($_GET['edit_service'])){
    $edit_id = (int)$_GET['edit_service'];
    $provider_id = $_SESSION['provider_id'];
    
    // Security check: ensure the service belongs to the logged-in provider
    $stmt = $con->prepare("SELECT * FROM service WHERE id = ? AND provider_id = ?");
    $stmt->bind_param("ii", $edit_id, $provider_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 0){
        echo "<script>alert('Unauthorized access.'); window.open('index.php?view_services','_self');</script>";
        exit();
    }
    $row = $result->fetch_assoc();
}

if(isset($_POST['update_service'])){
    $service_id = $_POST['service_id'];
    $service_title = $_POST['service_title'];
    $service_desc = $_POST['service_desc'];
    $service_price = $_POST['service_price'];
    $category_id = $_POST['category_id'];
    $zone_id = $_POST['zone_id'];

    $stmt_update = $con->prepare("UPDATE service SET title=?, description=?, price=?, category_id=?, zone_id=? WHERE id=?");
    $stmt_update->bind_param("sssiii", $service_title, $service_desc, $service_price, $category_id, $zone_id, $service_id);
    if($stmt_update->execute()){
        echo "<script>alert('Service updated successfully.'); window.open('index.php?view_services','_self');</script>";
    }
    $stmt_update->close();
}
?>
<div class="container mt-3">
    <h2 class="text-center">Edit Service</h2>
    <form action="" method="post">
        <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_title" class="form-label">Service Title</label>
            <input type="text" name="service_title" class="form-control" value="<?php echo $row['title']; ?>" required>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_desc" class="form-label">Service Description</label>
            <textarea name="service_desc" class="form-control" rows="3" required><?php echo $row['description']; ?></textarea>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_price" class="form-label">Service Price</label>
            <input type="text" name="service_price" class="form-control" value="<?php echo $row['price']; ?>" required>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="category_id" class="form-select">
                <?php
                    $select_cat = "SELECT * FROM categories";
                    $result_cat = mysqli_query($con, $select_cat);
                    while($cat_row = mysqli_fetch_assoc($result_cat)){
                        $selected = ($cat_row['category_id'] == $row['category_id']) ? 'selected' : '';
                        echo "<option value='{$cat_row['category_id']}' $selected>{$cat_row['category_title']}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="zone_id" class="form-select">
                <?php
                    $select_zone = "SELECT * FROM working_zone";
                    $result_zone = mysqli_query($con, $select_zone);
                    while($zone_row = mysqli_fetch_assoc($result_zone)){
                        $selected = ($zone_row['zone_id'] == $row['zone_id']) ? 'selected' : '';
                        echo "<option value='{$zone_row['zone_id']}' $selected>{$zone_row['zone_name']}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="update_service" class="btn btn-primary" value="Update Service">
        </div>
    </form>
</div>
