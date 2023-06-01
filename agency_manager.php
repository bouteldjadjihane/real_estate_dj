<?php
session_start();//session call
include('inc/connection.php');

// Accept rental (tenancy) requests
if ( isset($_POST['accept_tenancy'])) { 
  $user_id = $_POST['uid'];
  $tenancy_id = $_POST['tenancy_id'];
  $property_id = $_POST['property_id'];
  $query = "UPDATE tenancy SET approved = '1' WHERE tenancy_id = '$tenancy_id'";
  $accept_tenancy = mysqli_query($conn, $query);
  $affectd_rows = mysqli_affected_rows($conn);
  if ($affectd_rows) {
    mysqli_query( $conn, "UPDATE property SET status = 'rented' WHERE property_id = '$property_id'");
    $success = "approved successfully";
    mysqli_query($conn, "UPDATE users SET approved = '1' WHERE id = '$user_id' ");
  } else {
    $failure = "Ooops! something went wrong";
  }
}
// Delete rental (tenancy) requests
if ( isset($_POST['delete_tenancy'])) {
  $tenancy_id = $_POST['tenancy_id'];
  $query = "DELETE FROM tenancy WHERE tenancy_id = '$tenancy_id' LIMIT 1";
  $accept_tenancy = mysqli_query($conn, $query);
  $affectd_rows = mysqli_affected_rows($conn);
  if ($affectd_rows) {
    $success = "deleted successfully";
  } else {
    $failure = "Ooops! something went wrong";
  }
}

if (isset($_POST['fulfill'])) {
  $app_id = $_POST['appointment_id'];
  $query = "UPDATE appointment SET completed = '1' WHERE appointment_id = '$app_id'";
  $fulfill_result =  mysqli_query($conn, $query);
  if ( mysqli_affected_rows($conn) > 0) {
    $success = "Done successfully";
  } else {
    $failure = "Ooops! Something went wrong";
  }
}

if ( isset($_POST['add_property'])) {

  $type = $_POST['type'];
  $address = $_POST['address'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $rent = ($_POST['rent_or_sale'] == 'rent') ? 1 : 'null';
  $sale = ($_POST['rent_or_sale'] == 'sale') ? 1 : 'null';
  $property_owner = $_POST['property_owner'];

  // Prepare the SQL statement
  $sql = "INSERT INTO property (type, address, price, for_sale, for_rent, property_owner,status,description)
          VALUES ('$type', '$address', '$price', '$sale', '$rent', '$property_owner','available','$description')";
  echo $sql . "<br>";
  // Execute the SQL statement
  if (mysqli_query($conn, $sql)) {
    echo "Property added successfully.";
    $prop_id = mysqli_insert_id($conn);
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $images_folder = 'images';
    foreach ($_FILES["pictures"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = basename($_FILES["pictures"]["name"][$key]);
            move_uploaded_file($tmp_name, "$images_folder/$name");
            mysqli_query($conn, "INSERT INTO property_photos (property_id, photo) VALUES( '$prop_id', '$name' ) ");
        }
    }
  
}

if( isset( $_SESSION['id'] ) || isset( $_SESSION['agency_id'] ) ) {
  
    $id = $_SESSION['id'];
    
    $user = $_SESSION['username']; //if he insert a correct id n username f login hothom hna fi variable
    
    $count_prop_result = mysqli_query($conn, "SELECT COUNT(*) FROM property WHERE property_owner = '$id'");

    $count_properties = mysqli_fetch_array($count_prop_result)[0]; 

    $count = mysqli_query($conn,"SELECT COUNT(*) AS userCount FROM users ");

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
    <title>Agnency Manager</title>
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
                        <a class="nav-link active" aria-current="page" href="index.html" style="color: black;" >Home</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Actions
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#orders">Orders</a></li>
                          <li><a class="dropdown-item" href="#rentals">Rentals</a></li>
                          <li><a class="dropdown-item" href="#appointments">Appointments</a></li>
                          <li><a class="dropdown-item" href="#add">Add New Property</a></li>
                        </ul>      
                      </li>         
                    </ul>
                    <li class="nav-item">
                       <a href="logout.php" style="color: red; " >Log out</a>
                       <li style="position:relative; left:100px;" >
                      <b> Agency Name : <?php echo $user ?></b>
                      </li>
                  </div>
                </div>
              </nav></header><br/><br/>
              <div class="mt-5 mb-2" style="font-size: 20px; color: darkblue; display: flex; justify-content: center; transition: width 0.3s ease;  " ><b>Welcome To  Agency Manager Page <i class="fa-regular fa-face-smile fa-bounce" <i class="fa-sharp fa-solid fa-hand-wave" style="color: #5e9ed9;"></i></i></b></div>
  <div class="container justify-content-between">
<div class="row">
<div class="col-12">
<?php
include('inc/connection.php');

// Query to count the number of users
$sql = "SELECT COUNT(*) AS userCount FROM apply WHERE approved = 1 and agency_id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
$row = mysqli_fetch_assoc($result);
$userCount = $row['userCount'];
echo '<p><b><i class="fa-solid fa-user-group"></i> </b>Total users: <span class="user-count" style="color: blue;font-weight: bold;" >' . $userCount.'</p>';
} else {
echo "Error: " . mysqli_error($conn);
}

?>

<?php
include('inc/connection.php');

// Query to count applies (buy/rent applications)
$sql = "SELECT COUNT(*) AS appliesCount FROM apply WHERE approved is NULL and agency_id = $id ";
$result = mysqli_query($conn, $sql);

if ($result) {
$row = mysqli_fetch_assoc($result);
$userCount = $row['appliesCount'];
echo  '<p><b><i class="fa-solid fa-person-circle-plus"></i></b> Total Buy requests :  <span class="user-count" style="color: blue;font-weight: bold;" >' .$userCount.'</span></p>';
} else {
echo "Error: " . mysqli_error($conn);
}

?>
<?php
echo '<p><b><i class="fa-solid fa-house"></i></b> Total properties:  <span class="user-count" style="color: blue;font-weight: bold;">' .$count_properties.'</p>';

?>
<div style="display: flex; gap: 30px;">
<div class="card">
<p>click here to see all the users </p>
<a href="users.php" ><button class="btn">Users</button></a>
</div>

<div class="card">
<p>Click here to View all the properties u posted</p>
<a href="agency_properties.php" ><button class="btn">Properties</button></a>
</div>

</div>
<div class="col">
<h5 id="orders">Orders</h5>

    <table class="table table-responsive">
    <tr>
      <th>name</th>
      <th>email</th>
      <th>property</th>
      <th>property ID</th>
      <th>Paying over</th>
      <th><div style="color: rgb(26, 176, 96); ">accept</div></th>
      <th><div style=" color: red; ">delete</div></th>
    </tr>
    <tr>
    <?php 
    $name = $_SESSION['username'];
    $id = $_SESSION['id'];
    // Fetch data from the users table
    $sql = "SELECT apply.order_id, apply.user_id, apply.property_id, apply.approved, apply.agency_id, apply.offer,
		users.id AS uid, users.username, users.email, 
        property.type, property.for_sale
        FROM apply 
    LEFT JOIN property
    ON property.property_id = apply.property_id
    LEFT JOIN users
    ON users.id = apply.user_id
    WHERE apply.approved IS NULL AND apply.agency_id = '$id' AND property.for_sale = '1'
    GROUP BY apply.order_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["type"] . "</td>";
        echo "<td>" . $row["property_id"] . "</td>";
        echo "<td>";
        if ($row["offer"] == '0') {
            echo 'Directly';
        } else if ($row["offer"] == '1') {
            echo '5 Months';
        } elseif ($row["offer"] == '2') {
            echo '1 year';
        } else {
            echo '6 Years';
        }
        echo "</td>";
        
        echo '<td><a  href="approve.php?id='. $row['order_id'] . '&prop_id='. $row['property_id'] .  '&uid='. $row['uid'] . '"><i class="fa-solid fa-user-plus"></i></a></td>';
        echo '<td><a  href="delete.php?id='. $row['order_id'] . '"><button name="delete-button" class="delete-button"><i class="fa-sharp fa-solid fa-trash" style="color: #db334c;"></i></button></a></form></td>';
        echo "</tr>";
      }
    } else {
      echo "No requests found."; //
    }
    ?>
  </table>
  </div>

  <div class="col">
<h5 id="rentals">Rentals</h5>
    <table class="table table-responsive table-striped">
    <tr>
      <th>name</th>
      <th>property</th>
      <th>prop id</th>
      <th>Duration</th>
      <th><div style="color: rgb(26, 176, 96); ">accept</div></th>
      <th><div style="color: red;">delete</div></th>
    </tr>
    <tr>
    <?php
    $name = $_SESSION['username'];
    $id = $_SESSION['id'];
    // Fetch data from the users table
    //, tenancy.date_start AS ds, tenancy.date_end AS de
    $sql = 
    "SELECT tenancy.tenancy_id, tenancy.user_id, tenancy.property_id, tenancy.approved, DATEDIFF(date_start, date_end) AS duration,
		users.username, users.id AS uid,
        property.property_id, property.for_sale, property.property_owner, property.type
        FROM tenancy 
    LEFT JOIN property
    ON property.property_id = tenancy.property_id
    LEFT JOIN users
    ON users.id = tenancy.user_id
    WHERE tenancy.approved IS NULL AND property.property_owner = '$id' AND property.for_sale = '0'
    GROUP BY tenancy.tenancy_id";
    $rentals_result = $conn->query($sql);
    if ($rentals_result->num_rows > 0) {
      // Output data of each row
      while ($row = $rentals_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["type"] . "</td>";
        echo "<td>" . $row["property_id"] . "</td>";
        echo "<td>" . str_replace("-", "", $row["duration"]) . " days</td>";
        echo '<td><form method="POST"> <input type="hidden" name="property_id" value="'. $row['property_id'] .'"><input type="hidden" name="uid" value="'. $row['uid'] .'"><input type="hidden" name="tenancy_id" value="'. $row['tenancy_id'] .'"><i class="fa-solid fa-user-plus"></i><button name="accept_tenancy">Accept</button>
  </form></td>';
        echo '<td><form method="POST"><input type="hidden" name="property_id" value="'. $row['property_id'] .'"> <input type="hidden" name="tenancy_id" value="'. $row['tenancy_id'] .'"><i class="fa-sharp fa-solid fa-trash" style="color: #db334c;"></i><button name="delete_tenancy">Delete</button></form></td>';
        echo "</tr>";
      }
    } else {
      echo "No requests found.";
    }
    ?>
  </table>
  </div>

</div>
<div class="row">
  <div class="col">
  <?php if (isset($success)) {?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo $success; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } elseif (isset($failure)){?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo $failure; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php } ?>
  <h5 id="appointments">Appointments</h5>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Appointment date</th>
      <th scope="col">Property</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Completed <i class="fa-regular fa-circle-check" style="color: #68dfa7;"></i></th>
    </tr>
  </thead>
  <?php
    $agency_id = $_SESSION['id'];
    $query = "SELECT * FROM appointment AS app 
    LEFT JOIN 
    agency ON app.agency_id = agency.agency_id
    LEFT JOIN property
    ON app.property_id = property.property_id
    WHERE app.completed IS NULL AND app.agency_id= '$agency_id' GROUP BY app.appointment_id";
    $apppointments_result = mysqli_query($conn, $query);
  ?>
  <?php if ( mysqli_num_rows($apppointments_result) > 0) {?>
  <tbody>
    <?php while ($appointment = mysqli_fetch_assoc( $apppointments_result )) {?>
    <tr>
      <th scope="row"><?php echo $appointment['appointment_id']; ?></th>
      <td><?php echo $appointment['full_name']; ?></td>
      <td><?php echo $appointment['appointment_date']; ?></td>
      <td><?php echo $appointment['type']; ?></td>
      <td><?php echo $appointment['phone']; ?></td>
      <td>
        <form method="POST">
          <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
        <button class="btn btn-outline-info" name="fulfill">Fulfilled</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </tbody>
  <?php } else {?>
    <div class="alert alert-warning" role="alert">
      No appointments yet!
  </div>
    <?php } ?>
</table>
</div>
</div>

<div class="container-md justify-content-center mb-4" style="border: #5e9ed9 2px solid;">
  <div class="row"> 
    <div class="col-6">
  <h5 id="add">Add new property</h5><br/>
  <form method="POST" enctype="multipart/form-data"> <!--  cuz we hv files  -->
  <div class="mb-3">
  <label for="type">Property Type:</label>
  <input class="form-control" type="text" name="type" id="type" required>
</div>
<div class="mb-3">
  <label for="address">Address:</label>
  <input class="form-control" type="text" name="address" id="address" required>
  </div>
  <div class="mb-3">
  <label for="price">Price:</label>
  <input class="form-control" type="text" name="price" id="price" required>
  </div>
  <div class="mb-3">
  <label for="description">description:</label><br/>
  <textarea class="form-control" cols="50" name="description" id="description" required></textarea>
  </div>
  <!-- <label for="for_sale">For Sale:</label>
  <input type="checkbox" name="for_sale" id="for_sale" value="1"><br> -->

  <fieldset>
    <legend>Select if for rent or for sale : </legend>

    <div>
      <input type="radio" id="rent" name="rent_or_sale" value="rent">
      <label for="rent">Rent</label>
    </div>

    <div>
      <input type="radio" id="sell" name="rent_or_sale" value="sale">
      <label for="sell">Sell</label>
    </div>

</fieldset>
  <label for="pics">Pictures</label>
  <input type="file" name="pictures[]" multiple>
  <input type="hidden" name="property_owner" id="property_owner" value="<?php echo  $_SESSION['id']; ?>"><br><br/>

  <button type="submit" value="Add Property" name="add_property" style="color: white; background-color: blue; height: 30px; border: none; padding: 5px; border-radius: 20px;   width:120px;  ">Add property</button><br/><br/>
</form>
 
</div>
</div>
  </div>
<style>
  body {
  margin: 0;
  padding: 0;
}

.sidebar {

  top: -10px;
  /* width: 400px; */
  height: 80vh;
  background-color: rgb(221, 223, 236);
  border-right: 3px solid black;
  float: left;
  overflow-y: auto;
  overflow-x: auto;
}


.content {
  margin-left: 200px; /* Width of the sidebar */
  padding: 20px;
  background-color: #fff;
}
table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
      
    }
    
    th {
      background-color: #f2f2f;
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

.accept-button:hover {
  background-color: #45a049;
  
}

.accept-button:active {
  background-color: #3e8e41;
}
.delete-button {
  padding: 10px 20px;
  background-color: rgb(221, 223, 236);
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
.count{
  color: blue;
}
.card-container {
  
  display: flex;
  flex-direction:  row;
  gap: 30px;
  
}

.card {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  height: 150px;
  margin-bottom: 10px;
  padding-left: 20px;
}

p {
  margin-bottom: 10px;
}

.btn {
  left: 50px;
  width: 100px;
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
}


</style>


</body>
</html>
<?php 
}
}
?>