<?php
session_start();//session call
include('inc/connection.php');

if( isset( $_SESSION['id'] ) || isset( $_SESSION['agency_id'] ) ) {
  
  $id = $_SESSION['id'];
  
  $user = $_SESSION['username']; //if he insert a correct id n username f login hothom hna fi variable
  
  $count = mysqli_query($conn,"SELECT COUNT(*) AS userCount FROM users  ");
  $count_num_rows = $count->num_rows;
  if (!$count_num_rows) {
    $count = mysqli_query($conn,"SELECT COUNT(*) AS userCount FROM agency");
  }
  $info = mysqli_query($conn,"SELECT * FROM users WHERE username ='$user'");//beh ydir ta3 luser adeka brk
  $info_num_rows = $info->num_rows;
  if (!$info_num_rows) {
    $info = mysqli_query($conn,"SELECT * FROM agency WHERE agency_name ='$user'");
  }
  while($data = mysqli_fetch_array($info)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
  <link rel="website icon" type="png"
  href="img/build4.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/indexC.css">
  <link rel="stylesheet" href="css/reals.css">
  <link rel="stylesheet" href="css/main.css">
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
                        <a class="nav-link active" aria-current="page" href="agency_manager.php" style="color: black;" >Back</a>
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
                    <li class="nav-item">
                       <a href="logout.php" style="color: red; " >Log out</a>
                      </li>
                  </div>
                </div>
              </nav></header><br/><br/><br/><br/>






              <h2 id="divider">Our Properties :</h2>


    
    <?php $properties = mysqli_query($conn,"SELECT * FROM property LEFT JOIN agency ON property.property_owner =  agency.agency_id   WHERE agency_id= $id  ");?>
    <section class="shop">

    <?php while($property = mysqli_fetch_array($properties)) { ?>
      <div class="box">
        <?php $property_id = $property['property_id']; 
          $photos = mysqli_query($conn, "SELECT * FROM property_photos WHERE property_id = '$property_id'");
          while ( $photo = mysqli_fetch_assoc($photos)) {?>
          <a href="images/<?php echo $photo['photo'] ?>"><img src="images/<?php echo $photo['photo'] ?>" alt="home" width="100"></a>
          <?php } ?>

        <h3 class="location"  style=" color: rgb(92, 59, 190);" ><?php echo $property['address'] ?></h3>
        <p class="type"><?php echo  $property['type'] ?></p>
        <h5 class="property_owner">Agency : <?php echo $property['agency_name'] ?></h5>
        <?php if ($property['for_sale'] == 1) {
          echo  "<p>For sale</p>";
        } else {
          echo  "<p>For Rent</p>";
        } ?>




        <p class="price">   <form action="update_price.php" method="POST">
    <input type="hidden" name="property_id" value="<?php echo $property['property_id']; ?>">
    <input type="number" name="new_price" placeholder="DA <?php echo  $property['price'] ?> " required>
    <button type="submit" style="color: white; background-color: rgb(216, 164, 75); height: 30px; border: none; padding: 5px; border-radius: 20px;">Change the price</button>
</form>

</p>
       
        <form action="update_status.php" method="POST">
    <input type="hidden" name="property_id" value="<?php echo $property['property_id']; ?>">
    <select name="new_status" required>
        <option  value="available"  disabled selected  ><?php echo  $property['status'] ?></option>
        <option value="Available">Available</option>
        <option value="Sold">Sold</option>
        <option value="Rented">Rented</option>
    </select><br/>
    <button type="submit" style="color: white; background-color: blue; height: 30px; border: none; padding: 5px; border-radius: 20px;">Update Status</button>
</form>
</h6>
       
<br/>
         <a  href="delete_property.php?id=<?php echo $property['property_id']; ?>"><button  style=" color:white; background-color: red; height:50px;  width:200px;  border:none; padding: 5px; border-radius: 20px; cursor: no-drop ; " > Delete property</button></a>

</button>
 </div>
    <?php } ?>

























              </body>

</html>
<?php 
}
}
?>