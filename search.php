


<?php
include('inc/connection.php');

$searchTerm = $_GET['search'];
$sql = "SELECT * FROM users 
LEFT JOIN apply
ON apply.user_id = users.id
WHERE users.username LIKE '%$searchTerm%' AND apply.user_id = users.id AND apply.approved = '1'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    //tchouf kan yexisti wala la 9bel ma tebda texecute lba9i
  } else {
    echo'No matching results';
  }
  while ($row = mysqli_fetch_assoc($result)) {
    echo "Username: " . $row['username'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "<hr>";
  }
  mysqli_close($conn);
    
?>