<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services</title>
</head>
<body>
    <h1 class="text-center">View Services</h1>
    <table class="table table-border m5-5">
        <thead class="bg-info">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Keywords</th>
                <th>Image</th>
                <th>Price</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            
            <?php
            $get_services = "SELECT * FROM service ORDER BY id";
            $result = mysqli_query($con,$get_services);
            while($row=mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $keywords = $row['keywords'];
                $price = $row['price'];
                $name = $row['name'];
                $contact = $row['contact'];
                $address = $row['address'];
                $status = $row['status'];
                $image1 = $row['image1'];
                ?>
                
                <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $keywords; ?></td>

                <td><img src='../assets/images/service_images/<?php echo $image1; ?>' class='service_image' style="height:150px; width:150px;"></td>
                <td><?php echo $price; ?> -/ BDT</td>
                <td><?php echo $name; ?></td>
                <td><?php echo $contact; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $status; ?></td>
                <td><a href="./index.php?edit_service=<?php echo $id; ?>" class="text-dark"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="./index.php?delete_service=<?php echo $id; ?>" class="text-dark"><i class="fa-solid fa-trash"></i></a></td>
                </tr>

            <?php    
            }
            ?>
            
            
        </tbody>
    </table>
</body>
</html>