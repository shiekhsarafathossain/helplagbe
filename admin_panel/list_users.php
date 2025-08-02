<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">All Registered Users</h3>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>User Email</th>
                                        <th>User IP</th>
                                        <th>User Address</th>
                                        <th>User Mobile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_users = "SELECT * FROM user_table";
                                    $result = mysqli_query($con, $get_users);
                                    $num_of_rows = mysqli_num_rows($result);

                                    if ($num_of_rows == 0) {
                                        echo "<tr><td colspan='6' class='text-center p-4'>No users found.</td></tr>";
                                    } else {
                                        while ($row_data = mysqli_fetch_assoc($result)) {
                                            $user_id = $row_data['user_id'];
                                            $username = $row_data['username'];
                                            $user_email = $row_data['user_email'];
                                            $user_ip = $row_data['user_ip'];
                                            $user_address = $row_data['user_address'];
                                            $user_mobile = $row_data['user_mobile'];

                                            echo "
                                            <tr>
                                                <td>#{$user_id}</td>
                                                <td class='text-start'>{$username}</td>
                                                <td class='text-start'>{$user_email}</td>
                                                <td>{$user_ip}</td>
                                                <td class='text-start'>{$user_address}</td>
                                                <td>{$user_mobile}</td>
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
