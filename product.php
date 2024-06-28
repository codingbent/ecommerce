<?php
// session_start(); // Make sure the session is started
include 'connection.php';
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body> -->
    <style>
         /* .card:hover .fav {
            display: block !important;
            position: absolute;
            top: 50%;
            left: 40%;
        } */
        </style>
<section class="four">
    <div class="container text-center">
        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
            <?php
            $query = "SELECT p_id, title, label, image, price FROM product";
            $result = $con->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col m-1 fav-div">';
                    echo '    <div class="p-3">';
                    echo '        <div class="card m-1">';
                    echo '            <img src="' . $row["image"] . '" class="card-img-top" alt="...">';
                    echo '            <div class="card-body">';
                    echo '                <h5 class="card-title">' . $row["title"] . '</h5>';
                    echo '                <p class="card-text">' . $row["label"] . '</p>';
                    echo '                <p class="card-text">₹' . $row["price"] . '</p>';
                    echo '                <div class="d-flex justify-content-center">';
                    echo '                <button class="btn btn-success" onclick="decrementQuantity(' . $row["p_id"] . ')">-</button>';
                    echo '                <input type="text" id="productQuantity_' . $row["p_id"] . '" class="w-50 text-center mx-1" value="0">';
                    echo '                <button class="btn btn-success" onclick="incrementQuantity(' . $row["p_id"] . ')">+</button>';
                    echo '                </div>';
                    echo '                <button class="btn btn-success w-60 mt-2" onclick="addToCart(' . $row["p_id"] . ')" type="button">Add to Cart</button>';
                    echo '<button class="btn border border-success fav ms-2 mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
</svg></button>';   
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

<!-- </body> -->
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
        var isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;
        
        if (!isLoggedIn) {
            alert("Please log in");
        } else {
            var quantityInput = document.getElementById('productQuantity_' + productId);
            var quantity = parseInt(quantityInput.value);
            if (quantity > 0) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'addToCart.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert(quantity + ' ' + productId + ' Product added to cart successfully!');
                    } else {
                        alert('Error adding product to cart.');
                    }
                };
                xhr.send('productId=' + productId + '&quantity=' + quantity);
            } else {
                alert('Please select a quantity greater than 0.');
            }
        }
    }
</script>
</html>
