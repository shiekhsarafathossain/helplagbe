<?php
if(isset($_GET['delete_service'])){
    $delete_id = (int)$_GET['delete_service'];
    $provider_id = $_SESSION['provider_id'];

    // Security check: ensure the provider owns this service before deleting
    $stmt = $con->prepare("DELETE FROM service WHERE id = ? AND provider_id = ?");
    $stmt->bind_param("ii", $delete_id, $provider_id);
    if($stmt->execute()){
        echo "<script>alert('Service has been deleted successfully.'); window.open('index.php?view_services','_self');</script>";
    }
    $stmt->close();
}
?>
