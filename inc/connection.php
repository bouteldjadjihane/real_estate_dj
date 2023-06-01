<?php 
    $conn = mysqli_connect('localhost','root','','real_estate_dj');
    if(!$conn){
        die('Error' .mysqli_connect_error());
    }

