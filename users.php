<?php
session_start();//session call
include('inc/connection.php');

function order_by_id($order_id) {
  global $conn;
  $query = mysqli_query($conn,"SELECT * FROM apply LEFT JOIN users on users.id = apply.user_id LEFT JOIN property ON apply.property_id = property.property_id WHERE apply.order_id = '$order_id'"); 
  $order = mysqli_fetch_array($query, MYSQLI_ASSOC);
 return $order;
}

function secondsToTime($seconds) {

  $days = floor($seconds / 86400);
  
  return $days;
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

if( isset( $_SESSION['id'] ) || isset( $_SESSION['agency_id'] ) ) {
  
  $id = $_SESSION['id'];
  
  $user = $_SESSION['username']; //if he insert a correct id n username f login hothom hna fi variable
  
  $count = mysqli_query($conn, "SELECT COUNT(*) AS userCount FROM users");
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
    <title>Users </title>
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
            <nav class="navbar navbar-expand-lg " style="background-color: whitesmoke; top: 0px; position: fixed; width: 100%; height: 70px; z-index:999; ">
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
              <form method="GET" action="search.php">
  <input type="text" name="search" placeholder=" Enter your search term" style="position:relative; left:500px; height:50px; border-radius: 20px; width:250px; " >
  <button type="submit" style="position:relative; left:500px; height:50px; width: 50px; background-color: #70ade6; border-radius: 20px;" ><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
<h1 class="d-flex justify-content-center">Sold Properties</h1>
 <div class="d-flex justify-content-center">
        <table>
          <tr>
            <th>name</th>
            <th>email</th>
            <th>property</th>
            <th>Paying over</th>
            <th>date</th>
            <th><div style=" color: blue; " >View</div></th>
            <th><div style=" color: red;  ">Delete</div></th>
          </tr>
          <tr>
    <?php
    $name = $_SESSION['username'];
    // Fetch data from the users table
    $sql = "SELECT apply.order_id, apply.user_id, apply.property_id, apply.approved, apply.agency_id, apply.order_date, apply.offer,
		users.username, users.email, 
        property.type, property.for_sale , property.for_rent
        FROM apply 
    LEFT JOIN property
    ON property.property_id = apply.property_id
    LEFT JOIN users
    ON users.id = apply.user_id
    WHERE apply.approved = 1 AND apply.agency_id = $id
    GROUP BY apply.user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td>' . $row["username"] . '</td>';
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["type"] . "</td>";
        echo "<td>";
        if  ( $row["offer"] == '0') { 
            echo 'Paid';
        } else if ($row["offer"] == '1') {
            echo '5 Months';
        } elseif ($row["offer"] == '2') {
            echo '1 year';
        } else {
            echo '6 Years';
        }
        echo "</td>";
        
        echo '<td>' . $row["order_date"] . "</td>";
        echo '<td><button button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#view' . $row['user_id'] . '">
        <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        </td>';
        ?>
        
        <!-- Modal -->
        <div class="modal fade" id="view<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Buying Status for: <span style="color: #3668bf;"><?php echo $row['username']; ?></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <?php $order = order_by_id($row['order_id']);?>
                
    <p class="proile-rating"><i class="fa-solid fa-house fa-xl me-2" style="color: #3668bf;"></i>property ID: <span><?php echo $order['property_id'] ?></span></p>
    <p class="proile-rating"><i class="fa-solid fa-square-check fa-xl me-2 " style="color: #3668bf;"></i> Offer Selected : <span><?php if (is_null($order["offer"])) {
    echo 'Directly';
    } else if ($order["offer"] == '1') {
        echo '5 Months';
    } elseif ($order["offer"] == '2') {
        echo '1 year';
    } else {
        echo '6 Years'; 
    } ?></span></p>
    <p class="proile-rating"><i class="fa-solid fa-sack-dollar fa-xl me-2" style="color: #3668bf; "></i>Property Price: <span><?php echo $order['price'] ?></span></p>
    <p class="proile-rating"><i class="fa-solid fa-money-check-dollar  fa-xl me-2" style="color: #3668bf;"></i>Monthly paying amount: DA<span> <?php
        $offer = $order['offer'];
        $price = $order['price'];
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
    <p class="proile-rating"><i class="fa-solid fa-piggy-bank fa-xl me-2" style="color: #3668bf;"></i>Remaining Amount: DA <span><?php echo $order['price'] -  $payingAmount; ?></span>
    </p>
    <p class="proile-rating"><i class="fa-solid fa-clock-rotate-left  fa-xl me-2" style="color: #3668bf;"></i>Due Date: 
      <span>
        <?php
        // set the default timezone to use.
        date_default_timezone_set('UTC');
        $date = new DateTimeImmutable($order['expected_end_date']);
        $x = $date->format('l jS \o\f F Y h:i:s A');
        echo $x;
        ?>
    </span>
    </p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
<?php
        echo '<td><a  href="delete_user.php?id='.$row['user_id'].'"><button name="delete-button" class="delete-button"><i class="fa-sharp fa-solid fa-trash" style="color: #db334c;"></i></button></a></form></td>';
        echo "</tr>";
      }
    } else {
      echo "No users found.";
    }
    ?>

  </table>

</div>
<h1 class="d-flex justify-content-center">Rented Properties</h1>
<!-- to do 

if u touch it, i would hit u up so hard that the whole world will hear you shouting . i would prefer to die-->
 <div class="d-flex justify-content-center mb-5"> 
 <table class="table table-responsive table-striped" style="width: 62%">
    <tr>
      <th>name</th>
      <th>property</th>
      <th>Duration</th>
      <th>Remaining Days</th>
    </tr>
    <tr>
    <?php
    $name = $_SESSION['username'];
    $id = $_SESSION['id'];
    // Fetch data from the users table
    $sql = 
    "SELECT tenancy.tenancy_id, tenancy.user_id, tenancy.property_id, tenancy.approved, tenancy.date_start, tenancy.date_end, DATEDIFF(date_start, date_end) AS duration,
		users.username, 
        property.property_id, property.for_sale, property.property_owner, property.type
        FROM tenancy 
    LEFT JOIN property
    ON property.property_id = tenancy.property_id
    LEFT JOIN users
    ON users.id = tenancy.user_id
    WHERE tenancy.approved IS NOT NULL AND property.property_owner = '$id' AND property.for_sale = '0'
    GROUP BY tenancy.property_id";
    $rentals_result = $conn->query($sql);
    if ($rentals_result->num_rows > 0) {
      // Output data of each row
      while ($row = $rentals_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["type"] . "</td>";
        //echo "<td>" . $row["property_id"] . "</td>";
        echo "<td>" . str_replace("-", "", $row["duration"]) . " days</td>";
        $remainingDays = calc_remaining_days($row['date_start'], $row['date_end']);
    
        $styleClass = ($remainingDays > 5) ? 'green' : 'red';
        echo "<td class='$styleClass' style='font-weight: bold;'>" . $remainingDays . " days</td>";
        
        echo "</tr>";
    }
    } else {
      echo "No requests found.";
    }?>
  </table>
</div>
<style>

table {
      border-collapse: collapse;
      width: 60%;
    }
    
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
      
    }
    
    th {
      background-color: #f2f2f2;
    }
    .accept-button {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;

  height: auto;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

.green {
    color: rgb(75, 216, 91);
    
  
  }

.red {
    color: red;
}

.accept-button:hover {
  background-color: #45a049;
  
}

.accept-button:active {
  background-color: #3e8e41;
}
.delete-button {
  padding: 10px 20px;
  background-color: white;
  color: white;

  height: auto;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

.delete-button:hover {
  cursor: no-drop;
}

.delete-button:active {
  background-color: #3e8e41;
}



</style>



</body>

</html>
<?php 
}
}
?>