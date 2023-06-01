<?php
include('inc/connection.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  
  $query = "INSERT INTO agency (agency_name, email, password,approved) VALUES ('$username', '$email', '$password',1)";
  if (mysqli_query($conn, $query)) {
    echo "User added successfully.";
    
  } else {
    echo "Error adding user: " . mysqli_error($conn);
  }
}
?>
