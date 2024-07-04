<?php 
include 'connection.php';
include 'nav.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM PRODUCT WHERE p_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No product found with the given ID.";
        exit;
    }

    $sql1="SELECT * FROM CATEGORY";
    $result1=mysqli_query($con,$sql1);

    $stmt->close();
} else {
    echo "No product ID specified.";
    exit;
}


// // Close connection
// $con->close();
?>

<div class="edit_product">
    <p class="fs-4 text">Edit Product</p>
    <form class="product_form" method="post" action="">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Product title</label>
            <input type="text" required name="title" class="form-control" id="formGroupExampleInput" placeholder="Enter product title" value="<?php echo $row['title']; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Label</label>
            <textarea class="form-control" required name="label" id="exampleFormControlTextarea1" rows="3"><?php echo$row['label']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" disable class="form-label">Images</label>
            <input class="form-control imageinput" name="image1" type="file" id="formFile">
            <img src="<?php echo $row['image']; ?>" alt="" class="image1" style="max-width: 150px;height: 150px;">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Images</label>
            <input class="form-control imageinput" class="image2" name="image2" type="file" id="formFile">
            <img src="<?php echo $row['image2']; ?>" alt="" class="image2" style="max-width: 150px;height: 150px;">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Images</label>
            <input class="form-control imageinput" name="image3" type="file" id="formFile">
            <img src="<?php if($row['image3']!=NULL){ echo $row['image3'];} else {echo NULL;} ?>" alt="" class="image3" style="max-width: 150px;height: 150px;">
        </div>
        <div class="mb-3">
                    <label class="form-label" for="inlineFormSelectPref">Category<sup>*</sup></label>
                    <select required name="category" class="form-select" id="inlineFormSelectPref">
                    <option >Choose...</option>
                    <?php 
                    $a=1;
                    if($result1->num_rows >0){
                        while($row1=$result1->fetch_assoc()){
                            if($row['c_id']==$row1['category_id']){
                                echo $row['c_id'];
                                echo $row1['category_id'];
                            echo '<option selected value=' .$row1['category_id'] .'>' .$row1['category_name'] . '</option>';
                            }
                            else{
                                echo '<option  value=' .$row1['category_id'] .'>' .$row1['category_name'] . '</option>';

                            }
                        }
                    }
                    ?>
                    </select>
                </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Cost</label>
            <input type="number" required name="cost" class="form-control" id="formGroupExampleInput" placeholder="Enter the amount" value="<?php echo $row['price']; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Edit Product</button>
        </form>
</div>
<?php
   if(isset($_POST['submit'])){
    $titlenew = $_POST['title'];
    $labelnew = $_POST['label'];
    $cost = $_POST['cost'];
    $category = $_POST['category'];
    // $img1 = $_FILES['image1'];
    // $img2 = $_FILES['image2'];


    // $target_dir = "/";

    // if (!empty($img1)) {
    //     $target_file1 = $target_dir . basename($img1);
    //     move_uploaded_file($_FILES['image1']['tmp_name'], $target_file1);
    // } else {
    //     $target_file1 = $row['image'];
    // }

    // if (!empty($img2)) {
    //     $target_file2 = $target_dir . basename($img2);
    //     move_uploaded_file($_FILES['image2']['tmp_name'], $target_file2);
    // } else {
    //     $target_file2 = $row['image2'];
    // }

    $updatesql = "UPDATE PRODUCT SET 
                                TITLE='$titlenew',
                                LABEL='$labelnew',
                                price='$cost',
                                c_id='$category'
                                WHERE P_ID=$product_id";

    if(mysqli_query($con, $updatesql)){
        echo '<script>alert("Product Updated");</script>';
    } else {
        echo '<script>alert("Error updating product: '. mysqli_error($con) .'")</script>';
    }

}

?>

<?php
include 'footer.php';
?>