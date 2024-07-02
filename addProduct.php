<?php 
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product=$_POST['product'];
    $description=$_POST['description'];
    $img1=$_POST['img1'];
    $img2=$_POST['img2'];
    $img3=$_POST['img3'];
    $cost=$_POST['cost'];
  $stmt = $con->prepare("INSERT INTO product (title, label,image,image,image,price) VALUES (? , ?, ?, ?)");
  $stmt->bind_param("sssd", $product, $description, $img1,$img2,$img3, $cost);
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
    include 'nav.php';
    ?>
    <link rel="stylesheet" href="../main.css">
        <div class="add_product">
            <p class="fs-4 text">Create product</p>
            <form class="product_form"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Product title<sup>*</sup></label>
                    <input type="text" required name="product" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Label<sup>*</sup></label>
                    <textarea class="form-control" required name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image<sup>*</sup></label>
                    <input class="form-control" required name="img1" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" name="img2" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" name="img3" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label  for="inlineFormSelectPref">Category<sup>*</sup></label>
                    <select required class="form-select" id="inlineFormSelectPref">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Cost<sup>*</sup></label>
                    <input type="number" required name="cost" class="form-control" id="formGroupExampleInput" placeholder="Enter the amount">
                </div>
                <p>* required filed</p>
                <button type="submit" class="btn btn-success">Add Product</button>
            </form>
        </div>
    
        <?php
    include 'footer.php';
    ?>