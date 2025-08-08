<?php
// Make sure you have $con connection available before this block
include("../Includes/connect.php");
// Your DB query and output
$get_providers = "SELECT * FROM service_provider ORDER BY status ASC";
$result = mysqli_query($con, $get_providers);
$num_of_rows = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Service Providers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">All Registered Service Providers</h3>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>Provider ID</th>
                                    <th>Provider Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>NID Image</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($num_of_rows == 0) {
                                    // Adjusted colspan to 9 to account for the new "Edit" column
                                    echo "<tr><td colspan='9' class='text-center p-4'>No service providers found.</td></tr>";
                                } else {
                                    while ($row_data = mysqli_fetch_assoc($result)) {
                                        $provider_id = $row_data['provider_id'];
                                        $provider_name = $row_data['provider_name'];
                                        $provider_email = $row_data['provider_email'];
                                        $provider_image = $row_data['provider_image'];
                                        $provider_nid = $row_data['provider_nid'];
                                        $provider_address = $row_data['provider_address'];
                                        $provider_contact = $row_data['provider_contact'];
                                        $provider_status = $row_data['status'];

                                        // Determine the badge text and color based on the status
                                        $status_badge = ($provider_status === 'true')
                                            ? "<span class='badge bg-success'>Verified</span>"
                                            : "<span class='badge bg-danger'>Not Verified</span>";

                                        echo "
                                        <tr>
                                            <td>#{$provider_id}</td>
                                            <td class='text-start'>{$provider_name}</td>
                                            <td class='text-start'>{$provider_email}</td>
                                            <td><a href='../assets/images/provider_images/{$provider_image}' target='_blank'><img src='../assets/images/provider_images/{$provider_image}' alt='{$provider_name}' width='70' class='img-thumbnail'></a></td>
                                            <td><a href='../assets/images/provider_images/nid/{$provider_nid}' target='_blank'><img src='../assets/images/provider_images/nid/{$provider_nid}' alt='NID of {$provider_name}' width='70' class='img-thumbnail'></a></td>
                                            <td class='text-start'>{$provider_address}</td>
                                            <td>{$provider_contact}</td>
                                            <td>{$status_badge}</td>
                                            <td>
                                                <a href='index.php?edit_provider_status={$provider_id}' class='text-primary' title='Edit Status'>
                                                    <i class='fa-solid fa-pen-to-square'></i>
                                                </a>
                                            </td>
                                        </tr>";
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