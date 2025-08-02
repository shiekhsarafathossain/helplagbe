<?php

if(isset($_GET['delete_category'])){
    $delete_id=$_GET['delete_category'];
    $delete_categoy="DELETE FROM categories WHERE category_id=$delete_id";
    $result_category=mysqli_query($con,$delete_categoy);
    if($result_category){
        echo "
        <script>alert('Category deleted successfully!')</script>
        ";
        echo "
        <script>window.open('./index.php?view_categories','_SELF')</script>
        ";

    }
    else{
        echo "
        <script>alert('Delete Unsuccessful!')</script>
        ";
        echo "
        <script>window.open('./index.php?view_categories','_SELF')</script>
        ";
    }
}

?>