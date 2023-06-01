<?php
if (isset($_GET['id'])) {
    require_once 'inc/connection.php';
    $sqlGetDepData = "select * from apply where user_id=" . $_GET['id'];
    $result = mysqli_query($conn,$sqlGetDepData);
    $row = mysqli_fetch_assoc($result);

    // $updateQuery = "update apply set approved IS NULL where order_id = " . $_GET['id'];
    // mysqli_query($conn, $updateQuery);

    $sql = "delete from apply where approved IS NULL and order_id= " . $_GET['id'];
    $res = mysqli_query($conn, $sql);
    $error = mysqli_errno($conn);
     if($error) {
        print_r($error);
     }
    header('location:agency_manager.php?success=true');
    exit();

}