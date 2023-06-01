<?php
session_start();
include('inc/connection.php');

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    $id = $_SESSION['id'];
    $user = $_SESSION['username'];
} else {
    header('Location: index.php');
    exit();
}
?>
