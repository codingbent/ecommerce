
    <?php 
    include 'connection.php';
    include 'nav.php';

    $sqlcost = "SELECT MAX(price) as max_price FROM product";
    $resultcost = $con->query($sqlcost);
    $rowcost = $resultcost->fetch_assoc();
    $maxPrice = $rowcost['max_price'];

    if (isset($_GET['display_id'])){
        $product_id = $_GET['display_id'];
        $sqlproduct = "SELECT * FROM product WHERE p_id= ?";
        $stmt = $con->prepare($sqlproduct);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $resultproduct = $stmt->get_result();
    } else {
        $sqlproduct = "SELECT * FROM product";
        $resultproduct = $con->query($sqlproduct);
    }

    $sql = "SELECT * FROM BRAND";
    $result = $con->query($sql);

    $sqlcategory = "SELECT * FROM category";
    $resultcategory = $con->query($sqlcategory);
    ?>

    <script>
        var maxPrice = <?php echo $maxPrice; ?>;
    </script>

    <p class="fs-2 text ms-5">Filter</p>
    <form id="filter-form">
        <div class="row">
            <aside class="col-sm-3 ms-5">
                <div class="card">
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Brands</h6>
                        </header>
                        <?php
                            if ($result->num_rows > 0) {
                                $c = 0;
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="filter-content ' . ($c >= 5 ? 'hidden' : '') . '">';
                                    echo '<div class="card-body">';
                                    echo '<label class="form-check">';
                                    echo '<input class="form-check-input" type="checkbox" name="brand[]" value="' . $row['brand_id'] . '">' . $row['brand_name'];
                                    echo '<span class="form-check-label"></span>';
                                    echo '</label>';
                                    echo '</div>';
                                    echo '</div>';
                                    $c++;
                                }
                                if ($c > 5) {
                                    echo '<p><a href="" id="show-more-link" class="link-underline-primary ms-3">Show more</a></p>';
                                }
                            }
                        ?>
                    </article>
                </div>
                <div class="card">
                    <article class="card-group-item">
                        <header class="card-header"><h6 class="title">Category</h6></header>
                        <div class="filter-content">
                            <div class="list-group list-group-flush ms-4">
                                <div class="m-2">
                                <?php
                                if ($resultcategory->num_rows > 0) {
                                    while ($rowcategory = $resultcategory->fetch_assoc()) {
                                        echo '<input class="form-check-input me-2" type="checkbox" name="category[]" value="' . $rowcategory['category_id'] . '" id="' . $rowcategory['category_name'] . '">';
                                        echo '<label for="' . $rowcategory['category_name'] . '">' . $rowcategory['category_name'] . '</label><br>';                            
                                    }
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="card">
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Price Range</h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="priceRange">Price Range</label>
                                        <div id="priceRange" class="slider"></div>
                                        <div class="mt-3">
                                            <label for="minValueDisplay">Min: </label>
                                            <span id="minValueDisplay">₹0</span>
                                            <input type="hidden" name="minPrice" id="minPrice" value="0">
                                            <label for="maxValueDisplay" class="ml-3">Max: </label>
                                            <span id="maxValueDisplay">₹<?php echo $maxPrice; ?></span>
                                            <input type="hidden" name="maxPrice" id="maxPrice" value="<?php echo $maxPrice; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <button type="reset" class="btn btn-success mt-2" onclick="resetForm()">Reset</button>
            </aside>
            <main class="col-sm-8">
                <div id="product-container">
                    <?php 
                    if ($resultproduct->num_rows > 0) {
                        while ($rowproduct = $resultproduct->fetch_assoc()) {
                            echo '<div class="card d-flex flex-row mb-3">';
                            echo '<div><img src="' . $rowproduct['image'] . '" class="card-img-top ms-2 mt-2" alt="..." style="width: 200px;"></div>';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title fs-4 text">' . $rowproduct['title'] . '</h5>';
                            echo '<p class="card-text fs-6 text">' . $rowproduct['label'] . '</p>';
                            echo '<p class="card-text fs-5 text"><b>₹' . $rowproduct['price'] . '</b></p>';
                            echo '<div class="m-3"><input type="button" class="btn btn-success" onclick="decrementQuantity(' . $rowproduct["p_id"] . ')" value="-">';
                            echo '<input type="text" id="productQuantity_' . $rowproduct["p_id"] . '" class="w-50 text-center mx-1" value="0">';
                            echo '<input type="button" class="btn btn-success" onclick="incrementQuantity(' . $rowproduct["p_id"] . ')" value="+">';
                            echo '<input type="button" class="btn btn-success w-60 ms-2" onclick="addToCart(' . $rowproduct["p_id"] . ')" value="Add to Cart"></div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </main>
        </div>
    </form>
    <?php
        include 'footer.php';
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const showMoreLink = document.getElementById("show-more-link");
            const hiddenItems = document.querySelectorAll('.hidden');
            let currentIndex = 0;
            const batchSize = 5;

            function showNextBatch() {
                for (let i = currentIndex; i < currentIndex + batchSize && i < hiddenItems.length; i++) {
                    hiddenItems[i].classList.remove('hidden');
                }
                currentIndex += batchSize;
                if (currentIndex >= hiddenItems.length) {
                    showMoreLink.style.display = 'none';
                }
            }

            showMoreLink.addEventListener("click", function(event) {
                event.preventDefault();
                showNextBatch();
            });
        });

        $(document).ready(function() {
            $(".form-check-input, #inputmin, #inputmax").change(function() {
                filterProducts();
            });

            $("#priceRange").slider({
                range: true,
                min: 0,
                max: maxPrice,
                values: [0, maxPrice],
                slide: function(event, ui) {
                    $("#minValueDisplay").text("₹" + ui.values[0]);
                    $("#maxValueDisplay").text("₹" + ui.values[1]);
                    $("#minPrice").val(ui.values[0]);
                    $("#maxPrice").val(ui.values[1]);
                },
                change: function(event, ui) {
                    filterProducts(); 
                }
            });

            $("#minValueDisplay").text("₹" + $("#priceRange").slider("values", 0));
            $("#maxValueDisplay").text("₹" + $("#priceRange").slider("values", 1));

            function filterProducts() {
                var selectedBrands = [];
                $("input[name='brand[]']:checked").each(function() {
                    selectedBrands.push(this.value);
                });

                var selectedCategories = [];
                $("input[name='category[]']:checked").each(function() {
                    selectedCategories.push(this.value);
                });

                var minPrice = $("#priceRange").slider("values", 0);
                var maxPrice = $("#priceRange").slider("values", 1);

                $.ajax({
                    url: 'filter.php',
                    type: 'POST',
                    data: {
                        brands: selectedBrands,
                        categories: selectedCategories,
                        minPrice: minPrice,
                        maxPrice: maxPrice
                    },
                    success: function(response) {
                        $('#product-container').html(response);
                    }
                });
            }

            function resetForm() {
                $("#filter-form")[0].reset();
                $("#priceRange").slider("values", [0, maxPrice]);
                filterProducts();
            }

            window.resetForm = resetForm;
        });

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
                            location.reload();
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
    <style>
        .hidden {
            display: none;
        }
    </style>
</body>
</html>
