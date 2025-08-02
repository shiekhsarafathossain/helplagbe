<?php

if(isset($_GET['delete_orders'])){
    $delete_id=$_GET['delete_orders'];
    $delete_orders="DELETE FROM user_orders WHERE order_id=$delete_id";
    $result_orders=mysqli_query($con,$delete_orders);
    if($result_orders){
        echo "
        <script>alert('Order deleted successfully!')</script>
        ";
        echo "
        <script>window.open('./index.php?list_orders','_SELF')</script>
        ";

    }
    else{
        echo "
        <script>alert('Delete Unsuccessful!')</script>
        ";
        echo "
        <script>window.open('./index.php?list_orders','_SELF')</script>
        ";
    }
}

?>