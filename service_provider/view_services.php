<?php @session_start(); ?>
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
                                        <th>Service ID</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Status</th> <!-- New Status column -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
        $provider_id = $_SESSION['provider_id'];
        $stmt = $con->prepare("SELECT * FROM service WHERE provider_id = ?");
        $stmt->bind_param("i", $provider_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            echo "<tr><td colspan='6' class='text-center'>You have not added any services yet.</td></tr>";
        } else {
            while($row = $result->fetch_assoc()){
                $service_id = $row['id'];
                $status = $row['status'] === 'true'
                    ? "<span class='badge bg-success'>Active</span>"
                    : "<span class='badge bg-danger'>Inactive</span>";
                    
                echo "<tr>
                    <td>{$service_id}</td>
                    <td>{$row['title']}</td>
                    <td><img src='../assets/images/service_images/{$row['image1']}' width='80' alt='Service Image'></td>
                    <td>{$row['price']}</td>
                    <td>{$status}</td>
                    <td>
                        <a href='index.php?edit_service={$service_id}' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i> Edit</a>
                        <a href='index.php?delete_service={$service_id}' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i> Delete</a>
                    </td>
                </tr>";
            }
        }
        $stmt->close();
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
