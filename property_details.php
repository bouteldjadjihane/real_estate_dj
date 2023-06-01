<?php
    session_start();

    // include the database connection file
  include('inc/connection.php');
    if ( isset($_POST['appointment'])) {
      $app_date = $_POST['appointment_date'];
      $property_id = $_POST['property_id'];
      $property_owner = $_POST['property_owner'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $query = "INSERT INTO appointment (appointment_id, appointment_date, property_id, full_name, phone, agency_id, completed) 
      VALUES (NULL, '$app_date', '$property_id', '$name', '$phone', '$property_owner', NULL)";

      if (mysqli_query($conn, $query)) {
        echo "request sent successfully.";
        $prop_id = mysqli_insert_id($conn);
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    if ( isset($_POST['rent'])) {
      $start_date = $_POST['start_date'];
      $end_date = $_POST['end_date'];
      $sd = date_create($start_date);
      $ed = date_create($end_date);
      $property_id = $_POST['property_id'];
      $property_owner = $_POST['property_owner'];
      $user_id = $_POST['user_id'];
      $interval = date_diff($sd, $ed);
      $formatted = $interval->format('%a days');
      $start = $_POST['start_date'];
      $end = $_POST['end_date'];
      $_SESSION['start_date'] = $start;
      $_SESSION['end_date'] = $end;
      $_SESSION['is_rent'] = $_POST['is_rent'];
      if ( (int) $formatted < 28 ) {
       $failure = "Sorry you can not rent for less than a month";
      } else {
        header('Location: register.php');
      }
    }
  
    if ( isset($_POST['buy'])) {

      $user_id = $_POST['user_id'];
      $property_id = $_POST['property_id'];
      $property_owner = $_POST['property_owner'];
      $_SESSION['is_rent'] = $_POST['is_rent'];
      $_SESSION['offer'] = isset($_POST['offer']) ?  $_POST['offer'] : '0';
      header('Location: register.php');
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
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
/>
  <style>
    img {
      max-width: 100%;
    }
.flex-container {
  display: flex;
}

.flex-container > div {
  background-color: #f1f1f1;
  border-radius: 2px black ;
  margin: 10px;
  padding: 20px;
  font-size: 30px;
  width: 40%;
  border: 2px solid black;
 border-radius: 6%;

  position: relative;
  left: 100px;
  top: 20px;
}
</style>
</head>

<body>
  <a name="top"></a>
  <header class="header">
    <div class="main-logo">
      <img id="logopic" src="img/build4.png" alt="logopic">
      <h1 id="logo">RealEstate</h1>
    </div>
    <nav class="toplinks" style="padding-left: 50px;">
      <a href="djihane.php" class="nlinks">back</a>

      <a href="buy.html" class="nlinks">Buy</a>
      <a href="#" class="nlinks">Rent</a>
      <a href="Office.html" class="nlinks">contact us</a>

    </nav>
  </header>
  <?php if (isset( $success)) {?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?php echo $success; ?></strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php } else if ( isset( $failure )){?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><?php echo $failure; ?></strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php } ?>
  <div class="flex-container">

  <?php
  // Get the property ID from the query parameter
  $property_id = $_GET['id'];
  $_SESSION['property_id'] = $_GET['id'];

    $photos_result = mysqli_query($conn, "SELECT * FROM property_photos WHERE property_id = '$property_id'");
    $first_pic = true;
  ?>
  <div  style="height:800px;" >
    
  <?php while ( $photos = mysqli_fetch_array($photos_result)) {
    // print_r( $photos) ;
    // exit; 
    if ( $first_pic ) { $first_pic = false; ?>
      <a href="images/<?php echo $photos['photo']; ?>" data-fancybox><img src="images/<?php echo $photos['photo']; ?>" alt="" width="469"></a>
    <?php } else { ?>
      <a href="images/<?php echo $photos['photo']; ?>" data-fancybox><img src="images/<?php echo $photos['photo']; ?>" alt="" width="150"></a>
  <?php }}   ?> 

  <br/> <div >    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51088.61615453398!2d7.68439270063245!3d36.84155375598793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12f00915843fdbe3%3A0x91108eebd8d13a11!2sBadji%20Mokhtar%20University!5e0!3m2!1sfr!2sdz!4v1677349469374!5m2!1sfr!2sdz" width="400" height="240" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> </div>
  </div>

  <div>
<?php
// Retrieve the property details from the database based on the ID
$sql = "SELECT * FROM property WHERE property.property_id = $property_id"; // prepared statments
$result = mysqli_query($conn, $sql);
$property = mysqli_fetch_assoc($result);

// Check if the property exists
if ($property) {
  // Display the property details
  $_SESSION['property_owner'] = $property['property_owner']; 
  echo '<h3  style=" position:relative; left:90px; color: rgb(22, 22, 144); " >Property Details:</h3>';
  echo '<p>Type: ' . $property['type'] . '</p>';

  echo "<p>Address: " . $property['address'] . "</p>";
  echo '<p>Price: DA <span style=" text-decoration: underline;">' . $property['price'] . '</span></p>';
  echo '<p>Status: <span style="  color: rgb(32, 161, 47);">' . $property['status'] . '</span></p>';
  echo '<p>description: <br> ' . $property['description'] . '</p>';?>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentModal">
Ask for an appointment
</button>

  <!-- Modal -->
  <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        <form method="POST">
        <div class="mb-3">
          <label for="appointment" style=" color: #13346c; position:relative; left: 50px;" >Book for an appointment</label><br/><br/>
          <i class="fa-regular fa-calendar-check fa-2xl" style="color: #5f82bf; position:relative; left: 190px; "></i></i><br/>
          <br/>
          <div class="mb-3">
          <input class="form-control" type="text" name="name" placeholder="full name" required>
          </div>
          <div class="mb-3">
          <input class="form-control" type="tel" name="phone" placeholder="phone number"  required >
          </div>
          <h6>Let us know when you'll be ready</h6>
          <input class="form-control date" type="date" id="appointment" name="appointment_date" min="0" required>
        </div>
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
        <input type="hidden" name="property_owner" value="<?php echo $_SESSION['property_owner']; ?>">
          <button class="btn btn-primary" name="appointment">Submit</button>
        </form>
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mt-1" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->

  <div class="modal fade" id="rentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        <form method="POST">
        <div class="mb-3">
          <label for="rent" style=" color: #13346c; position:relative; left: 195px;" ><b>Rent</b></label><br/><br/>
          <p  style="font-size: 0.7em;"
  >Please enter the duration <i class="fa-solid fa-hourglass-half " style="color: #5180d2;"></i> </p>

          <div class="mb-3">
            <label for="startDate" style="color: #5180d2; font-size: 0.7em;">Start Date</label>
          <input class="form-control date" type="date" id="startDate" name="start_date" placeholder="start_date" min="0"  required >
          </div>
          <div class="mb-3">
            <label for="endDate" style="color: #5180d2; font-size: 0.7em; " >End Date</label>
          <input class="form-control date" type="date" id="endDate" name="end_date" placeholder="end_date" min="0" required >
          </div>
        </div>
        <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>">
        <input type="hidden" name="is_rent" value="1">
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
        <input type="hidden" name="property_owner" value="<?php echo $_SESSION['property_owner']; ?>">
        <button class="btn btn-primary" name="rent">Rent</button>
        <h6><br/>*Note : You can't rent for less than a month </h6>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mt-1" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php
  if ($property['for_sale'] == 1) {
    echo '<form method="POST">'; ?>
    <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>">
        <input type="hidden" name="is_rent" value="">
        <input type="hidden" name="offer" value="">
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
        <input type="hidden" name="property_owner" value="<?php echo $_SESSION['property_owner']; ?>">
    <?php echo '<button name="buy" style="background-color: #fc5959; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-size: 16px;">';
    echo 'Buy</button>';
    echo '</form>';
    echo '<button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#pricing">OR installment payments';
    echo '</button>';
  } else {
    echo '<p style=" color:blue; " ><b>For Rent</b></p>';
    echo '<button style="background-color: #fc5959; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-size: 16px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rentModal" style="text-decoration: none; color: #fff;">Rent</button>';
  }
} else {
  echo "Property not found.";
}

// Close the database connection
mysqli_close($conn);
?></div>
</div>
<!-- Modal -->
<div class="modal fade" id="pricing" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Buy now, pay over time</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <div class="grid">
  <label class="card">
    <input name="plan" class="radio" type="radio" value="1" checked>
    <span class="plan-details">
      <span class="plan-type">5 Months</span>
      <span class="plan-cost">20% <span class="slash">/</span><abbr class="plan-cycle" title="month">mo</abbr></span>
      <span>1 team member</span>
      <span>100 GB/mo</span>
      <span>1 concurrent build</span>
    </span>
  </label>
  <label class="card">
    <input name="plan" class="radio" type="radio" value="2">
    <span class="hidden-visually">Pro - $50 per month, 5 team members, 500 GB per month, 5 concurrent builds</span>
    <span class="plan-details" aria-hidden="true">
      <span class="plan-type">1 Year</span>
      <span class="plan-cost">8.3% <span class="slash">/</span><span class="plan-cycle">mo</span></span>
      <span>5 team members</span>
      <span>500 GB/mo</span>
      <span>5 concurrent builds</span>
    </span>
  </label>
  <label class="card">
    <input name="plan" class="radio" type="radio" value="3">
    <span class="hidden-visually">Business - $200 per month, 5+ team members, 1000 GB per month, Unlimited builds</span>
    <span class="plan-details" aria-hidden="true">
      <span class="plan-type">5 Years</span>
      <span class="plan-cost">1.6% <span class="slash">/</span><span class="plan-cycle">mo</span></span>
      <span>5+ team members</span>
      <span>1000 GB/mo</span>
      <span>Unlimited builds</span>
    </span>
  </label>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Apply</button> -->
        <a class="btn btn-danger buy-btn" href="register.php" style="text-decoration: none; color: #fff; background: tomato">Buy</a>
      </div>
    </div>
  </div>
</div>
<style>
  :root {
	 --card-line-height: 1.2em;
	 --card-padding: 1em;
	 --card-radius: 0.5em;
	 --color-green: #558309;
	 --color-gray: #e2ebf6;
	 --color-dark-gray: #c4d1e1;
	 --radio-border-width: 2px;
	 --radio-size: 1.5em;
}
 body {
	 background-color: #f2f8ff;
	 color: #263238;
	 font-family: 'Noto Sans', sans-serif;
	 margin: 0;
	 padding: 2em 6vw;
}
 .grid {
	 display: grid;
	 grid-gap: var(--card-padding);
	 margin: 0 auto;
	 max-width: 60em;
	 padding: 0;
}
 @media (min-width: 42em) {
	 .grid {
		 grid-template-columns: repeat(3, 1fr);
	}
}
 .card {
	 background-color: #fff;
	 border-radius: var(--card-radius);
	 position: relative;
}
 .card:hover {
	 box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
}
 .radio {
	 font-size: inherit;
	 margin: 0;
	 position: absolute;
	 right: calc(var(--card-padding) + var(--radio-border-width));
	 top: calc(var(--card-padding) + var(--radio-border-width));
}
 @supports (-webkit-appearance: none) or (-moz-appearance: none) {
	 .radio {
		 -webkit-appearance: none;
		 -moz-appearance: none;
		 background: #fff;
		 border: var(--radio-border-width) solid var(--color-gray);
		 border-radius: 50%;
		 cursor: pointer;
		 height: var(--radio-size);
		 outline: none;
		 transition: background 0.2s ease-out, border-color 0.2s ease-out;
		 width: var(--radio-size);
	}
	 .radio::after {
		 border: var(--radio-border-width) solid #fff;
		 border-top: 0;
		 border-left: 0;
		 content: '';
		 display: block;
		 height: 0.75rem;
		 left: 25%;
		 position: absolute;
		 top: 50%;
		 transform: rotate(45deg) translate(-50%, -50%);
		 width: 0.375rem;
	}
	 .radio:checked {
		 background: var(--color-green);
		 border-color: var(--color-green);
	}
	 .card:hover .radio {
		 border-color: var(--color-dark-gray);
	}
	 .card:hover .radio:checked {
		 border-color: var(--color-green);
	}
}
 .plan-details {
	 border: var(--radio-border-width) solid var(--color-gray);
	 border-radius: var(--card-radius);
	 cursor: pointer;
	 display: flex;
	 flex-direction: column;
	 padding: var(--card-padding);
	 transition: border-color 0.2s ease-out;
}
 .card:hover .plan-details {
	 border-color: var(--color-dark-gray);
}
 .radio:checked ~ .plan-details {
	 border-color: var(--color-green);
}
 .radio:focus ~ .plan-details {
	 box-shadow: 0 0 0 2px var(--color-dark-gray);
}
 .radio:disabled ~ .plan-details {
	 color: var(--color-dark-gray);
	 cursor: default;
}
 .radio:disabled ~ .plan-details .plan-type {
	 color: var(--color-dark-gray);
}
 .card:hover .radio:disabled ~ .plan-details {
	 border-color: var(--color-gray);
	 box-shadow: none;
}
 .card:hover .radio:disabled {
	 border-color: var(--color-gray);
}
 .plan-type {
	 color: var(--color-green);
	 font-size: 1.5rem;
	 font-weight: bold;
	 line-height: 1em;
}
 .plan-cost {
	 font-size: 2.5rem;
	 font-weight: bold;
	 padding: 0.5rem 0;
}
 .slash {
	 font-weight: normal;
}
 .plan-cycle {
	 font-size: 2rem;
	 font-variant: none;
	 border-bottom: none;
	 cursor: inherit;
	 text-decoration: none;
}
 .hidden-visually {
	 border: 0;
	 clip: rect(0, 0, 0, 0);
	 height: 1px;
	 margin: -1px;
	 overflow: hidden;
	 padding: 0;
	 position: absolute;
	 white-space: nowrap;
	 width: 1px;
}
 
</style>
<script>
  Fancybox.bind("[data-fancybox]", {
  // Your custom options
  });

  var buyBtn = document.querySelector('.buy-btn');
  buyBtn.addEventListener('click', function(e){
    var radioBtns = document.querySelectorAll('.radio');
    radioBtns.forEach(function(btn){
      if ( btn.checked ) {
        document.cookie = "offer="+ btn.value +"; SameSite=None; Secure";
      } 
    })
  });

  window.addEventListener("DOMContentLoaded", (event) => {
      // Get today's date
      var today = new Date();
  today.setDate(today.getDate() + 1);

  var tomorrow = today.toISOString().split('T')[0];
    // Set the minimum date for the date picker
    var elements = document.querySelectorAll("input.date");

    elements.forEach(function(el) {
      el.setAttribute("min", tomorrow);
    });

  });


</script>
</body>
</html>