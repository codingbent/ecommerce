<?php
session_start();
include '../connection.php';

// Count total orders
$sqlOrders = "SELECT COUNT(*) AS total_orders FROM ORDER_ITEM";
$resultOrders = $con->query($sqlOrders);
$totalOrders = 0;

if ($resultOrders && $resultOrders->num_rows > 0) {
    $rowOrders = $resultOrders->fetch_assoc();
    $totalOrders = $rowOrders['total_orders'];
}

// Count total products
$sqlProducts = "SELECT COUNT(*) AS total_products FROM product"; // Assuming 'products' is your products table name
$resultProducts = $con->query($sqlProducts);
$totalProducts = 0;

if ($resultProducts && $resultProducts->num_rows > 0) {
    $rowProducts = $resultProducts->fetch_assoc();
    $totalProducts = $rowProducts['total_products'];
}

// Count total users
$sqlUsers = "SELECT COUNT(*) AS total_users FROM customer"; // Assuming 'customer' is your users/customers table name
$resultUsers = $con->query($sqlUsers);
$totalUsers = 0;

if ($resultUsers && $resultUsers->num_rows > 0) {
    $rowUsers = $resultUsers->fetch_assoc();
    $totalUsers = $rowUsers['total_users'];
}

// Calculate total sales
$sqlTotalSales = "SELECT SUM(order_item.quantity * order_item.price) AS total_sales
FROM sales
JOIN order_item ON sales.order_id = order_item.order_id;
"; // Assuming 'sales' is your sales table name
$resultTotalSales = $con->query($sqlTotalSales);
$totalSales = 0;

if ($resultTotalSales && $resultTotalSales->num_rows > 0) {
    $rowTotalSales = $resultTotalSales->fetch_assoc();
    $totalSales = $rowTotalSales['total_sales'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../main.css">
    <title>Bootstrap Example</title>
  </head>
</head>
<body>
<?php
include 'adminNav.php';
?>
<p class="fs-3 text m-3">DashBoard</p>
<div class="container px-4 text-center">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3">
      <p>Total Sales</p>
      <p><?php echo $totalSales;?></p>
     </div>
    </div>
    <div class="col">
      <div class="p-3">
        <p>Total Order</p>
        <p>
        <?php echo $totalOrders; ?>
        </p>
      </div>
    </div>
    <div class="col">
     <div class="p-3">
      <p>Total Products</p>
      <p><?php echo $totalProducts;?></p>
    </div>
    </div>
  </div>
</div>
<?php
include 'footer.php';
?>
</body>
</html>
