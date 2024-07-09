<?php
include 'connection.php';

$brands = isset($_POST['brands']) ? $_POST['brands'] : [];
$categories = isset($_POST['categories']) ? $_POST['categories'] : [];
$minPrice = isset($_POST['minPrice']) && $_POST['minPrice'] !== '' ? (int)$_POST['minPrice'] : 0;
$maxPrice = isset($_POST['maxPrice']) && $_POST['maxPrice'] !== '' ? (int)$_POST['maxPrice'] : 1000000;

// Initialize SQL query
$sql = "SELECT * FROM product WHERE price BETWEEN $minPrice AND $maxPrice";

// Add brand filters if any
if (!empty($brands)) {
    if (count($brands) > 1) {
        $brandsList = implode(",", array_map('intval', $brands));
        $sql .= " AND brand_id IN ($brandsList)";
    } else {
        $brandId = intval($brands[0]);
        $sql .= " AND brand_id = $brandId";
    }
}

// Add category filters if any
if (!empty($categories)) {
    if (count($categories) > 1) {
        $categoriesList = implode(",", array_map('intval', $categories));
        $sql .= " AND c_id IN ($categoriesList)";
    } else {
        $categoryId = intval($categories[0]);
        $sql .= " AND c_id = $categoryId";
    }
}

// Execute the query
$resultproduct = $con->query($sql);

if (!$resultproduct) {
    die('Error: ' . $con->error);
}

// Display the products
if ($resultproduct->num_rows > 0) {
    while ($rowproduct = $resultproduct->fetch_assoc()) {
        echo '<div class="card d-flex mb-2">';
        echo '<img src="' . $rowproduct['image'] . '" class="card-img-top ms-2 mt-2" alt="..." style="width: 150px;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title fs-4 text">' . $rowproduct['title'] . '</h5>';
        echo '<p class="card-text fs-6 text">' . $rowproduct['label'] . '</p>';
        echo '<p class="card-text fs-5 text"><b>₹' . $rowproduct['price'] . '</b></p></div>';
        echo '<div class="m-3"><input type="button" class="btn btn-success" onclick="decrementQuantity(' . $rowproduct["p_id"] . ')" value="-">';
        echo '<input type="text" id="productQuantity_' . $rowproduct["p_id"] . '" class="w-50 text-center mx-1" value="0">';
        echo '<input type="button" class="btn btn-success" onclick="incrementQuantity(' . $rowproduct["p_id"] . ')" value="+">';
        echo '<input type="button" class="btn btn-success w-60 ms-2" onclick="addToCart(' . $rowproduct["p_id"] . ')" value="Add to Cart"></div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No products found matching the criteria.</p>';
}
?>
