<?php
session_start();
include('inc/connection.php');

if (isset($_SESSION['id']) || isset($_SESSION['agency_id'])) {
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $property_id = $_POST['property_id'];
        $new_price = $_POST['new_price'];

        // Update the price in the database
        $update_query = "UPDATE property SET price = '$new_price' WHERE property_id = '$property_id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            // Price updated successfully
            header('Location: agency_properties.php?success=true');
            exit();
        } else {
            // Failed to update price
            header('Location: agency_properties.php?success=false');
            exit();
        }
    } else {
        // Redirect to the properties page if the form is not submitted directly
        header('Location: agency_properties.php');
        exit();
    }
} else {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}
?>
