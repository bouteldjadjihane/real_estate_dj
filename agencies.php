<?php
session_start();//session call
include('inc/connection.php');

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $user = $_SESSION['username']; //if he insert a correct id n username f login hothom hna fi variable
    $count= mysqli_query($conn,"SELECT COUNT(*) AS userCount FROM agency");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agencies</title>
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
                        <a class="nav-link active" aria-current="page" href="adminpage.php" style="color: black;" >Back</a>
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

             <div class="form-wrapper">
              <form method="GET" action="search_agency.php">
                  <input type="text" name="search" placeholder="Enter your search term" >
                  <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
             </div>
            <h1 style="margin-left: 5%">All the agencies:</h1>
 <div style="display: flex; gap: 20px; margin: 0 auto; justify-content: center;">
    <table>
    <tr>
      <th>Agency name</th>
      <th>email</th>
      <th>city</th>
      <th>mobile</th>
      <th><div style="color: red;">Delete</div></th>
    </tr>
    <tr>
    <?php
    // Fetch data from the users table
    $sql = "SELECT * FROM agency WHERE approved = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["agency_name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["mobile"] . "</td>";
        echo '<td><a  href="delete_agency.php?agency_id='.$row['agency_id'].'"><button name="delete-button" class="delete-button"><i class="fa-sharp fa-solid fa-trash" style="color: #db334c;"></i></button></a></form></td>';
        echo "</tr>";
      
      }
    } else {
      echo "No agencies found.";
    }
    
    // Close the database connection
    // $conn->close();
    ?>

  </table>
<br/><br/>
<div>
<h5 style="left: 800px;"> Add a new agency:<br/></h5>
  <form method="POST" action="add_agency.php" class="add-property">
  <input type="text" name="username" placeholder="agency name" required><br/>
  <input type="email" name="email" placeholder="Email" required><br/>
  <input type="password" name="password" placeholder="Password" required><br/>
  <button type="submit"><i class="fa-solid fa-plus" style="color: blue;"></i> Add agency </button>
</form>
</div>

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
.form-wrapper {
  width: 1200px;
  display: flex;
  justify-content: center;
  margin: 0 auto;
}

.form-wrapper form input, .form-wrapper button {
  padding: 1rem;
  border-radius: 20px;
}
.form-wrapper button {
  width: 80px;
  background: #de7896;
  border: 1px solid #de7896;
}
.add-property input, .add-property button {
  padding: 1rem;
  margin: 0 1rem;
}
.add-property button {
  margin-top: 1rem
}
</style>



</body>

</html>
<?php 
}

?>