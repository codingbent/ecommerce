<?php
session_start();
include 'connection.php';

if (isset($_POST['productId'])&&isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $customerId = $_SESSION['user_id'];
    $sqlInsertCart = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($customerId, $productId,$quantity )";

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
