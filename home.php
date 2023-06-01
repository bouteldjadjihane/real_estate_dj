<?php
session_start();//session call
include('inc/connection.php');
    // Check if a file was uploaded
    if ( isset($_POST['update_image'])) {
      $id = $_SESSION['id'];
      if (isset($_FILES['profile_picture'])) {
        $file = $_FILES['profile_picture'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        // Move the uploaded file to a desired location
        move_uploaded_file($file_tmp, 'images/' . $file_name);
        // Update the database record with the new profile picture file name
        $update_query = "UPDATE users SET profile_picture = '$file_name' WHERE id = '$id'";
        $result = mysqli_query($conn, $update_query);
  
        if ($result) {
            // Profile picture updated successfully
            echo "Profile picture updated successfully.";
        } else {
            // Failed to update profile picture
            echo "Failed to update profile picture.";
        }
    }
    }
    function calc_remaining_days($start, $end){
  
        $startDate = new DateTime($start); 
        $endDate = new DateTime($end);
        $currentDate = new DateTime("now");
        
        $duration = $startDate->diff($endDate); 
        
        $start_end_diff = $startDate->diff($currentDate); 
      
        $daysLeft = (int) $duration->format('%a days') - (int) $start_end_diff->format('%a days'); 
      
         return $daysLeft;
    }

if(isset($_SESSION['id']) && isset($_SESSION['username'])){
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $id = $_SESSION['id'];
    $user = $_SESSION['username']; //if he insert a correct id n username f login hothom hna fi variable
    $info = mysqli_query($conn,"SELECT * FROM tenancy LEFT JOIN users on users.id = tenancy.user_id WHERE username ='$user' GROUP BY id");//beh ydir ta3 luser adeka brk
    if (!mysqli_num_rows($info)) { // as if we said . if there is no rows, in other words, if numrows is zero
      // there is no result and the user has rental going on 
      $info = mysqli_query($conn,"SELECT * FROM apply LEFT JOIN users on users.id = apply.user_id LEFT JOIN property ON apply.property_id = property.property_id WHERE username = '$user' GROUP BY id"); 
    }

    while($data = mysqli_fetch_array($info)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/main.css">
  <link rel="website icon" type="png"
  href="img/build4.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/indexC.css">
  <link rel="stylesheet" href="css/reals.css">
  <link rel="stylesheet" href="css/normalize.css"/>
  <link rel="stylesheet" href="css/all.min.css"/>
  <link rel="preconnect" href="https://font.gstatic.com" />
</head>
<body>

<header>
            <nav class="navbar navbar-expand-lg " style="background-color: whitesmoke; top: 0px; position: fixed; width: 100%; height: 70px;">
                <div class="container-fluid">
                    <div class="main-logo" style="padding-left: 50px;">
                        <img id="logopic" src="img/build4.png" alt="logopic">
                        <h1 id="logo">RealEstate</h1>
                         </div>
                  <div class="navbar-brand" href="#" style="padding-right: 300px; padding-left: 150px; color: rgb(15, 15, 72); z-index: 999;"> </div>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html" style="color: black; position: relative; right: 20px;" >Home</a>
                      </li>
                    <li class="nav-item"  >
                       <a href="logout.php" style="color: red; positio:relative; text-decoration: none; font-size: large; " >Log out</a>
                      </li>
                      <li class="nav-item">
                      <div class="photo">
                      <?php echo "<img src='images/" . $data['profile_picture'] . "' alt='image not found' style='width: 50px; height: 50px; border-radius:50%; position:relative; left:150px; '>"; ?>

    </li>
                      <li style="position:relative; left:170px;" >
                      <?php echo $user ?> 
    </li>
                  </div>
                </div>
     
              </nav></header><br/><br/>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container mt-5 emp-profile">
            <form method="post" enctype="multipart/form-data"> 
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                        <img src="images/<?php echo $data['profile_picture']; ?>" width="230" style="border: 7px solid rgb(70, 198, 238);" alt=""/>

                       <div class="file btn btn-lg btn-primary">
    Change Photo
    <input type="file" name="profile_picture"/>
    <button name="update_image" style="background-color: green; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Update</button>
    </div>
                    <h5><br/>
                    <p style="font-weight: bold;  font-style: italic;  color: rgb(56, 80, 176);"><?php echo $data['username']; ?></p>
                    </h5>
                </div>
    </div>
    <div class="col-md-5">
        <div class="profile-head">
            <?php if (isset($data['date_start'])) {?>
              <h5 style="color: #3668bf; ">
                Rental Status 
            </h5>
            <p class="proile-rating"><i class="fa-solid fa-house fa-xl me-2" style="color: #3668bf;"></i>property ID: <span><?php echo $data['property_id'] ?></span></p>
            <p class="proile-rating"><i class="fa-solid fa-hourglass-start fa-xl me-2" style="color: #3668bf;"></i>Rental Start Date: <span><?php echo $data['date_start'] ?></span></p>
            <p class="proile-rating"><i class="fa-solid fa-hourglass-end fa-xl me-2" style="color: #3668bf;"></i>Rental End Date : <span><?php echo $data['date_end'] ?></span></p>
            <?php $rem_days = calc_remaining_days($data['date_start'] , $data['date_end']); ?>
            <p class="proile-ratin"><i class="fa-solid fa-calendar-days fa-xl me-2" style="color: #3668bf;" ></i>Remaining days: <span class="text-<?php echo ($rem_days > 10) ? 'success' : 'danger';  ?>"><?php echo $rem_days; ?></span></p>
            <?php } else {?>
              <h5 style="
            color: #3668bf; " > 
                Buying Status
            </h5>
            <p class="proile-rating"><i class="fa-solid fa-house fa-xl me-2" style="color: #3668bf;"></i>property ID: <span><?php echo $data['property_id'] ?></span></p>
            <p class="proile-rating"><i class="fa-solid fa-sack-dollar fa-xl me-2" style="color: #3668bf; "></i>Property Price: <span><?php echo $data['price'] ?></span></p>
            <?php if ($data['offer'] == '0' ){?>
            <p class="proile-rating"><i class="fa-solid fa-square-check fa-xl me-2 " style="color: #3668bf;"></i> Offer Selected : <span>
                <?php if ($data["offer"] == '0') {
                        echo 'Paid';
                } else if ($data["offer"] == '1') {
                    echo '5 Months';
                } elseif ($data["offer"] == '2') {
                    echo '1 year';
                } else {
                    echo '6 Years'; 
                } ?></span></p>
            <?php }?>
            <?php if ($data['offer'] != '0'){?>
            <p class="proile-rating"><i class="fa-solid fa-money-check-dollar  fa-xl me-2" style="color: #3668bf;"></i>Monthly paying amount: DA<span> <?php
            $offer = $data['offer'];
            $price = $data['price'];
            $payingAmount = 0; 
            if (is_null($offer)) {
                $payingAmount = $price;
            } else if ($offer == '1') {
                $payingAmount = $price / 5;
            } elseif ($offer == '2') {
                $payingAmount = $price / 12; 
            } else {
                $payingAmount = $price / 72;
            } 
            echo number_format($payingAmount, 5, '.', ' '); 
            ?></span>
            </p>
            <p class="proile-rating"><i class="fa-solid fa-piggy-bank  fa-xl me-2" style="color: #3668bf; "></i>Remaining Amount: DA <span><?php echo $data['price'] -  $payingAmount; ?></span>
            </p>
            <p class="proile-rating"><i class="fa-solid fa-clock-rotate-left  fa-xl me-2" style="color: #3668bf; "></i>Due Date: 
            <span>
                <?php
                // set the default timezone to use.
                date_default_timezone_set('UTC');
                $date = new DateTimeImmutable($data['expected_end_date']);
                $x = $date->format('l jS \o\f F Y h:i:s A');
                echo $x;
                ?>
            </span>
            </p>
            <?php }}?>
             </div>
                
            </div>
            
                </div>
              
                <div class="row">
                    
                    <div class="col-md-12">
                      
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                              
                                        <div class="row justify-content-center">
                                          
                                        <div class="col-md-2">
                                                <label><b>User Id :</b></label>
                                            </div>
                                            <div class="col-md-2">
                                                <p><?php echo $data['id'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-2">
                                                <label><b>Name :</b></label>
                                            </div>
                                            <div class="col-md-2">
                                                <p><?php echo $data['username'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-2">
                                                <label><b>Email :</b></label>
                                            </div>
                                            <div class="col-md-2">
                                                <p><?php echo $data['email'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-2">
                                                <label><b>Birthday :</b></label>
                                            </div>
                                            <div class="col-md-2">
                                                <p><?php echo $data['birthday'] ?></p>
                                            </div>
                                        </div>
                                       
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Experience</label>
                                            </div>
                                            <div class="col-md-2">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Hourly Rate</label>
                                            </div>
                                            <div class="col-md-2">
                                                <p>10$/hr</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Total Projects</label>
                                            </div>
                                            <div class="col-md-2">
                                                <p>230</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-md-2">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Availability</label>
                                            </div>
                                            <div class="col-md-2">
                                                <p>6 months</p>
                                            </div>
                                        </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
        <style>
          body{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    /* width: 70%;
    height: 100%; */
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    left: 0px;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
        </style>
</body>
</html>

<?php 
}
} else {
    header('Location: index.php');
    exit();//may9drch yodkhl home.php direct bla ma ydir login
}


?>
