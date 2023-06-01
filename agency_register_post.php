<?php

include('inc/connection.php');
if(isset($_POST['submit_agency'])){
    $agency_name = stripcslashes(strtolower($_POST['agency_name'])); /*stripslashe tna7i kol haja fiha / beh maydirouch </script>  strtolower beh yna7i lmajscule*/
    $email = stripcslashes($_POST['email']); /* n7otohom fi variable fl php */
    $password = stripcslashes($_POST['password']);
    $nrc = stripcslashes($_POST['nrc']);
    $city = stripcslashes($_POST['city']);
    $mobile = stripcslashes($_POST['mobile']);


    $city = htmlentities(mysqli_real_escape_string($conn,$_POST['city']));
    $agency_name = htmlentities(mysqli_real_escape_string($conn,$_POST['agency_name']));
    $email = htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($conn,$_POST['password']));
    $md5_pass = md5($password);

$check_user = "SELECT * FROM `agency` WHERE agency_name='$agency_name'";
$check_result = mysqli_query($conn,$check_user);
$num_rows = mysqli_num_rows($check_result);
if($num_rows != 0){
    $user_error = '<p id = "error">  agency name already exists </p>';
    $err_s = 1;
}



if(empty($agency_name)){
    $user_error = '<p id = "error"> please enter agency name </p>';
    $err_s = 1;
} elseif(strlen($agency_name) < 3){
    $user_error = '<p id = "error"> username need to have 3 letters minimum </p>';
    $err_s = 1;
}
if(empty($email)){
    $email_error = '<p id = "error"> please enter email </p>';
    $err_s = 1;
}

if(!strlen($mobile) === 10){
    $mobile_error = '<p id = "error"> please enter correct mobile number </p>';
    $err_s = 1;
    include('agency_registrer.php');
}



if(empty($password)){
    $pass_error = '<p id = "error"> please enter password </p>';
    $err_s = 1;
    include('agency_registrer.php');
}

 elseif(strlen($password) < 6){
    $pass_error = ' <p id = "error"> password need to have 6 letters minimum </p>';
    $err_s = 1;
    include('agency_registrer.php');
}
else{
    if(($err_s == 0) && ($num_rows == 0)){
       
        $sql = "INSERT INTO agency(agency_name,nrc,city,email,mobile,password,md5_pass)
        VALUES ('$agency_name','$nrc','$city','$email','$mobile','$password','$md5_pass') ";
        mysqli_query($conn,$sql);
        header('location:index.php');/* ki yclicki yroh lel login*/
        
    }else{
        include('agency_registrer.php');
    }
}


}


?>