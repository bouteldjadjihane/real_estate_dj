<?php
session_start(); //session call
include('inc/connection.php');

if (isset($_POST['submit'])) {
    $username = stripcslashes(strtolower($_POST['username']));
    $md5_pass = md5($_POST['password']);
    $username = filter_input(INPUT_POST, 'username');
    //$password = stripcslashes(strtolower($_POST['password']));
    $username = htmlentities(mysqli_real_escape_string($conn, $_POST['username']));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
    if (empty($username)) {
        $user_error = '<p id="error"> please enter username </p>';
    }
    if (empty($password)) {
        $pass_error = '<p id="error"> please enter password </p>';
        include('index.php');
    }
    if (empty($user_error) && empty($pass_error)) {
        if (isset($_POST['agency'])) {
            $sql = "SELECT * FROM agency WHERE agency_name = '$username' AND password = '$password' AND approved = 1";
        } else {
            $sql = "SELECT id, username, password, approved FROM users WHERE username = '$username' AND password = '$password' AND approved='1'";
        }
        $result = mysqli_query($conn, $sql);
        $row_cnt = $result->num_rows;
        if ($row_cnt) {
            $row = mysqli_fetch_assoc($result);
            if (($row['username'] ?? "") || ($row['agency_name'] ?? "") === $username && $row['password'] === $password && $row['approved'] == '1' ) {
                $_SESSION['username'] = ($row['username'] ?? $row['agency_name']);
                $_SESSION['id'] = ($row['id'] ?? $row['agency_id']);
                if ($_SESSION['username'] === "djihane_bouteldja") {
                    header('Location: adminpage.php');
                    exit();
                } elseif ($row['agency_name'] === $username) {
                    header('Location: agency_manager.php');
                    exit();
                } else if ($row['username'] === $username && $row['approved'] == '1'){
                    header('Location: home.php');
                    exit();
                }
            }
        } else {
            $user_error = '<p id="error"> Username not found </p>';
            include('index.php');
            exit();
        }
    }
} else {
    header('Location: home.php');
    exit();
}
?>