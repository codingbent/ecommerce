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
ECHO '<th scope="col" style="width:25%">Image</th>';
echo '<th scope="col" style="width:25%">Item</th>';
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
    echo '<td><img src="'. $row["image"] .'" style="width:50%;height:50%;"></td>';
    echo '<td>'. $row["title"] . '<br>₹' . $row["price"] . '<br>Total:' . $row["price"] * $row1["quantity"] .'</td>';
    // echo '<td>'. $row["price"] .'</td>';
    // echo '<td>'. $row1["quantity"] .'</td>';
    // echo '<td>₹'. $row["price"] * $row1["quantity"] .'</td>';
    echo '</tr>';
  }
}

echo '</table>';
?>
<?php 
include 'footer.php';
?>
