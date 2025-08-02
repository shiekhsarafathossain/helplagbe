<?php
// This file should be included within your main admin index.php

// Handle form submission for inserting a new category
if(isset($_POST["insert_category_btn"])){
    $category_title = $_POST["cat_title"];

    // Use prepared statements to prevent SQL injection and check for existing category
    $select_query = "SELECT * FROM categories WHERE category_title = ?";
    $stmt_select = $con->prepare($select_query);
    $stmt_select->bind_param("s", $category_title);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();
    $number = $result_select->num_rows;

    if($number > 0){
        echo "<script>alert('This category already exists.')</script>";
    } else {
        // Insert the new category
        $insert_query = "INSERT INTO categories (category_title) VALUES (?)";
        $stmt_insert = $con->prepare($insert_query);
        $stmt_insert->bind_param("s", $category_title);
        
        if($stmt_insert->execute()){
            echo "<script>alert('Category has been added successfully.')</script>";
            echo "<script>window.open('./index.php?view_categories','_self')</script>";
        } else {
            echo "<script>alert('Failed to add category.')</script>";
        }
    }
}
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <h3 class="text-center mb-4">Insert New Category</h3>
                    <hr class="my-4">
                    <form action="" method="post" class="text-center">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="cat_title" id="cat_title" placeholder="Insert Category Title" required>
                            <label for="cat_title">Category Title</label>
                        </div>
                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary btn-lg" name="insert_category_btn" value="Insert Category">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
