<?php
include 'connection.php';
$id = $_GET['id'];
$sql="SELECT * FROM PRODUCT WHERE p_id=$id";
$result=mysqli_query($con,$sql);

$sql1="SELECT * from cart where product_id=$id";
$result1=mysqli_query($con,$sql1);

if($result->num_rows>0){
    $productDetails=$result->fetch_assoc();
}
if($result1->num_rows>=0){
    $totalProduct=$result1->fetch_assoc();
}else{
    $$totalProduct=0;
}
echo $productDetails['image2'];
die();  

?>
<?php
    include 'nav.php'
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb ms-5 mt-3">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"></li>
  </ol>
</nav>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-xl-6">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $productDetails['image']?>" style="width: 25rem; margin: 10px" class="d-block" alt="...">
                        </div>
                        <?php  if(empty($productDetails['image2'])){
                        // echo '<div class="carousel-item">';
                        // echo '    <img src="$productDetails['image2']" style="width: 25rem; margin: 10px" class="d-block" alt="...">';
                        // echo '</div>';
                        }
                        // ?>
                        <div class="carousel-item">
                            <img src="<?php echo $productDetails['image3']?>" style="width: 25rem; margin: 10px" class="d-block" alt="...">
                        </div>
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
                        echo '    <button class="btn btn-success" onclick="decrementQuantity(' . $productDetails['p_id'] . ')">-</button>';
                        if(@$totalProduct['quantity']!=0){
                        echo '    <input type="text" id="productQuantity_' . $productDetails['p_id'] . '" class="w-50 text-center mx-1" value=' . $totalProduct['quantity'] . '>';}
                        else{
                            echo '    <input type="text" id="productQuantity_' . $productDetails['p_id'] . '" class="w-50 text-center mx-1" value=0>';
                        }
                        echo '    <button class="btn btn-success" onclick="incrementQuantity(' . $productDetails['p_id'] . ')">+</button>';
                        echo '</div>';
                        ?>
                    </div>
                    <div class="mt-3 row justify-content-start g-2 align-items-center">
                        <div class="col-xxl-4 col-lg-4 col-md-5 col-5 d-grid">
                        <?php echo'<button type="button" onclick="addToCart(' . $productDetails['p_id'] . ')" class="btn btn-success">';
                              echo'  <i class="feather-icon icon-shopping-bag me-2"></i>';
                              echo '  Add To Cart';
                            echo '</button>';
                            ?>
                        </div>
                    </div>
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
                            <td>fruits</td>
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
        
        if (!isLoggedIn) {
            alert("Please log in");
        } else {
            var quantityInput = document.getElementById('productQuantity_' + productId);
            var quantity = parseInt(quantityInput.value);
            if (quantity > 0) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'addToCart.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert(quantity + ' ' + productId + ' Product added to cart successfully!');
                    } else {
                        alert('Error adding product to cart.');
                    }
                };
                xhr.send('productId=' + productId + '&quantity=' + quantity);
            } else {
                alert('Please select a quantity greater than 0.');
            }
        }
    }
</script>
</html>