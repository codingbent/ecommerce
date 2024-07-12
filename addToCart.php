<?php

session_start();
include 'connection.php';

if (isset($_POST['proId'])&&($_POST['quantity'])) {
    $productId = $_POST['proId'];
    $quantity=$_POST['quantity'];
    $customerId = $_SESSION['user_id'];
    $sqlInsertCart = "INSERT INTO cart (user_id, product_id,quantity) VALUES ($customerId, $productId ,$quantity)";

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
