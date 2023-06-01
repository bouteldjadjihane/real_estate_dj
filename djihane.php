<?php 
include('inc/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Real Estate</title>
  <link rel="website icon" type="png" href="img/build4.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/reals.css">
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="preconnect" href="https://font.gstatic.com" />
</head>

<body>
  <a name="top"></a>
  <header class="header">
    <div class="main-logo">
      <img id="logopic" src="img/build4.png" alt="logopic">
      <h1 id="logo">RealEstate</h1>
    </div>
    <nav class="toplinks" style="padding-left: 50px;">
      <a href="index.html" class="nlinks">Home</a>
      <a href="#divider" class="nlinks">Buy</a>
      <a href="#divider" class="nlinks">Rent</a>
    </nav>
    </head>

    <body>

      </div>
  </header>
  <main class="main">

    <section class="top1">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">

          <div class="carousel-item active">
            <img id="top1" src="img/slide-2.jpg" class="Vila-img" alt="villa1">
          </div>
          <div class="carousel-item">
            <img id="top1" src="img/slide-3.jpg" class="Vila-img" alt="villa3">
          </div>
          <div class="carousel-item">
            <img id="top1" src="img/slide4.jpeg" class="Vila-img" alt="villa3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>

      </div>

      <form action="search_property.php" method="GET" class="search">
  <input type="text" name="search" placeholder="House, Office..." required>
  <button type="submit"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
</form>

<section class="shop">
  <?php
  $properties = mysqli_query($conn, "SELECT * FROM property");
  while ($property = mysqli_fetch_array($properties)) { ?>
  </div>
      <?php } ?>
    </section>
    <br />
    <br /> 
    <div class="dis">
      <div class="disc">
        <p class="details"
          style="color: aliceblue; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 20px; ">in our platform you can search for any property you need ( house, office, appartement....) and buy or rent , or Book an appointment to ask for a tour in the property , just by one click</p>
      </div>
    </div>

    <h2 id="divider">Our Properties :</h2>
    
    <?php $properties = mysqli_query($conn,"SELECT * FROM property LEFT JOIN agency ON property.property_owner =  agency.agency_id   WHERE status='available' ORDER BY property_id DESC ");?>
    <section class="shop">

    <?php while($property = mysqli_fetch_array($properties)) { 
          $property_id = $property['property_id'];
          $photos_result = mysqli_query($conn, "SELECT * FROM property_photos WHERE property_id = '$property_id' ");
          $property_photo = mysqli_fetch_array($photos_result)
    ?>
      <div class="box" >
        <img id="shopimg" src="images/<?php echo $property_photo['photo']; ?>" alt="home">
        <h3 class="location"  style=" color: rgb(92, 59, 190);" ><?php echo $property['address'] ?></h3>
        <p class="price">DA <?php echo $property['price'] ?></p>
        <p class="type"><?php echo $property['type'] ?></p>
        <h5 class="status" style="  color: rgb(32, 161, 47);" ><?php echo $property['status'] ?></h5>
        <h5 class="property_owner">Agency : <?php echo $property['agency_name'] ?></h5>
        <?php if ($property['for_sale'] == 1) {
          echo  "<p>For sale</p>";
        } else {
          echo  "<p>For Rent</p>";
        } ?>
        <button style="background-color: blue; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-size: 16px;">
  <a href="property_details.php?id=<?php echo $property['property_id']; ?>" class="click" style="text-decoration: none; color: #fff;">Know more</a>
</button>
 </div>
    <?php } ?>
    </section>
  
    <h2 id="divider">Our Team :
      <hr>
    </h2>
    <section class="agents">
      <div class="agent">
        <img id="agentimg" src="img/man1.jpg" alt="home">
        <h5 class="name">name </h5>
        <h6 class="details">Agent</h6>
        

      </div>
      <div class="agent">
        <img id="agentimg" src="img/man2.jpg" alt="home">
        <h5 class="name">name </h5>
        <h6 class="details">Agent</h6>
        

      </div>
      <div class="agent">
        <img id="agentimg" src="img/woman1.jpg" alt="home">
        <h5 class="name">name </h5>
        <h6 class="details">Agent</h6>
        

      </div>
      <div class="agent">
        <img id="agentimg" src="img/man3.jpg" alt="home">
        <h5 class="name">name</h5>
        <h6 class="details">Agent</h6>
        

      </div>
      <div class="agent">
        <img id="agentimg" src="img/woman2.jfif" alt="home">
        <h5 class="name">name </h5>
        <h6 class="details">Agent</h6>
        

      </div>
    </section>
  </main>
  <footer class="footer">

    <div class="f2">
      <div class="topicons">
        <a href="https://instagram.com/djihane_bouteldja?igshid=ZDdkNTZiNTM="><i class="fab fa-instagram"> Instagram :
            Real_Estate</i></a> <br>
        <a href="#"><i class="fab fa-twitter"> Twitter : @RealEs23</i></a><br />
        <a href="https://www.facebook.com/jii.hane.315"><i class="fab fa-facebook"> Facebook : Real estate</i></a><br />
        <a href="https://call.whatsapp.com/video/IfDfXpk0PaSWeZbfCL0YLJ"><i class="fab fa-whatsapp"> Whatsapp :
            +2135655665</i></a><br />

      </div>
      <p class="copy">&copy; RealEstate 2023</p>
      <a href="#top"><i class="fa-regular fa-up"></i></a>
    </div>
  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>