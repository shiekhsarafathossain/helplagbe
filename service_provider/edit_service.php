<?php
// This must be included in a file that already has the session started and $con (database connection) available.

if (isset($_GET['edit_service'])) {
    $edit_id = (int)$_GET['edit_service'];
    $provider_id = $_SESSION['provider_id'];

    // Security check: ensure the service belongs to the logged-in provider
    $stmt = $con->prepare("SELECT * FROM service WHERE id = ? AND provider_id = ?");
    $stmt->bind_param("ii", $edit_id, $provider_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "<script>alert('Unauthorized access or service not found.'); window.open('index.php?view_services','_self');</script>";
        exit();
    }

    $row = $result->fetch_assoc();
}

// Handle the form submission to update the service
if (isset($_POST['update_service'])) {

    // --- Retrieve form data ---
    $service_id = $_POST['service_id'];
    $service_title = $_POST['service_title'];
    $service_desc = $_POST['service_desc'];
    $service_price = $_POST['service_price'];
    $keywords = $_POST['keywords'];
    $category_id = $_POST['category_id'];
    $zone_id = $_POST['zone_id'];
    $status = $_POST['status']; // New: Get status

    // --- Image Handling Logic ---
    $old_image1 = $_POST['old_image1'];
    $old_image2 = $_POST['old_image2'];
    $old_image3 = $_POST['old_image3'];

    $new_image1 = $_FILES['image1']['name'];
    $tmp_image1 = $_FILES['image1']['tmp_name'];

    $new_image2 = $_FILES['image2']['name'];
    $tmp_image2 = $_FILES['image2']['tmp_name'];

    $new_image3 = $_FILES['image3']['name'];
    $tmp_image3 = $_FILES['image3']['tmp_name'];

    $update_image1 = !empty($new_image1) ? $new_image1 : $old_image1;
    $update_image2 = !empty($new_image2) ? $new_image2 : $old_image2;
    $update_image3 = !empty($new_image3) ? $new_image3 : $old_image3;

    if (!empty($new_image1)) {
        move_uploaded_file($tmp_image1, "../assets/images/service_images/$update_image1");
    }
    if (!empty($new_image2)) {
        move_uploaded_file($tmp_image2, "../assets/images/service_images/$update_image2");
    }
    if (!empty($new_image3)) {
        move_uploaded_file($tmp_image3, "../assets/images/service_images/$update_image3");
    }

    // --- Database Update ---
    $stmt_update = $con->prepare("UPDATE service SET title=?, description=?, price=?, keywords=?, category_id=?, zone_id=?, image1=?, image2=?, image3=?, status=? WHERE id=?");
    $stmt_update->bind_param("ssssiissssi", $service_title, $service_desc, $service_price, $keywords, $category_id, $zone_id, $update_image1, $update_image2, $update_image3, $status, $service_id);

    if ($stmt_update->execute()) {
        echo "<script>alert('Service updated successfully.'); window.open('index.php?view_services','_self');</script>";
    } else {
        echo "<script>alert('Error updating service.');</script>";
    }

    $stmt_update->close();
}
?>

<div class="container mt-3">
    <h2 class="text-center">Edit Service</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="old_image1" value="<?php echo $row['image1']; ?>">
        <input type="hidden" name="old_image2" value="<?php echo $row['image2']; ?>">
        <input type="hidden" name="old_image3" value="<?php echo $row['image3']; ?>">

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_title" class="form-label">Service Title</label>
            <input type="text" name="service_title" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_desc" class="form-label">Service Description</label>
            <textarea name="service_desc" class="form-control" rows="3" required><?php echo htmlspecialchars($row['description']); ?></textarea>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="service_price" class="form-label">Service Price</label>
            <input type="text" name="service_price" class="form-control" value="<?php echo htmlspecialchars($row['price']); ?>" required>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="keywords" class="form-label">Keywords</label>
            <input type="text" name="keywords" class="form-control" value="<?php echo htmlspecialchars($row['keywords']); ?>" required>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="image1" class="form-label">Service Image 1</label>
            <div class="d-flex align-items-center">
                <img src="../assets/images/service_images/<?php echo $row['image1']; ?>" alt="Image 1" width="100" class="me-3">
                <input type="file" name="image1" class="form-control">
            </div>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="image2" class="form-label">Service Image 2</label>
            <div class="d-flex align-items-center">
                <img src="../assets/images/service_images/<?php echo $row['image2']; ?>" alt="Image 2" width="100" class="me-3">
                <input type="file" name="image2" class="form-control">
            </div>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="image3" class="form-label">Service Image 3</label>
            <div class="d-flex align-items-center">
                <img src="../assets/images/service_images/<?php echo $row['image3']; ?>" alt="Image 3" width="100" class="me-3">
                <input type="file" name="image3" class="form-control">
            </div>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-select">
                <?php
                $select_cat = "SELECT * FROM categories";
                $result_cat = mysqli_query($con, $select_cat);
                while ($cat_row = mysqli_fetch_assoc($result_cat)) {
                    $selected = ($cat_row['category_id'] == $row['category_id']) ? 'selected' : '';
                    echo "<option value='{$cat_row['category_id']}' $selected>" . htmlspecialchars($cat_row['category_title']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="zone_id" class="form-label">Working Zone</label>
            <select name="zone_id" class="form-select">
                <?php
                $select_zone = "SELECT * FROM working_zone";
                $result_zone = mysqli_query($con, $select_zone);
                while ($zone_row = mysqli_fetch_assoc($result_zone)) {
                    $selected = ($zone_row['zone_id'] == $row['zone_id']) ? 'selected' : '';
                    echo "<option value='{$zone_row['zone_id']}' $selected>" . htmlspecialchars($zone_row['zone_name']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="status" class="form-label">Service Status</label>
            <select name="status" class="form-select">
                <option value="true" <?php echo ($row['status'] === 'true') ? 'selected' : ''; ?>>Active</option>
                <option value="false" <?php echo ($row['status'] === 'false') ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="update_service" class="btn btn-primary" value="Update Service">
        </div>
    </form>
</div>
