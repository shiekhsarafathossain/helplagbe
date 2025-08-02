<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">All Categories</h3>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Category ID</th>
                                        <th>Category Title</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_cat = "SELECT * FROM categories ORDER BY category_id DESC";
                                    $result = mysqli_query($con, $select_cat);
                                    $num_of_rows = mysqli_num_rows($result);

                                    if ($num_of_rows == 0) {
                                        echo "<tr><td colspan='4' class='text-center p-4'>No categories found.</td></tr>";
                                    } else {
                                        while($row = mysqli_fetch_assoc($result)){
                                            $category_id = $row['category_id'];
                                            $category_title = $row['category_title'];
                                    ?>
                                    <tr>
                                        <td>#<?php echo $category_id ?></td>
                                        <td class="text-start"><?php echo $category_title ?></td>
                                        <td>
                                            <a href="./index.php?edit_category=<?php echo $category_id; ?>" class="text-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="./index.php?delete_category=<?php echo $category_id; ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this category? This might affect services under it.');">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                        } 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
