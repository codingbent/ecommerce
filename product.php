<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<section class="four">
    <div class="container text-center">
        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
            <?php
            $query = "SELECT p_id, title, label, image, price FROM product";
            $result = $con->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col m-1">';
                    echo '    <div class="p-3">';
                    echo '        <div class="card m-1">';
                    echo '            <img src="' . $row["image"] . '" class="card-img-top" alt="...">';
                    echo '            <div class="card-body">';
                    echo '                <h5 class="card-title">' . $row["title"] . '</h5>';
                    echo '                <p class="card-text">' . $row["label"] . '</p>';
                    echo '                <p class="card-text">₹' . $row["price"] . '</p>';
                    echo '                <div class="d-flex justify-content-center">';
                    echo '                <button class="btn btn-success" onclick="decrementQuantity(' . $row["p_id"] . ')">-</button>';
                    echo '                <input type="text" id="productQuantity_' . $row["p_id"] . '" class="w-50 text-center" value="0">';
                    echo '                <button class="btn btn-success" onclick="incrementQuantity(' . $row["p_id"] . ')">+</button>';
                    echo '                </div>';
                    echo '                <button class="btn btn-success w-75 mt-2" onclick="addToCart(' . $row["p_id"] . ')" type="button">Add to Cart</button>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found</p>';
            }

            // Close the connection
            $con->close();
            ?>
        </div>
    </div>
</section>

</body>
<script>
    function incrementQuantity(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        quantity++;
        quantityInput.value = quantity;
    }

    function decrementQuantity(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        if (quantity > 0) {
            quantity--;
            quantityInput.value = quantity;
        }
    }

    function addToCart(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        if (quantity > 0) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'addToCart.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert(quantity+' Product added to cart successfully!');
                } else {
                    alert('Error adding product to cart.');
                }
            };
            xhr.send('productId=' + productId + '&quantity=' + quantity);
        } else {
            alert('Please select a quantity greater than 0.');
        }
    }


</script>
</html>
