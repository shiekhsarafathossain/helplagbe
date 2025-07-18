<?php

// getting category function start

function getCategory(){
    global $con; //making con global variable
    $select_category = "SELECT * FROM categories";
    $result_category = mysqli_query($con,$select_category);
    
    while($row_data = mysqli_fetch_assoc($result_category)){
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "<li class='nav-item category-item'>
        <a href='index.php?categories=$category_id' class='nav-link'>$category_title</a>
        </li>";
    }
}

// getting category function end




?>