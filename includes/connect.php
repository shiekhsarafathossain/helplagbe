<?php
$con = new mysqli('localhost', 'root', '', 'helplagbe');

if (!$con) {
    die(mysqli_error($con));
}
?>