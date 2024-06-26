<?php
include 'connection.php';
include 'nav.php';

$a=1;

$sqlimg="SELECT IMAGE FROM PRODUCT";
$result=$con->query($sqlimg);

?>
<html>
    <body>
        <p class="fs-4 text p-2 bg-body-secondary">
            Shopping Cart
        </p>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Item</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php echo $a++; ?></th>
      <td></td>
      <td>Otto</td>
      <td>@mdo</td>
      <td></td>
    </tr>
    <!-- <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
      <td></td>
    </tr> -->
  </tbody>
</table>
    </body>
</html>
<?php
include 'footer.php';
?>