<?php

if(isset($_GET['edit_service'])){
    $edit_id = $_GET['edit_service'];
    $get_data = "SELECT * FROM service WHERE id=$edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "<p>No Service found.</p>";
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

    $select_category = "SELECT * FROM categories WHERE category_id=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];
}

$select_category_all = "SELECT * FROM categories";
$result_category_all = mysqli_query($con, $select_category_all);
?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <h1 class="text-center mb-4">Edit Services</h1>

        <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
            <!-- Title -->
            <div class="form-outline mb-3 w-100">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" class="form-control" required>
            </div>

            <!--  Description -->
            <div class="form-outline mb-3 w-100">
                <label for="description" class="form-label">Description</label>
                <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($description); ?>" class="form-control" required>
            </div>

            <!--  Keywords -->
            <div class="form-outline mb-3 w-100">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" id="keywords" name="keywords" value="<?php echo htmlspecialchars($keywords); ?>" class="form-control" required>
            </div>

            <!-- Category -->
            <div class="form-outline mb-3 w-100">
                <label for="category" class="form-label">Service Category</label>
                <select name="category" class="form-select">
                    <option value="<?php echo $category_id; ?>"><?php echo htmlspecialchars($category_title); ?></option>
                    <?php
                    while($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                        echo "<option value='{$row_category_all['category_id']}'>{$row_category_all['category_title']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Price -->
            <div class="form-outline mb-3 w-100">
                <label for="price" class="form-label"> Price</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" class="form-control" required>
            </div>

            <!--  Images -->
            <div class="form-outline mb-3 w-100">
                <label class="form-label">Current Image 1</label><br>
                <?php if($image1): ?>
                    <img src="../assets/images/service_images/<?php echo htmlspecialchars($image1); ?>" alt="Image 1" style="max-width: 150px; margin-bottom:10px;">
                <?php else: ?>
                    <p>No image uploaded.</p>
                <?php endif; ?>
                <input type="file" name="image1" class="form-control">
            </div>

            <div class="form-outline mb-3 w-100">
                <label class="form-label">Current Image 2</label><br>
                <?php if($image2): ?>
                    <img src="../assets/images/service_images/<?php echo htmlspecialchars($image2); ?>" alt="Image 2" style="max-width: 150px; margin-bottom:10px;">
                <?php else: ?>
                    <p>No image uploaded.</p>
                <?php endif; ?>
                <input type="file" name="image2" class="form-control">
            </div>

            <div class="form-outline mb-3 w-100">
                <label class="form-label">Current Image 3</label><br>
                <?php if($image3): ?>
                    <img src="../assets/images/service_images/<?php echo htmlspecialchars($image3); ?>" alt="Image 3" style="max-width: 150px; margin-bottom:10px;">
                <?php else: ?>
                    <p>No image uploaded.</p>
                <?php endif; ?>
                <input type="file" name="image3" class="form-control">
            </div>

            <div class="text-center mt-4">
                <input type="submit" name="edit_service" value="Update Service" class="btn button-addtocart-color px-4 mb-4">
            </div>
        </form>
    </div>
</div>

<?php
if(isset($_POST['edit_service'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $keywords = $_POST['keywords'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Handle images - keep old if no new upload
    $image1 = !empty($_FILES['image1']['name']) ? $_FILES['image1']['name'] : $row['image1'];
    $image2 = !empty($_FILES['image2']['name']) ? $_FILES['image2']['name'] : $row['image2'];
    $image3 = !empty($_FILES['image3']['name']) ? $_FILES['image3']['name'] : $row['image3'];

    // Move uploaded images if any
    if(!empty($_FILES['image1']['tmp_name'])) {
        move_uploaded_file($_FILES['image1']['tmp_name'], "../assets/images/service_images/$image1");
    }
    if(!empty($_FILES['image2']['tmp_name'])) {
        move_uploaded_file($_FILES['image2']['tmp_name'], "../assets/images/service_images/$image2");
    }
    if(!empty($_FILES['image3']['tmp_name'])) {
        move_uploaded_file($_FILES['image3']['tmp_name'], "../assets/images/service_images/$image3");
    }

    // Update query
    $update_service = "UPDATE service SET 
        title='$title',
        description='$description',
        keywords='$keywords',
        category_id='$category',
        image1='$image1',
        image2='$image2',
        image3='$image3',
        price='$price',
        date=NOW()
        WHERE id=$edit_id";

    $result_update = mysqli_query($con, $update_service);

    if($result_update){
        echo "<script>alert('Service updated successfully');</script>";
        echo "<script>window.open('./index.php?view_services', '_SELF');</script>";
    } else {
        echo "<script>alert('Failed to update Services.');</script>";
    }
}
?>
