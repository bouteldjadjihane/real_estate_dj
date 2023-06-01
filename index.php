<?php
session_start();
if ( isset($_SESSION['username'])) {
  header('Location: agency_manager.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
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
              </nav></header><br/><br/>
<div class="main">

<h1>Log in</h1>
<i>let's enjoy</i>
<br/><br/>
<form action="login.php" method="POST">

<?php if(isset($user_error)){
    echo $user_error;
}  
 ?>

<input type="username" name="username" id="username" placeholder="username" required><br/>
<?php if(isset($pass_error)){
    echo $pass_error;
}  
 ?>
<input type="password" name="password" id="password" placeholder="password" ><br/>
<fieldset>
      <input class="form-check-input" type="checkbox" id="agent" name="agency" value="1">
      <label for="agent">Sign in as agency</label>
</fieldset>
<button class="btn btn-primary" type="submit" name="submit" id="submit">Log in</button>

</form>
<h3>Or</h3><br/>
<a id="login" href="register.php">register</a>


</div>
</body>
</html>