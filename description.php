<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybby3bZ6rmxa/j9FZpFYG3WEe7xU7arxM0cl6rMFF0CK3wC1T" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="index.js"></script>
</head>
<body>
    <?php
    include 'nav.php'
    ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb ms-5 mt-3">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
  </ol>
</nav>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-xl-6">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://sites.psu.edu/sakshamarorapassionblog/files/2018/04/pack9-1qxsq0v.jpg" style="width: 25rem; margin: 10px" class="d-block" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://sites.psu.edu/sakshamarorapassionblog/files/2018/04/pack9-1qxsq0v.jpg" style="width: 25rem; margin: 10px" class="d-block" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://sites.psu.edu/sakshamarorapassionblog/files/2018/04/pack9-1qxsq0v.jpg" style="width: 25rem; margin: 10px" class="d-block" alt="...">
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
                    <h1 class="mb-1">Lorem ipsum</h1>
                    <div class="fs-4">
                        <span class="fw-bold text-dark">$32</span>
                        <span class="text-decoration-line-through text-muted">$35</span>
                        <span><small class="fs-6 ms-2 text-danger">26% Off</small></span>
                    </div>
                    <hr class="my-6">
                    <div class="mb-5">
                        <button type="button" class="btn btn-outline-secondary">250g</button>
                        <button type="button" class="btn btn-outline-secondary">500g</button>
                        <button type="button" class="btn btn-outline-secondary">1kg</button>
                    </div>
                    <div>
                        <div class="input-group input-spinner">
                            <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity">
                            <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input">
                            <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity">
                        </div>
                    </div>
                    <div class="mt-3 row justify-content-start g-2 align-items-center">
                        <div class="col-xxl-4 col-lg-4 col-md-5 col-5 d-grid">
                            <button type="button" class="btn btn-success">
                                <i class="feather-icon icon-shopping-bag me-2"></i>
                                Add To Cart
                            </button>
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
</html>