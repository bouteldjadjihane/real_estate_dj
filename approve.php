<?php
if (isset($_GET['id'])) {
    include "inc/connection.php";

    $user_id = $_GET['uid'];
    $apply_id = $_GET['id'];
    $prop_id = $_GET['prop_id'];
    $sql = "update apply set approved = '1' where order_id=" . $apply_id;
    $res = mysqli_query($conn, $sql);
    mysqli_query($conn, "update property set status = 'Sold' where property_id='$prop_id'");
    mysqli_query($conn, "UPDATE users SET approved = '1' WHERE id = '$user_id' ");
    header('location:agency_manager.php?success=true');
    exit();
}