<?php
session_start();//session call
include('inc/connection.php');

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $user = $_SESSION['username']; //if he insert a correct id n username f login hothom hna fi variable
    $count= mysqli_query($conn,"SELECT COUNT(*) AS userCount FROM agency");
    
    $info = mysqli_query($conn,"SELECT * FROM users WHERE username ='$user'");//beh ydir ta3 luser adeka brk
    while($data = mysqli_fetch_array($info)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
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
                    <li class="nav-item">
                       <a href="logout.php" style="color: red; " >Log out</a>
                      </li>
                  </div>
                </div>
              </nav></header><br/><br/>

<div style=" position: relative; top: 50px; font-size: 20px; color: bdarkblue ; display: flex; justify-content: center; transition: width 0.3s ease;  " ><b>Welcome Admin Page  <i class="fa-solid fa-user-lock"></i></b></div>
<div class="sidebar">
    <div style=" position: relative; top: 20px; color: darkblue;" ><h5>Join Requests :</h5></div></br>
    <table>
    <tr>
      <th>name</th>
      <th>email</th>
      <th><div style=" color: rgb(26, 176, 96); " >accept</div></th>
      <th><div style=" color: red; ">delete</div></th>
    </tr>
    <tr>

    <?php
    
  
    // Fetch data from the agency table
    $sql = "SELECT * FROM agency WHERE approved = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["agency_name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";

        echo '<td><a  href="approve_agency.php?agency_id='.$row['agency_id'].'"><i class="fa-solid fa-user-plus "></i></a></td>';
        echo '<td><a  href="delete_agency.php?agency_id='.$row['agency_id'].'"><button name="delete-button" class="delete-button"><i class="fa-sharp fa-solid fa-trash" style="color: #db334c;"></i></button></a></form></td>';
        echo "</tr>";
      }
    } else {
      echo "No requests found.";
    }
    
    // Close the database connection
    $conn->close();
    ?>

  </table>
  </div>
  <div class="content">
    <!-- Your main content goes here -->
    <div class="container" style="position: relative; top: 80px; left:70px;  width: 650px; height: 150px; padding: 60px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4); background-color: #f4c8e8; " >
  <div class="row">
    <div class="col">
      <?php
include('inc/connection.php');

// Query to count the number of agency
$sql = "SELECT COUNT(*) AS userCount FROM agency WHERE approved = 1";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userCount = $row['userCount'];
    echo '<b><i class="fa-solid fa-house-user"></i></b> Total agency : <span class="user-count" style="color: blue;font-weight: bold;" >' . $userCount.'</span>';
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
    </div>
    <div class="col">
      
    </div>
    <div class="col">
    <?php
include('inc/connection.php');

// Query to count the number of agency
// $sql = "SELECT COUNT(*) AS userCount FROM agency WHERE approved = 0";
// $result = mysqli_query($conn, $sql);

// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     $userCount = $row['userCount'];
//     echo '<b><i class="fa-solid fa-person-circle-plus"></i></b> Total requests :  <span class="user-count" style="color: blue;font-weight: bold;" >' .$userCount.'</span>';
// } else {
//     echo "Error: " . mysqli_error($conn);
// }

// mysqli_close($conn);
?>
    </div>
    <!-- <div  style="position: relative; left: 190px; " ><br/> -->
    <?php
// include('inc/connection.php');

// // Query to count the number of agency
// $sql = "SELECT COUNT(*) AS count_users FROM users WHERE approved = 1";
// $result = mysqli_query($conn, $sql);

// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     $userCount = $row['count_users'];
//     echo '<b><i class="fa-solid fa-user-group"></i></b> Total users : <span class="user-count" style="color: blue;font-weight: bold;" >' . $userCount.'</span>';
// } else {
//     echo "Error: " . mysqli_error($conn);
// }

// mysqli_close($conn);
?>
    </div>
  </div><br/><br/><br/><br/>
  <div class="card-container">
  <div class="card">
  <p>click here to see all the agency </p>
  <a href="agencies.php" ><button class="btn">agencies</button></a>
</div>

<div class="card">
  <p>This is the content of Card 2.</p>
  <button class="btn">Button 2</button>
</div>

</div>
</div>
  </div>
<style>
  body {
  margin: 0;
  padding: 0;
}

.sidebar {
  position: relative;
  z-index: 999;
  top: -10px;
  width: 400px;
  height: 500px;
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
  height: 100px;
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