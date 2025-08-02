<?php
// This file should be included within your main admin index.php

// Initialize the variable to avoid errors
$category_title = '';
$edit_category_id = 0;

// Check if category ID is set in the URL
if(isset($_GET['edit_category'])){
    $edit_category_id = (int)$_GET['edit_category'];

    // Use prepared statements for security
    $get_categories = "SELECT * FROM categories WHERE category_id = ?";
    $stmt = $con->prepare($get_categories);
    $stmt->bind_param("i", $edit_category_id);
    $stmt->execute();
    $result_cat = $stmt->get_result();

    if($result_cat->num_rows > 0){
        $row = $result_cat->fetch_assoc();
        $category_title = $row['category_title'];
    } else {
        echo "<script>alert('Invalid category ID'); window.location.href='index.php?view_categories';</script>";
        exit();
    }
}

// Update category logic
if(isset($_POST['update_category_btn'])){
    $cat_title = $_POST['category_title'];
    
    // Use prepared statements for the update query
    $update_query = "UPDATE categories SET category_title = ? WHERE category_id = ?";
    $stmt_update = $con->prepare($update_query);
    $stmt_update->bind_param("si", $cat_title, $edit_category_id);

    if($stmt_update->execute()){
        echo "<script>alert('Category updated successfully')</script>";
        echo "<script>window.open('./index.php?view_categories','_SELF')</script>";
    } else {
        echo "<script>alert('Category update failed!')</script>";
    }
}
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <h3 class="text-center mb-4">Edit Category</h3>
                    <hr class="my-4">
                    <form action="" method="post" class="text-center">
                        <div class="form-floating mb-4">
                            <input type="text" name="category_title" id="category_title" class="form-control" required value="<?php echo htmlspecialchars($category_title); ?>">
                            <label for="category_title">Category Title</label>
                        </div>
                        <div class="d-grid">
                            <input type="submit" value="Update Category" class="btn btn-primary btn-lg" name="update_category_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
