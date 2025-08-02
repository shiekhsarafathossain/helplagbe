<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services</title>
    <style>
        .service-image-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">All Services</h3>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Price (BDT)</th>
                                        <th>Provider Name</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_services = "SELECT * FROM service ORDER BY id DESC";
                                    $result = mysqli_query($con, $get_services);
                                    $num_of_rows = mysqli_num_rows($result);

                                    if ($num_of_rows == 0) {
                                        echo "<tr><td colspan='8' class='text-center p-4'>No services found.</td></tr>";
                                    } else {
                                        while($row = mysqli_fetch_assoc($result)){
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            $price = $row['price'];
                                            $name = $row['name'];
                                            $status = $row['status'];
                                            $image1 = $row['image1'];
                                    ?>
                                    <tr>
                                        <td>#<?php echo $id; ?></td>
                                        <td><img src='../assets/images/service_images/<?php echo $image1; ?>' class='service-image-thumb'></td>
                                        <td class="text-start"><?php echo $title; ?></td>
                                        <td><?php echo number_format($price, 2); ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $status == 'true' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="./index.php?edit_service=<?php echo $id; ?>" class="text-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="./index.php?delete_service=<?php echo $id; ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this service?');">
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
