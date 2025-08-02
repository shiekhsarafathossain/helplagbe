<?php
// This file acts as an API endpoint for our JavaScript
include("./includes/connect.php");
include("./functions/common_function.php");

// Check if a zone_id was provided
if (isset($_GET['zone_id'])) {
    $zone_id = (int)$_GET['zone_id'];
    $categories = getCategoriesByZone($zone_id);
    
    // Set the header to return JSON
    header('Content-Type: application/json');
    // Output the categories as a JSON object
    echo json_encode($categories);
}
?>
