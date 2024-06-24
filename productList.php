<?php
include 'adminNav.php';
?>
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
                        echo '            <img src="../images/' . $row["image"] . '" class="card-img-top" alt="...">';
                        echo '            <div class="card-body">';
                        echo '                <h5 class="card-title">' . $row["title"] . '</h5>';
                        echo '                <p class="card-text">' . $row["label"] . '</p>';
                        echo '                <p class="card-text">₹' . $row["price"] . '</p>';
                        echo '                <a href="productEdit.php" class="btn btn-primary">Edit</a>';
                        echo '                <a href="#" class="btn btn-primary">Delete</a>';
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


<?php
include 'footer.php';
?>
