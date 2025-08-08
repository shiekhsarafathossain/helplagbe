<?php
// This file is included in index.php, so $con is available.
include("../Includes/connect.php");
// --- Handle the form submission to UPDATE the status ---
if (isset($_POST['update_provider_status'])) {
    $provider_id_to_update = $_POST['provider_id'];
    $new_status = $_POST['new_status'];

    // Use prepared statements for security
    $update_stmt = $con->prepare("UPDATE service_provider SET status = ? WHERE provider_id = ?");
    $update_stmt->bind_param("si", $new_status, $provider_id_to_update);

    if ($update_stmt->execute()) {
        echo "<script>alert('Provider status updated successfully.')</script>";
        echo "<script>window.open('index.php?list_service_provider', '_self')</script>";
    } else {
        echo "<script>alert('Failed to update status.')</script>";
    }
    $update_stmt->close();
}


// --- Handle the GET request to DISPLAY the edit form ---
if (isset($_GET['edit_provider_status'])) {
    $provider_id = (int)$_GET['edit_provider_status'];

    // Use prepared statements to fetch current provider data
    $select_stmt = $con->prepare("SELECT * FROM service_provider WHERE provider_id = ?");
    $select_stmt->bind_param("i", $provider_id);
    $select_stmt->execute();
    $result = $select_stmt->get_result();

    if ($result->num_rows > 0) {
        $provider_data = $result->fetch_assoc();
        $provider_name_to_edit = $provider_data['provider_name'];
        $current_status = $provider_data['status'];
    } else {
        echo "<script>alert('Provider not found.'); window.open('index.php?list_service_provider','_self');</script>";
        exit();
    }
    $select_stmt->close();
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <h3 class="text-center mb-4">Edit Provider Verification</h3>
                    <hr class="my-4">
                    
                    <div class="text-center mb-4">
                        <p class="h5">Provider: <strong class="text-primary"><?php echo htmlspecialchars($provider_name_to_edit); ?></strong></p>
                        <p>Provider ID: #<?php echo $provider_id; ?></p>
                    </div>

                    <form action="" method="post" class="text-center">
                        <input type="hidden" name="provider_id" value="<?php echo $provider_id; ?>">
                        
                        <div class="form-floating mb-4">
                            <select name="new_status" id="new_status" class="form-select">
                                <option value="true" <?php if ($current_status === 'true') echo 'selected'; ?>>
                                    Verified
                                </option>
                                <option value="false" <?php if ($current_status === 'false') echo 'selected'; ?>>
                                    Not Verified
                                </option>
                            </select>
                            <label for="new_status">Verification Status</label>
                        </div>

                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary btn-lg" name="update_provider_status" value="Update Status">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>