<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency Sign In</title>
    <link rel="stylesheet" href="css/main.css">
  <link rel="website icon" type="png"
  href="img/build4.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="css/reals.css">
  <link rel="stylesheet" href="css/normalize.css"/>
  <link rel="stylesheet" href="css/all.min.css"/>
  <link rel="preconnect" href="https://font.gstatic.com" />
</head>
<body>
<header>
            <nav class="navbar navbar-expand-lg " style="background-color: whitesmoke; top: 0px; position: fixed; width: 100%; height: 70px;z-index: 999;">
                <div class="container-fluid">
                    <div class="main-logo" style="padding-left: 50px;">
                        <img id="logopic" src="img/build4.png" alt="logopic" >
                        <h1 id="logo">RealEstate</h1>
                         </div>
                  <div class="navbar-brand" href="#" style="padding-right: 300px; padding-left: 150px; color: rgb(15, 15, 72);"> </div>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html" style="color: black;" >Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black;">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black;">Pricing</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                       
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </nav></header><br/>
<div class="main">

<h1>Register</h1>
<i>it's very easy</i>
<br/>

<form action="agency_register_post.php" method="POST" > <!-- kolch yroh lel register_post beh nt7a9o les infos s7a7 -->

<?php if(isset($user_error)){
    echo $user_error;
}  
 ?>



<input type="text" name="agency_name" id="agency_name" placeholder="name"><br/>
<input type="text" name="nrc" id="nrc" placeholder="numero de register" required><br/>
<input type="text" name="city" id="city" placeholder="City" required><br/>


<?php if(isset($email_error)){
    echo $email_error;
}  
 ?>

<input type="email" name="email" id="email" placeholder=" email " ><br/>

<?php if(isset($mobile_error)){
    echo $mobile_error;
}  
 ?>

<input type="tel" name="mobile" id="mobile" placeholder="mobile" required><br/>

<?php if(isset($pass_error)){
    echo $pass_error;
}  
 ?>


<input type="password" name="password" id="password" placeholder="new password"  ><br/>




<input type="submit" name="submit_agency" id="submit_agency" value="Register_agency" >



</form>
<h3>Or</h3>
<a id="login" href="index.php">login</a>


</div>
</body>
</html>