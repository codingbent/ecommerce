
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<section class="four">
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
                        echo '                <div class="d-flex justify-content-center">';
                        echo '                <a href="#" class="btn btn-success">-</a>';
                        echo '                <input type="text" id="totalProduct" class="w-50">';
                        echo '                <a href="#" class="btn btn-success">+</a>';
                        echo '                </div>';
                        echo '                <button class="btn btn-success w-75 mt-2" type="button">Add to Cart</button>';
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
      </section>
</body>
</html>
