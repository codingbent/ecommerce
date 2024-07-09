<?php
// Include database connection
include 'connection.php';

// Initialize variables to store filter conditions
$whereClause = "";
$parameters = array();

// Process selected brands
if (isset($_POST['brands']) && !empty($_POST['brands'])) {
    $brands = $_POST['brands'];
    $brandPlaceholders = str_repeat('?,', count($brands) - 1) . '?';
    $whereClause .= " AND brand_id IN ($brandPlaceholders)";
    $parameters = array_merge($parameters, $brands);
}

// Process selected categories
if (isset($_POST['categories']) && !empty($_POST['categories'])) {
    $categories = $_POST['categories'];
    $categoryPlaceholders = str_repeat('?,', count($categories) - 1) . '?';
    $whereClause .= " AND c_id IN ($categoryPlaceholders)";
    $parameters = array_merge($parameters, $categories);
}

// Process price range
if (isset($_POST['minPrice']) && isset($_POST['maxPrice'])) {
    $minPrice = intval($_POST['minPrice']);
    $maxPrice = intval($_POST['maxPrice']);
    $whereClause .= " AND price BETWEEN ? AND ?";
    $parameters[] = $minPrice;
    $parameters[] = $maxPrice;
}

// Prepare SQL statement for filtered products
$sql = "SELECT * FROM product WHERE 1 $whereClause";
$stmt = $con->prepare($sql);

// Bind parameters dynamically
if (!empty($parameters)) {
    $types = str_repeat('s', count($parameters)); // Assuming all parameters are strings
    $stmt->bind_param($types, ...$parameters);
}

// Execute SQL query
$stmt->execute();
$result = $stmt->get_result();

// Build HTML for filtered products
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card d-flex mb-2">';
        echo '<div><img src="' . $row['image'] . '" class="card-img-top ms-2 mt-2" alt="..." style="width: 150px;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title fs-4 text">' . $row['title'] . '</h5>';
        echo '<p class="card-text fs-6 text">' . $row['label'] . '</p>';
        echo '<p class="card-text fs-5 text"><b>₹' . $row['price'] . '</b></p></div>';
        echo '<div class="m-3"><input type="button" class="btn btn-success" onclick="decrementQuantity(' . $row["p_id"] . ')" value="-">';
        echo '<input type="text" id="productQuantity_' . $row["p_id"] . '" class="w-50 text-center mx-1" value="0">';
        echo '<input type="button" class="btn btn-success" onclick="incrementQuantity(' . $row["p_id"] . ')" value="+">';
        echo '<input type="button" class="btn btn-success w-60 ms-2" onclick="addToCart(' . $row["p_id"] . ')" value="Add to Cart"></div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No products found.</p>';
}

// Close prepared statement and database connection
$stmt->close();
$con->close();
?>
