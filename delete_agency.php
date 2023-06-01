<?php
if (isset($_GET['agency_id'])) {
    include "inc/connection.php";
    $sqlGetDepData = "select * from agency where agency_id=" . $_GET['agency_id'];
    $result = mysqli_query($conn,$sqlGetDepData);
    $row = mysqli_fetch_assoc($result);

    $updateQuery = "UPDATE agency SET approved = 0 WHERE agency_id = " . $_GET['agency_id'];
    mysqli_query($conn, $updateQuery);

    $sql = "DELETE FROM agency WHERE approved = 0 AND agency_id= " . $_GET['agency_id'];
    $res = mysqli_query($conn, $sql);
    
 

    header('location:agencies.php?success=true');
    exit();

}