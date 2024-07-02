<?php 
include 'connection.php';
include 'nav.php';

// Check if p_id is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM PRODUCT WHERE p_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the product details
        $row = $result->fetch_assoc();
    } else {
        echo "No product found with the given ID.";
        exit; // Exit script if no product found
    }

    $sql1="SELECT * FROM CATEGORY";
    $result1=mysqli_query($con,$sql1);

    $stmt->close();
} else {
    echo "No product ID specified.";
    exit; // Exit script if no product ID specified
}

// Close connection
$con->close();
?>

<div class="edit_product">
    <p class="fs-4 text">Edit Product</p>
    <form class="product_form" action="updateProduct.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Product title</label>
            <input type="text" required name="product" class="form-control" id="formGroupExampleInput" placeholder="Enter product title" value="<?php echo htmlspecialchars($row['title']); ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Label</label>
            <textarea class="form-control" required name="label" id="exampleFormControlTextarea1" rows="3"><?php echo$row['label']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Images</label>
            <input class="form-control" name="img" type="file" id="formFile">
            <img src="<?php echo $row['image']; ?>" alt="" style="max-width: 200px;">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Images</label>
            <input class="form-control" name="img" type="file" id="formFile">
            <img src="<?php echo $row['image2']; ?>" alt="" style="max-width: 200px;">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Images</label>
            <input class="form-control" name="img" type="file" id="formFile">
            <img src="<?php if($row['image3']!=NULL){ echo $row['image3'];} ?>" alt="" style="max-width: 200px;">
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
            <label for="formGroupExampleInput" class="form-label">Cost</label>
            <input type="number" required name="cost" class="form-control" id="formGroupExampleInput" placeholder="Enter the amount" value="<?php echo htmlspecialchars($row['price']); ?>">
        </div>
        <input type="hidden" name="product_id" value="<?php echo $row['p_id']; ?>">
        <button type="submit" class="btn btn-primary">Edit Product</button>
    </form>
</div>

<?php
include 'footer.php';
?>
