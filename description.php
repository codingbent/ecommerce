<?php
include 'connection.php';
include 'nav.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['p_id'])) {
        $p_id = $_POST['p_id'];
        $_SESSION['p_id'] = $p_id; // Set p_id in session
    } else {
        die("p_id not received");
    }
}

// Check if p_id is in session
if (isset($_SESSION['p_id'])) {
    $p_id = $_SESSION['p_id'];

    // Fetch product details
    $sqlproduct = "SELECT * FROM product WHERE p_id=?";
    $stmt = $con->prepare($sqlproduct);
    $stmt->bind_param("i", $p_id);
    $stmt->execute();
    $resultproduct = $stmt->get_result();

    // Fetch cart details
    $sqlcart = "SELECT * FROM cart WHERE product_id=?";
    $stmt = $con->prepare($sqlcart);
    $stmt->bind_param("i", $p_id);
    $stmt->execute();
    $resultcart = $stmt->get_result();

    // Handle errors in SQL queries
    if (!$resultproduct) {
        die("Error in product query: " . $con->error);
    }

    // Fetch product details if available
    if ($resultproduct->num_rows > 0) {
        $productDetails = $resultproduct->fetch_assoc();
    } else {
        $productDetails = null; // Handle case where product is not found
    }

    // Fetch cart details if available
    if ($resultcart->num_rows > 0) {
        $totalProduct = $resultcart->fetch_assoc();
    } else {
        $totalProduct = 0; // Handle case where cart entry is not found
    }

    // Example of using the fetched data
    if ($productDetails) {
        // Display or process $productDetails
        // Example: echo $productDetails['product_name'];
    }

    if ($totalProduct) {
        // Display or process $totalProduct
        // Example: echo $totalProduct['quantity'];
    }

} else {
    echo "p_id not found in session";
}
?>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-xl-6">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $productDetails['image']?>" style="width: 25rem; margin: 10px" class="d-block" alt="...">
                        </div>
                        <?php
                        if($productDetails['image2']!=0){
                            echo ' <div class="carousel-item">';
                            echo '<img src="' . $productDetails['image2'] . '" style="width: 25rem; margin: 10px" class="d-block" alt="...">';
                            echo '</div>';
                        }
                        if($productDetails['image3']!=0){
                            echo ' <div class="carousel-item">';
                            echo '<img src="' . $productDetails['image3'] . '" style="width: 25rem; margin: 10px" class="d-block" alt="...">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-5 col-xl-6">
                <div class="ps-lg-10 mt-6 mt-md-0">
                    <h1 class="mb-1"><?php echo $productDetails['title'] ?></h1>
                    <div class="fs-4">
                        <span class="fw-bold text-dark"><?php echo '₹' .$productDetails['price'] . ''?></span>
                        <!-- <span class="text-decoration-line-through text-muted"><?php echo $productDetails['original_price'] ?></span>
                        <span><small class="fs-6 ms-2 text-danger"><?php echo $productDetails['discount'] ?></small></span> -->
                    </div>
                    <hr class="my-6">
                    <!-- <div class="mb-5">
                        <button type="button" class="btn btn-outline-secondary">250g</button>
                        <button type="button" class="btn btn-outline-secondary">500g</button>
                        <button type="button" class="btn btn-outline-secondary">1kg</button>
                    </div> -->
                    <div>
                        <?php
                        echo '<div class="input-group input-spinner">';
                        echo '    <button class="btn btn-light" onclick="decrementQuantity(' . $productDetails['p_id'] . ')">-</button>';
                        echo '    <input type="text" id="productQuantity_' . $productDetails['p_id'] . '" class="w-25 border-0 text-center mx-1 input" value=0>';
                        echo '    <button class="btn btn-light" onclick="incrementQuantity(' . $productDetails['p_id'] . ')">+</button>';
                        echo '</div>';
                        ?>
                    </div>
                    <div class="mt-3 row justify-content-between g-2 align-items-center d-flex">
                        <!-- <div class="col-xxl-4 col-lg-4 col-md-5 col-5 d-grid"> -->
                        <?php echo'<div class=""><button type="button" class="btn btn-success w-25 ms-3 me-3">';
                              echo'  <i class="feather-icon icon-shopping-bag me-2"></i>';
                              echo ' Buy Now';
                            echo '</button>';
                            echo'<button type="button" onclick="addToFav(' . $productDetails['p_id'] . ')" class="btn btn-success w-30 ms-2">';
                              echo'  <i class="feather-icon icon-shopping-bag me-2"></i>';
                              echo '  Add To Favorite';
                            echo '</button></div>';
                            echo'<button type="button" onclick="addToCart(' . $productDetails['p_id'] . ')" class="btn btn-success w-50 ms-4">';
                            echo'  <i class="feather-icon icon-shopping-bag me-2"></i>';
                            echo '  Add To Cart';
                          echo '</button>';
                            ?>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="col-md-4 col-4">
                        <a class="btn btn-light" href="#" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Compare">
                            <i class="bi bi-arrow-left-right"></i>
                        </a>
                        <a class="btn btn-light" href="shop-wishlist.html" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Wishlist">
                            <i class="feather-icon icon-heart"></i>
                        </a>
                    </div> -->
                </div>
                <hr class="my-6">
                <div>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td>Product Code</td>
                            <td>FBB00255</td>
                        </tr>
                        <tr>
                            <td>Availability</td>
                            <td>In Stock</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td><?php  ?></td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td>
                                <small>01 days Shipping
                                    <span class="text-muted">( Free pickup today)</span>
                                </small>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mt-8">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Share</a>
                        <ul class="dropdown-menu" style>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-facebook me-2"></i>Facebook</a></li>
                            <li><a class="dropdown-item" href="#">Twitter</a></li>
                            <li><a class="dropdown-item" href="#">Instagram</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-lg-14 mt-8">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="false" tabindex="-1"> Product Details </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="false" tabindex="-1"> Information </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="false" tabindex="-1"> Reviews </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="false" tabindex="-1"> Seller Info </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
                        <div class="my-8">
                            <div class="mb-5">
                                <h4 class="mb-1">Nutrient Value & Benefits</h4>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa iste quis temporibus laboriosam recusandae iusto inventore qui, cum eius quod, earum nisi modi quisquam doloribus consectetur excepturi incidunt eligendi. Sequi?</p>
                            </div>
                            <div class="mb-5">
                                <h5 class="mb-1">Storage Tips</h5>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt explicabo magni veniam voluptatum doloribus ullam nihil expedita numquam delectus odit.</p>
                            </div>
                            <div class="mb-5">
                                <h5 class="mb-1">Unit</h5>
                                <p class="mb-0">3 units</p>
                            </div>
                            <div class="mb-5">
                                <h5 class="mb-1">Seller</h5>
                                <p class="mb-0">DMart Pvt. LTD</p>
                            </div>
                            <div>
                                <h5 class="mb-1">Disclaimer</h5>
                                <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam, provident?</p>
                        </div>
                    </div>…</div>
            </div>
        </div>
    </div>
</section>
</body>
<?php
include 'footer.php';
?>
<script>
function incrementQuantity(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        quantity++;
        quantityInput.value = quantity;
    }

    function decrementQuantity(productId) {
        var quantityInput = document.getElementById('productQuantity_' + productId);
        var quantity = parseInt(quantityInput.value);
        if (quantity > 0) {
            quantity--;
            quantityInput.value = quantity;
        }
    }

    function addToCart(productId) {
        var isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;
        var productID = <?php echo $productDetails['p_id']; ?>;
var quantity = document.getElementById('productQuantity_' + productID).value;
console.log(quantity);


        if (!isLoggedIn) {
            alert("Please log in");
        } else {
            $.ajax({
                url:"addtoCart.php",
                type:"POST",
                data:{proId:productId, quantity:quantity},
                success: function(res){
                if(res==1){
                    alert("Product added to cart successfully");
                    return
                }else{
                    alert("error");
                    return;
                }
                }
            })
        }
}
function addToFav(productId){
    var isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;
        var productID = <?php echo $productDetails['p_id']; ?>;
        if (!isLoggedIn) {
            alert("Please log in");
        } else {
            $.ajax({
                url:"addtoFav.php",
                type:"POST",
                data:{proId:productId},
                success: function(res){
                if(res==1){
                    alert("Product added to Favorite successfully");
                    return
                }else{
                    alert("error");
                    return;
                }
                }
            })
        }
}

</script>
</html>