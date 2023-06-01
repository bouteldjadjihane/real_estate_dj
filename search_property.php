<?php
include('inc/connection.php');

// Check if the search query parameter is provided
if (isset($_GET['search'])) {
  // Sanitize the search query to prevent SQL injection
  $search = mysqli_real_escape_string($conn, $_GET['search']);

  // Fetch properties matching the search query from the database
  // $query = "SELECT * FROM property WHERE type LIKE '%$search%' AND status = 'available' ";

  // $searchResults = mysqli_query($conn, $query);
}
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

  <header class="header">
    <div class="main-logo">
      <img id="logopic" src="img/build4.png" alt="logopic">
      <h1 id="logo">RealEstate</h1>
    </div>
    <nav class="toplinks" style="padding-left: 50px;">
      <a href="djihane.php" class="nlinks">Back</a>

      <a href="djihane.php#divider" class="nlinks">Buy</a>
      <a href="djihane.php#divider" class="nlinks">Rent</a>
    </nav>
  </header>
</head>
<hr>

<body>

  <h3 style="position:relative; left:50px; color:rgb(22, 92, 163) ; ">Search Results:</h3><br />
  <main class="main">
    <section class="search-results">
    <section class="shop">
    <?php $properties = mysqli_query($conn, "SELECT * FROM property WHERE type LIKE '%$search%' AND status = 'available'");
    if (mysqli_num_rows($properties) == 0) {?>
      <div class="alert alert-primary" role="alert">
      <i class="fa-solid fa-circle-info"></i> No matching properties found!
      </div>
    <?php } ?>
       <?php while ($property = mysqli_fetch_array($properties)) { ?>
        <div class="box">
          <img id="shopimg" src="img/ap2.jpg" alt="home">
          <h3 class="location">
            <?php echo $property['address'] ?>
          </h3>
          <p class="details">
            <?php echo $property['price'] ?>
          </p>
          <p class="type">
            <?php echo $property['type'] ?>
          </p>
          <h5 class="price">
            <?php echo $property['status'] ?>
          </h5>
          <h5 class="property_owner">Agency :
            <?php echo $property['property_owner'] ?>
          </h5>
          <?php if ($property['for_sale'] == 1) {
            echo "<p>For sale</p>";
          } else {
            echo "<p>For Rent</p>";
          } ?>
          <button
            style="background-color: blue; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-size: 16px;">
            <a href="property_details.php?id=<?php echo $property['property_id']; ?>" class="click"
              style="text-decoration: none; color: #fff;">Know more</a>
          </button>
        </div>
      <?php } ?>

  </main>
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
  <footer class="footer">
    <div class="f1">
      <div class="line1">
        <a href="#" class="nlinks">Locations</a>
        <a href="#" class="nlinks">Devlopers</a>
        <a href="#" class="nlinks">hot zones</a>
      </div>
      <div class="line2">
        <a href="#" class="nlinks">Buy</a>

        <a href="#" class="nlinks">Rent</a>
      </div>
    </div>
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