<?php 
include '../connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product=$_POST['product'];
    $description=$_POST['description'];
    $img=$_POST['img'];
    $cost=$_POST['cost'];
  $stmt = $con->prepare("INSERT INTO product (title, label,image,price) VALUES (? , ?, ?, ?)");
  $stmt->bind_param("sssd", $product, $description, $img, $cost);
  if ($stmt->execute()) {
      echo "<script>alert('New product inserted successfully');</script>";
  } else {
      echo "<srcipt>alert('Error:');</script> " . $stmt->error;
  }

  $stmt->close();
}
$con->close();
?>


    <?php
    include 'adminNav.php';
    ?>
        <div class="add_product">
            <p class="fs-4 text">Create product</p>
            <form class="product_form"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Product title</label>
                    <input type="text" required name="product" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Label</label>
                    <textarea class="form-control" required name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Images</label>
                    <input class="form-control" required name="img" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Cost</label>
                    <input type="number" required name="cost" class="form-control" id="formGroupExampleInput" placeholder="Enter the amount">
                </div>
                <button type="submit" class="btn btn-success">Add Product</button>
            </form>
        </div>
    


        <?php
    include 'footer.php';
    ?>