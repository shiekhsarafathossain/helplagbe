<?php

if(isset($_GET['delete_service'])){
    $delete_id=$_GET['delete_service'];
    $delete_service="DELETE FROM service WHERE id=$delete_id";
    $result_product=mysqli_query($con,$delete_service);
    if($result_product){
        echo "
        <script>alert('Service deleted successfully!')</script>
        ";
        echo "
        <script>window.open('./index.php?view_service','_SELF')</script>
        ";

    }
    else{
        echo "
        <script>alert('Delete Unsuccessful!')</script>
        ";
        echo "
        <script>window.open('./index.php?view_service','_SELF')</script>
        ";
    }
}

?>