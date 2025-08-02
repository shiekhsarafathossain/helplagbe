<?php
// This file should be included within your main admin index.php

// Initialize variables to avoid errors
$title = $description = $keywords = $category_title = $image1 = $image2 = $image3 = $price = '';
$category_id = 0;
$edit_id = 0;

// Check if service ID is set in the URL
if(isset($_GET['edit_service'])){
    $edit_id = (int)$_GET['edit_service'];

    // Use prepared statements to fetch service data
    $get_data = "SELECT * FROM service WHERE id = ?";
    $stmt_get = $con->prepare($get_data);
    $stmt_get->bind_param("i", $edit_id);
    $stmt_get->execute();
    $result = $stmt_get->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "<script>alert('Service not found.'); window.location.href='index.php?view_services';</script>";
        exit;
    }

    $title = $row['title'];
    $description = $row['description'];
    $keywords = $row['keywords'];
    $category_id = $row['category_id'];
    $image1 = $row['image1'];
    $image2 = $row['image2'];
    $image3 = $row['image3'];
    $price = $row['price'];

    // Fetch the category title
    $select_category = "SELECT category_title FROM categories WHERE category_id = ?";
    $stmt_cat = $con->prepare($select_category);
    $stmt_cat->bind_param("i", $category_id);
    $stmt_cat->execute();
    $result_category = $stmt_cat->get_result();
    if($result_category->num_rows > 0){
        $row_category = $result_category->fetch_assoc();
        $category_title = $row_category['category_title'];
    }
}

// Fetch all categories for the dropdown
$select_category_all = "SELECT * FROM categories";
$result_category_all = mysqli_query($con, $select_category_all);

// Handle form submission for updating the service
if(isset($_POST['update_service_btn'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $keywords = $_POST['keywords'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Handle image uploads: keep old image if no new one is uploaded
    $image1_new = !empty($_FILES['image1']['name']) ? $_FILES['image1']['name'] : $image1;
    $image2_new = !empty($_FILES['image2']['name']) ? $_FILES['image2']['name'] : $image2;
    $image3_new = !empty($_FILES['image3']['name']) ? $_FILES['image3']['name'] : $image3;

    // Move uploaded files to the destination folder
    if(!empty($_FILES['image1']['tmp_name'])) {
        move_uploaded_file($_FILES['image1']['tmp_name'], "../assets/images/service_images/$image1_new");
    }
    if(!empty($_FILES['image2']['tmp_name'])) {
        move_uploaded_file($_FILES['image2']['tmp_name'], "../assets/images/service_images/$image2_new");
    }
    if(!empty($_FILES['image3']['tmp_name'])) {
        move_uploaded_file($_FILES['image3']['tmp_name'], "../assets/images/service_images/$image3_new");
    }

    // Update query using prepared statements
    $update_service = "UPDATE service SET 
        title = ?, description = ?, keywords = ?, category_id = ?, 
        image1 = ?, image2 = ?, image3 = ?, price = ?, date = NOW()
        WHERE id = ?";
    
    $stmt_update = $con->prepare($update_service);
    $stmt_update->bind_param("sssisssdi", $title, $description, $keywords, $category, $image1_new, $image2_new, $image3_new, $price, $edit_id);

    if($stmt_update->execute()){
        echo "<script>alert('Service updated successfully');</script>";
        echo "<script>window.open('./index.php?view_services', '_SELF');</script>";
    } else {
        echo "<script>alert('Failed to update service.');</script>";
    }
}
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <h3 class="text-center mb-4">Edit Service</h3>
                    <hr class="my-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Text Fields -->
                        <div class="form-floating mb-4">
                            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" class="form-control" required>
                            <label for="title">Service Title</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea id="description" name="description" class="form-control" style="height: 100px" required><?php echo htmlspecialchars($description); ?></textarea>
                            <label for="description">Service Description</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="keywords" name="keywords" value="<?php echo htmlspecialchars($keywords); ?>" class="form-control" required>
                            <label for="keywords">Keywords</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-4">
                                    <select name="category" class="form-select">
                                        <option value="<?php echo $category_id; ?>"><?php echo htmlspecialchars($category_title); ?></option>
                                        <?php
                                        mysqli_data_seek($result_category_all, 0); // Reset pointer
                                        while($row_cat = mysqli_fetch_assoc($result_category_all)) {
                                            if ($row_cat['category_id'] != $category_id) {
                                                echo "<option value='{$row_cat['category_id']}'>{$row_cat['category_title']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="category">Service Category</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" class="form-control" required>
                                    <label for="price">Price (BDT)</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Image Uploads -->
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label">Image 1</label>
                                <?php if($image1): ?>
                                    <img src="../assets/images/service_images/<?php echo htmlspecialchars($image1); ?>" alt="Image 1" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                <?php endif; ?>
                                <input type="file" name="image1" class="form-control">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label">Image 2</label>
                                <?php if($image2): ?>
                                    <img src="../assets/images/service_images/<?php echo htmlspecialchars($image2); ?>" alt="Image 2" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                <?php endif; ?>
                                <input type="file" name="image2" class="form-control">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label">Image 3</label>
                                <?php if($image3): ?>
                                    <img src="../assets/images/service_images/<?php echo htmlspecialchars($image3); ?>" alt="Image 3" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                <?php endif; ?>
                                <input type="file" name="image3" class="form-control">
                            </div>
                        </div>

                        <div class="d-grid mt-3">
                            <input type="submit" name="update_service_btn" value="Update Service" class="btn btn-primary btn-lg">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
