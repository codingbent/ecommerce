<?php 

include 'connection.php';
include 'nav.php';

if (isset($_GET['id'])){
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM PRODUCT WHERE p_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No product found with the given ID.";
        exit;
}
}
?>