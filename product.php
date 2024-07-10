<?php
include 'connection.php';

// Fetch categories and associated products
$query = "SELECT c.category_name, p.* FROM product p JOIN category c ON p.c_id = c.category_id GROUP BY p.c_id";
$result = $con->query($query);

?>
<style>
    .four .card.m-1 {
        height: 500px;
    }
</style>
<section class="four">
    <div class="container text-center">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-12 mb-3">';
                    echo '<div class="d-flex justify-content-between my-2">';
                    echo '<h4>' . $row['category_name'] . '</h4>'; // Display category name
                    echo '<button class="btn btn-primary" onclick="viewAll(' . $row['c_id'] . ')">View All</button>';
                    echo '</div>';

                    $products_query = "SELECT * FROM product WHERE c_id = " . $row['c_id'] . " LIMIT 4";
                    $products_result = $con->query($products_query);

                    if ($products_result->num_rows > 0) {
                        echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">';
                        while ($product_row = $products_result->fetch_assoc()) {
                            echo '<div class="col mb-4">';
                            echo '    <div class="card h-100">';
                            echo '        <img src="' . $product_row["image"] . '" class="card-img-top" style="height: 200px; object-fit: contain;" alt="Product Image">';
                            echo '        <div class="card-body">';
                            echo '            <h5 class="card-title">' . $product_row["title"] . '</h5>';
                            echo '            <p class="card-text">' . $product_row["label"] . '</p>';
                            echo '            <p class="mb-2 card-text">₹' . $product_row["price"] . '</p>';
                            echo '            <div class="d-flex justify-content-center">';
                            echo '                <button class="btn btn-success" onclick="decrementQuantity(' . $product_row["p_id"] . ')">-</button>';
                            echo '                <input type="text" id="productQuantity_' . $product_row["p_id"] . '" class="w-25 text-center mx-1" value="0">';
                            echo '                <button class="btn btn-success" onclick="incrementQuantity(' . $product_row["p_id"] . ')">+</button>';
                            echo '            </div>';
                            echo '            <button class="btn btn-success w-100 mt-2" onclick="addToCart(' . $product_row["p_id"] . ')" type="button">Add to Cart</button>';
                            echo '            <button class="btn border border-success mt-2" onclick="addToFav(' . $product_row["p_id"] . ')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/></svg></button>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>No products found in this category</p>';
                    }

                    echo '</div>';
                }
            } else {
                echo '<p>No categories found</p>';
            }

            // Close the connection
            $con->close();
            ?>
        </div>
    </div>
</section>

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
                        location.reload();
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

    function addToFav(productId) {
        var isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;

        if (!isLoggedIn) {
            alert("Please log in");
        } else {
            $.ajax({
                url:"addtoFav.php",
                type:"POST",
                data:{proId:productId},
                success: function(res){
                   if(res==1){
                    location.reload();
                    alert("add");
                    return
                   }else{
                    alert("error");
                    return;
                   }
                }
            })
        }
    }

    function viewAll(categoryId) {

        console.log(categoryId);
    }
   
</script>
