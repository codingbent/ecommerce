<?php
include 'connection.php';
include 'nav.php';
?>
<?php
$a=1;
$sql="SELECT * FROM cart where user_id=$user";
$result1=$con->query($sql);
echo ' <p class="fs-4 text p-2 bg-body-secondary">
        Shopping Cart
    </p>';
echo '<table class="table">';
echo '<th scope="col" style="width:5%">S.no</th>';
ECHO '<th scope="col" style="width:20%">Image</th>';
echo '<th scope="col" style="width:20%">Item</th>';
echo '<th scope="col" style="width:5%">Action</th>';
// echo '<th scope="col">Price</th>';
// echo '<th scope="col">Quantity</th>';
// echo '<th scope="col">Total</th>';
echo '</tr>';

if($result1->num_rows > 0){
  while($row1 = $result1->fetch_assoc()){
    $product_id = $row1["product_id"];
    $query = "SELECT p.title, p.price, p.image
              FROM product p
              JOIN cart c ON p.p_id = $product_id;";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    echo '<tr>';
    echo '<th scope="row">'. $a++ .'</th>';
    echo '<td><img src="'. $row["image"] . '"style="width:50%;height:50%;"><br><button class="btn btn-success decrement" onclick="decrementQuantity(' . $product_id . ')">-</button><input type="text" id="productQuantity_' . $product_id . '" class="w-50 text-center mx-1" value="' . $row1['quantity'] .'"><button class="btn btn-success" onclick="incrementQuantity(' . $product_id . ')">+</button></td>';
    echo '<td><h3>'. $row["title"] . '</h3><h5>₹' . $row["price"] . '</h5><h5>Total: ₹' . $row["price"] * $row1["quantity"] . '</td>';
    echo '<td><button class="btn btn-success" onclick="remove(' . $row1['cart_id'] . ')">Remove</button';
    // echo '<td>'. $row["price"] .'</td>';
    // echo '<td>'. $row1["quantity"] .'</td>';
    // echo '<td>₹'. $row["price"] * $row1["quantity"] .'</td>';
    echo '</tr>';
  }
}

echo '</table>';
?>
<script>
    function incrementQuantity(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        quantity++;
        quantityInput.value = quantity;
        updateCart(productId);
    }

    function decrementQuantity(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        if (quantity > 0) {
            quantity--;
            quantityInput.value = quantity;
        }
        updateCart(productId);
    }

    function updateCart(productId) {
        var isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;
        
        if (!isLoggedIn) {
            alert("Please log in");
        } else {
            var quantityInput = document.getElementById('productQuantity_' + productId);
            var quantity = parseInt(quantityInput.value);
            if (quantity > 0) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'updateCart.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        // alert(quantity +''+ productId+' Product added to cart successfully!');
                    } else {
                        alert('Error adding product to cart.');
                    }
                };
                xhr.send('productId=' + productId + '&quantity=' + quantity);
            } else {
              document.getElmentBy
                alert('Please select a quantity greater than 0.');
            }
        }
    }
    function product(id){
        
    console.log(id);
}
function remove(cartId){
if(confirm("DO you want to detele this product")){
    removeProduct(cartId)
}
}
function removeProduct(cartId){ 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'removeProduct.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert(' Product removed from cart successfully!');
                        location.reload();
                    } else {
                        // alert('Error adding product to cart.');
                    }
                };
                xhr.send('cartId=' + cartId);
}
</script>
<?php 
include 'footer.php';
?>
