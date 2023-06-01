<?php

include('inc/connection.php');
session_start();

$err_s = 0;
if(isset($_POST['submit'])){
    $username = stripcslashes(strtolower($_POST['username'])); /*stripslashe tna7i kol haja fiha / beh maydirouch </script>  strtolower beh yna7i lmajscule*/
    $email = stripcslashes($_POST['email']); /* n7otohom fi variable fl php */
    $password = stripcslashes($_POST['password']);
    if(isset($_POST['birthday_month']) && isset($_POST['birthday_day']) && isset($_POST['birthday_year'])){

        $birthday_month = (int)$_POST['birthday_month'];
        $birthday_day = (int)$_POST['birthday_day'];
        $birthday_year = (int)$_POST['birthday_year'];
        $birthday = htmlentities(mysqli_real_escape_string($conn,$birthday_day.'-'.$birthday_month.'-'.$birthday_year));
    }

    $username = htmlentities(mysqli_real_escape_string($conn,$_POST['username']));
    $email = htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($conn,$_POST['password']));
    $md5_pass = md5($password);

if(isset($_POST['gender'])){
    $gender = ($_POST['gender']);
    $gender = htmlentities(mysqli_real_escape_string($conn,$_POST['gender']));
    if(!in_array($gender,['male','female'])){
        $gender_error = '<p id = "error"> please choose gender ! </p> ';
        $err_s = 1; /*beh mb3d ndiro condition les errors 0 yemchi normal */
    }
}
$check_user = "SELECT * FROM `users` WHERE username='$username'";
$check_result = mysqli_query($conn,$check_user);
$num_rows = mysqli_num_rows($check_result);
if($num_rows != 0){
    $user_error = '<p id = "error">  username already exists, bedlou </p>';
    $err_s = 1;
}
if(empty($username)){
    $user_error = '<p id = "error"> please enter username </p>';
    $err_s = 1;
} elseif(strlen($username) < 6){
    $user_error = '<p id = "error"> username need to have 6 letters minimum </p>';
    $err_s = 1;
}
if(empty($email)){
    $email_error = '<p id = "error"> please enter email </p>';
    $err_s = 1;
}

if(empty($gender)){
    $gender_error = '<p id = "error"> please select a gender </p>';
    $err_s = 1;
}
if(empty($birthday)){
    $birthday_error = '<p id = "error"> please enter ur birthdate </p> ';
    $err_s = 1;
}
if(empty($password)){
    $pass_error = '<p id = "error"> please enter password </p>';
    $err_s = 1;
    include('register.php');
}

 elseif(strlen($password) < 6) {
    $pass_error = '<p id="error"> password need to have 6 letters minimum </p>';
// it is all about affection
    $err_s = 1;
    include('register.php');
}
else{
    if(($err_s == 0) && ($num_rows == 0)){
        if($gender == 'male'){
            $picture = 'no-profile-picture.jpg';
        }
        elseif($gender == 'female'){
            $picture = 'no-profile-picture-female.jpg';
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $sql = "INSERT INTO users(username,email,password,birthday,gender,md5_pass,profile_picture)
        VALUES ('$username','$email','$password','$birthday','$gender','$md5_pass','$picture') ";
        mysqli_query($conn,$sql);
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $user_id = $_SESSION['user_id'];
        $property_id = $_POST['property_id'];
        $property_owner = $_POST['property_owner'];
        if ( isset($_SESSION['offer'])) {
            $offer = 'NULL';
        } else {
            $offer = $_POST['offer'] ?? NULL;
        }
        
        $expected_end_date = "";
        if (!isset($offer) || !$offer ) {
            $expected_end_date = "NULL"; 
        }
        // if it is rental, insert to tenancy table
        if (isset( $_SESSION['is_rent'] ) && $_SESSION['is_rent']) { 
            $start = $_POST['start_date'];
            $end = $_POST['end_date'];
            $query = "INSERT INTO tenancy (property_id, date_start, date_end) 
            VALUES ('$property_id', '$start', '$end')";
            if (mysqli_query($conn, $query)) {
            $success = "Thank you!";
            // get the id of last inserted tenancy
            $tenancy_id = mysqli_insert_id($conn);
            mysqli_query($conn, "UPDATE tenancy SET user_id = '$user_id' WHERE tenancy_id = '$tenancy_id';");
            header('location: wait.html');/* ki yclicki yroh lel login*/
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            } 
        } else { 
            
            //if it is buying, then insert into apply
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $sql = "INSERT INTO apply ( property_id, agency_id, offer )  
            VALUES ( '$property_id', '$property_owner', '$offer' ) "; 
            mysqli_query($conn, $sql);
            $orderDate = date('Y-m-d H:i:s');
            if ($offer == '1') { // offer 1 means ? 5 months
                $numberOfMonths = 5;
                $expected_end_date = date('Y-m-d', strtotime("+" . $numberOfMonths . " months", strtotime( $orderDate)));

            } elseif ($offer == '2') { // 12 months
                $numberOfMonths = 12;
                $expected_end_date = date('Y-m-d', strtotime("+" . $numberOfMonths . " months", strtotime( $orderDate)));
            } else { // 72 motnh
                $numberOfMonths = 72;
                $expected_end_date = date('Y-m-d', strtotime("+" . $numberOfMonths . " months", strtotime( $orderDate)));
            }
            // get the id of last inserted apply (order)
            $apply_id = mysqli_insert_id($conn); 
            mysqli_query($conn, "UPDATE apply SET user_id = '$user_id', expected_end_date = '$expected_end_date' WHERE order_id = '$apply_id';");
            header('location: wait.html');/* ki yclicki yroh lel login*/
        } 
    }else{
        include('register.php');
    }
}


}


?>