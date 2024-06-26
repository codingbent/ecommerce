<?php 
include 'connection.php';
include 'adminNav.php';
?>
<div class="edit_product">
            <p class="fs-4 text">Edit Product</p>
            <form class="product_form"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Product title</label>
                    <input type="text" required name="product" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Label</label>
                    <textarea class="form-control" required name="label" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Images</label>
                    <input class="form-control" required name="img" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Cost</label>
                    <input type="number" required name="cost" class="form-control" id="formGroupExampleInput" placeholder="Enter the amount">
                </div>
                <button type="submit" class="btn btn-success">Edit Product</button>
            </form>
        </div>
        <?php
        include 'footer.php'
        ?>
