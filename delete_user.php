<?php
if (isset($_GET['id'])) {
    require_once 'inc/connection.php';
    // $sqlGetDepData = "select * from apply where user_id=" . $_GET['id'];
    // $result = mysqli_query($conn,$sqlGetDepData);
    // $row = mysqli_fetch_assoc($result);

    $sql = "delete from users where id= " . $_GET['id'];
    $res = mysqli_query($conn, $sql);
    $error = mysqli_errno($conn);
     if($error) {
        print_r($error);
     }
    header('location:users.php?success=true');
    exit();

}