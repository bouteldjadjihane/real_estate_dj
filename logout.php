<?php 
session_start();//session call
include('inc/connection.php');
session_unset();
session_destroy();
header('Location:index.php');
?>