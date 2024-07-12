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
                            echo '<div class="col mb-4"><a href="description.php?id=' . $product_row['p_id'] .'">';
                            echo '    <div class="card h-100">';
                            echo '        <img src="' . $product_row["image"] . '" class="card-img-top" style="height: 200px; object-fit: contain;" alt="Product Image">';
                            echo '        <div class="card-body">';
                            echo '            <h5 class="card-title">' . $product_row["title"] . '</h5>';
                            echo '            <p class="card-text">' . $product_row["label"] . '</p>';
                            echo '            <p class="mb-2 card-text">₹' . $product_row["price"] . '</p>';
                            echo '            </div>';
                            echo '    </div></a>';
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
                    alert("Product Added sucessfuly");
                    return
                   }else{
                    alert("error");
                    return;
                   }
                }
            })
        }
    }

    function viewAll(c_id) {

        $.ajax({
    url: "set_session.php",
    type: "POST",
    data: {c_id: c_id},
    success: function(response){
      // After the session is set, redirect to the category page
      window.location.href = "category.php";
    },
    error: function(xhr, status, error){
      // Handle error
      console.error(error);
    }
  });
  console.log(c_id);
}
   
</script>
