<?php
include 'connection.php';
include 'nav.php';
?>
<?php
$a=1;

$sql="SELECT * FROM cart";
$result1=$con->query($sql);
echo ' <p class="fs-4 text p-2 bg-body-secondary">
        Shopping Cart
    </p>';
    echo '        <table class="table">';
    echo '<tr>';
    echo '<th scope="col">S.no</th>';
    echo '<th scope="col">Item</th>';
    echo '<th scope="col">Price</th>';
    echo '<th scope="col">Quantity</th>';
    echo '<th scope="col">Total</th>';
    echo '</tr>';
    
if($result1->num_rows>0){
  while($row1=$result1->fetch_assoc()){
    $query = "SELECT p.title, p.price
              FROM product p
              JOIN cart c ON p.p_id = c.product_id;";
            $result = $con->query($query);
            $row=$result->fetch_assoc();
            echo $row["title"];
            die();
    // $row1["title"]=$row["title"];
    // $row1["price"]=$row["price"];
    echo '<tr>';
    echo '<th scope="row">'. $a++ .'</th>';
    echo '<td>'. $row["title"] .'</td>';
    echo '<td>'. $row["price"] .'</td>';
    echo '<td>'. $row1["quantity"] .'</td>';
    echo '<td>'. $row["price"]*$row1["quantity"] .'</td>';
    echo '</tr>';
  }
}
?>
<?php
include 'footer.php';
?>