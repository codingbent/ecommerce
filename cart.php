<?php
include 'connection.php';
include 'nav.php';
?>
<?php
$a=1;
$query = "SELECT p_id, title, label, image, price FROM product";
            $result = $con->query($query);
            $row=$result->fetch_assoc();
            // $row["p_id"]=;
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
    
if($result->num_rows>0){
  while($row1=$result1->fetch_assoc()){
    $row1["title"]=$row["title"];
    echo '<tr> '.$row1["title"];
    echo '<th scope="row">'. $a++ .'</th>';
    echo '<td>'. $row["title"] .'</td>';
    echo '<td>'. $row["price"] .'</td>';
    echo '<td>'. $row1["quantity"] .'</td>';
    echo '<td>'. $row["price"]*$row1["quantity"] .'</td>';
  }
}
?>
<?php
include 'footer.php';
?>