<?php
session_start();
include 'connection.php';

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $customerId = $_SESSION['user_id'];
    $sqlInsertCart = "INSERT INTO favorite (user_id, product_id) VALUES ($customerId, $productId )";

    if ($con->query($sqlInsertCart) === TRUE) {
        echo "Product added to favorite successfully";
    } else {
        echo "Error adding product to favorite: " . $con->error;
    }
} else {
    echo "Product ID not received";
}

$con->close();
?>
