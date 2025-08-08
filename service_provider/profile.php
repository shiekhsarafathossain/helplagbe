<?php
@session_start();
if(!isset($_SESSION['provider_id'])){
    echo "<script>alert('Please login to access the provider panel.')</script>";
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}

include("../includes/connect.php");

$provider_id = $_SESSION['provider_id'];

// Handle form submission for updating profile
if(isset($_POST['update_profile'])){
    $provider_name = $_POST['provider_name'];
    $provider_email = $_POST['provider_email'];
    $provider_contact = $_POST['provider_contact'];
    $provider_address = $_POST['provider_address'];
    
    $new_image = $_FILES['provider_image']['name'];
    $old_image = $_POST['old_image'];

    if(!empty($new_image)){
        $provider_image = $new_image;
        $provider_image_tmp = $_FILES['provider_image']['tmp_name'];
        move_uploaded_file($provider_image_tmp, "../assets/images/provider_images/$provider_image");
    } else {
        $provider_image = $old_image;
    }

    $new_image_nid = $_FILES['provider_nid']['name'];
    $old_image_nid = $_POST['old_image_nid'];

    if(!empty($new_image)){
        $provider_nid = $new_image;
        $provider_nid_tmp = $_FILES['provider_nid']['tmp_name'];
        move_uploaded_file($provider_image_tmp, "../assets/images/provider_images/nid/$provider_nid");
    } else {
        $provider_nid = $old_image_nid;
    }

    $stmt = $con->prepare("UPDATE service_provider SET provider_name=?, provider_email=?, provider_contact=?, provider_address=?, provider_image=?, provider_nid=? WHERE provider_id=?");
    $stmt->bind_param("ssssssi", $provider_name, $provider_email, $provider_contact, $provider_address, $provider_image, $provider_nid, $provider_id);
    if($stmt->execute()){
        echo "<script>alert('Profile updated successfully.')</script>";
        // Update session name in case it was changed
        $_SESSION['provider_name'] = $provider_name;
        echo "<script>window.open('index.php?profile','_self')</script>";
    }
    $stmt->close();
}

// Fetch current provider data
$stmt_fetch = $con->prepare("SELECT * FROM service_provider WHERE provider_id = ?");
$stmt_fetch->bind_param("i", $provider_id);
$stmt_fetch->execute();
$result = $stmt_fetch->get_result();
$provider_data = $result->fetch_assoc();
$stmt_fetch->close();
?>

<h2 class="text-center mb-4">My Profile</h2>
<div class="row d-flex justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?php echo $provider_data['provider_image']; ?>">
                    <div class="text-center mb-4">
                        <img src="../assets/images/provider_images/<?php echo $provider_data['provider_image']; ?>" alt="Provider Image" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="provider_name" class="form-label">Full Name</label>
                            <input type="text" name="provider_name" class="form-control" value="<?php echo $provider_data['provider_name']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="provider_email" class="form-label">Email</label>
                            <input type="email" name="provider_email" class="form-control" value="<?php echo $provider_data['provider_email']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="provider_contact" class="form-label">Contact Number</label>
                            <input type="text" name="provider_contact" class="form-control" value="<?php echo $provider_data['provider_contact']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                             <label for="provider_image" class="form-label">Update Profile Picture</label>
                            <input type="file" name="provider_image" class="form-control">
                        </div>

                    </div>

                    <div class="row">
                        

                        <div class="col-md-6 mb-3">
                            <img src="../assets/images/provider_images/nid/<?php echo $provider_data['provider_nid']; ?>" alt="Provider Nid" style="width: 200px; height: 120px; object-fit: cover;">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="provider_nid" class="form-label">Update NID Card Picture</label>
                            <input type="file" name="provider_nid" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="provider_address" class="form-label">Address</label>
                        <textarea name="provider_address" class="form-control" rows="3"><?php echo $provider_data['provider_address']; ?></textarea>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
