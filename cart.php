<?php
include 'connection.php';
include 'nav.php';
?>
<?php
$a=1;
$total=0;
$shipping=0;
$sql="SELECT * FROM cart where user_id=$user";
// $sqltotal="SELECT SUM(*) FROM CART WHERE user_id=$user";
// $resulttotal=$con->query($sqltotal);
// $rowtotal=$resulttotal->num_rows;
// echo $rowtotal;
// die();
$result1=$con->query($sql);
$row6 = $result1->num_rows;
if($row6 > 0){
    echo '<p class="container fs-4 text p-2 bg-body-secondary">Your Bag</p>';
    echo '<div class="d-flex">';
        echo '<div class="col-sm-8">';
            echo '<table class="table">';
                echo '<tr>';
                    echo '<th scope="col" style="width:5%">S.no</th>';
                    echo '<th scope="col" style="width:20%">Image</th>';
                    echo '<th scope="col" style="width:20%">Item</th>';
                    echo '<th scope="col" style="width:20%">Price</th>';
                    echo '<th scope="col" style="width:5%">Action</th>';
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
                        echo '<td><img src="'. $row["image"] . '"style="width:50%;height:50%;"><br><h4 class="mt-3">'. $row["title"] . '</h4></td>';
                        echo '<td><button class="btn btn-light decrement" onclick="decrementQuantity(' . $product_id . ')">-</button><input type="text" id="productQuantity_' . $product_id . '" class="w-25 text-center mx-1 border border-0" value="' . $row1['quantity'] .'"><button class="btn btn-light" onclick="incrementQuantity(' . $product_id . ')">+</button></td>';
                        echo '<td><h5 class="mt-2">₹' . $row["price"] . '</h5></td>';
                        $total+=$row1['quantity']*$row['price'];
                        $shipping=$total*0.01;
                        echo '<td><button class="btn btn-light" onclick="removeProduct(' . $row1['cart_id'] . ')"><i class="fa-solid fa-xmark"></i></button';
                        echo '</tr>';
                    }
                }
            echo '</table>';
        echo '</div>';
        echo '<div class="col-sm-4">';
            echo '<table class="table">';
                echo '<thead>';
                    echo '<tr>';
                        echo '<th scope="col">Order Summary</th>';
                        echo '<th scope="col"></th>';
                    echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                    echo '<tr>';
                        echo '<td scope="row">' . $a  .' Products </td>';
                        echo '<td>₹'. $total .'</td>';
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td>Shipping</td>';
                        echo '<td>₹' . $shipping .'</td>';
                    echo '</tr>';
                    echo '<tr class="">';
                        echo '<td>Total</td>';
                        echo '<td>₹' . $total+$shipping .'</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><a href="index.php"><button class="btn btn-success w-100">Continue Shopping</button></a></td>';
                    echo '<td><button class="btn btn-success w-100">Check Out</button></td>';
                    echo '</tr>';
                echo '</tbody>';
            echo '</table>';
        echo '</div>';
    echo '</div>';
}
else{
    echo '<p>continue Shopping</p>';
}
?>
<script>
    function incrementQuantity(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        quantity++;
        quantityInput.value = quantity;
        location.reload();
        updateCart(productId);
    }

    function decrementQuantity(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        if (quantity > 0) {
            quantity--;
            quantityInput.value = quantity;
        }
        location.reload();
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
function removeProduct(cartId){ 
    location.href="removeproductCart.php?cartId="+cartId;
}
</script>
<?php 
include 'footer.php';
?>
