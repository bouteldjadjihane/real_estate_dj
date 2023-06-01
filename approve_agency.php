<?php
if (isset($_GET['agency_id'])) {
    include "inc/connection.php";
    $sqlGetDepData = "select * from agency where agency_id=" . $_GET['agency_id'];
    $result = mysqli_query($conn,$sqlGetDepData);
    $row = mysqli_fetch_assoc($result);

    $sql = "update agency set approved = 1 where agency_id=" . $_GET['agency_id'];
    $res = mysqli_query($conn, $sql);
    header('location:adminpage.php?success=true');
    exit();
}