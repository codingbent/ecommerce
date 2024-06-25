<?php
include 'nav.php';
?>
<script>
function remove(title){
    if(confirm("Do you want to remove the product "+title+"?")){
        <?php 
        $title=title;
        $sql="SELECT p_id from product where title="$title"";
        $result=$con->query($sql);
        ?>
        alert('product removed');
    }
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="mx-5">
        <div class="title d-flex justify-content-between ">
            <p class="fs-3 text">Product Grid</p>
            <a href="addProduct.php" class=" fs-3 text btn btn-success">Add Product</a>
        </div>

        <div class="container text-center">
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                <?php
                // Fetch product details from database
                $query = "SELECT title, label, image, price FROM product";
                $result = $con->query($query);

                // Check if there are products in the database
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col m-1">';
                        echo '    <div class="p-3">';
                        echo '        <div class="card m-1" ">';
                        echo '            <img src="images/' . $row["image"] . '" class="card-img-top" alt="...">';
                        echo '            <div class="card-body">';
                        echo '                <h5 class="card-title">' . $row["title"] . '</h5>';
                        echo '                <p class="card-text">' . $row["label"] . '</p>';
                        echo '                <p class="card-text">₹' . $row["price"] . '</p>';
                        echo '                <a href="productEdit.php" class="btn btn-primary">Edit</a>';
                        echo '                <a onclick="remove(\'' . $row["title"] . '\')" class="btn btn-primary">Delete</a>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No products found</p>';
                }

                // Close the connection
                $con->close();
                ?>
            </div>
        </div>
    </div>
            </body>
            </html>
<?php
include 'footer.php';
?>
