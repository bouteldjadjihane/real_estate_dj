<?php
include('inc/connection.php');

$searchTerm = $_GET['search'];
$sql = "SELECT * FROM agency WHERE agency_name LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    //tchouf kan yexisti wala la 9bel ma tebda texecute lba9i
  } else {
    echo'No matching results';
  }
  while ($row = mysqli_fetch_assoc($result)) {
    echo "sgency name: " . $row['agency_name'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "<hr>";
  }
  mysqli_close($conn);
    
?>