<?php
session_start();
include 'connection.php';

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    $customerId = $_SESSION['user_id'];
    $sqlInsertCart = "INSERT INTO cart (customer_id, product_id, quantity) VALUES ($customerId, $productId, 1)";

    if ($con->query($sqlInsertCart) === TRUE) {
        echo "Product added to cart successfully";
    } else {
        echo "Error adding product to cart: " . $con->error;
    }
} else {
    echo "Product ID not received";
}

$con->close();
?>
