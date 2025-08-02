<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h3 class="text-danger mb-4">Delete Account</h3>
    <form class="mt-5" action="" method="post">
        <div class="form-outline mt-5">
            <input type="submit" class="btn m-auto w-50 button-addtocart-color" name="delete" value="Delete Account">
        </div>
        <div class="form-outline mt-5">
            <input type="submit" class="btn m-auto w-50 button-viewmore-color" name="dont_delete" value="Don't Delete Account">
        </div>
    </form>
</body>
</html>

<?php

$username_session = $_SESSION['username'];
if(isset($_POST['delete'])){
    $delete_query = "DELETE FROM user_table WHERE username='$username_session'";
    $result = mysqli_query($con,$delete_query);
    if($result){
        session_destroy();
        echo "
        <script>
        alert('Account Deleted Successfully')
        </script>  
        ";
        echo "
        <script>
        window.open('../index.php','_SELF')
        </script>  
        ";
    }
}
else{
    if(isset($_POST['dont_delete'])){
        echo "
        <script>
        window.open('../index.php','_SELF')
        </script>  
        ";
    }
}


?>