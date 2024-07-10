<?php

session_start();
include 'connection.php';

if (isset($_POST['proId'])) {
    $productId = $_POST['proId'];
    $customerId = $_SESSION['user_id'];
    $sqlInsertCart = "INSERT INTO favorite (user_id, product_id) VALUES ($customerId, $productId )";

    if ($con->query($sqlInsertCart) === TRUE) {
        echo 1;
        die();
    } else {
        echo 2;
        die();
    }
} else {
    echo "Product ID not received";
}

$con->close();
?>
