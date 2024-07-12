<?php

include 'connection.php';
include 'nav.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$search_text = '';
$c_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search_text'])) {
        $search_text = $_POST['search_text'];
    }

    if (isset($_POST['c_id'])) {
        $c_id = $_POST['c_id'];
        $_SESSION['c_id'] = $c_id; // Set c_id in session
    }
} else {
    // Handle other cases (like navigating back or initial load)
    if (isset($_SESSION['c_id'])) {
        $c_id = $_SESSION['c_id'];
        unset($_SESSION['c_id']); // Clear session variable after use
    }

    // Handle session storage for search_text (if necessary)
    echo "<script>
        if (sessionStorage.getItem('search_text')) {
            var searchText = sessionStorage.getItem('search_text');
            sessionStorage.removeItem('search_text');
            document.write('<form id=\"hidden_form\" method=\"post\" action=\"category.php\"><input type=\"hidden\" name=\"search_text\" value=\"' + searchText + '\"></form>');
            document.getElementById('hidden_form').submit();
        }
    </script>";
}

// Fetch max price for slider
$sqlcost = "SELECT MAX(price) as max_price FROM product";
$resultcost = $con->query($sqlcost);
$rowcost = $resultcost->fetch_assoc();
$maxPrice = $rowcost['max_price'];

// Fetch products based on search or category
if (!empty($search_text)) {
    $sqlproduct = "SELECT * FROM product WHERE title LIKE ?";
    $stmt = $con->prepare($sqlproduct);
    $like_search_text = $search_text . '%';
    $stmt->bind_param("s", $like_search_text);
    $stmt->execute();
    $resultproduct = $stmt->get_result();
} else if (!empty($c_id)) {
    $sqlproduct = "SELECT * FROM product WHERE c_id=?";
    $stmt = $con->prepare($sqlproduct);
    $stmt->bind_param("i", $c_id);
    $stmt->execute();
    $resultproduct = $stmt->get_result();
} else {
    $sqlproduct = "SELECT * FROM product";
    $resultproduct = $con->query($sqlproduct);
}

// Fetch brands for filter
$sql = "SELECT * FROM BRAND";
$result = $con->query($sql);

// Fetch categories for filter
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
                                    echo '<input class="form-check-input me-2" type="checkbox" name="category[]" value="' . $rowcategory['category_id'] . '" id="' . $rowcategory['category_name'] . '"';
                                    if ($c_id == $rowcategory['category_id']) {
                                        echo ' checked';
                                    }
                                    echo '>';                                        
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
                        echo '"<div class="card d-flex flex-row mb-3">';
                        echo '<div><img src="' . $rowproduct['image'] . '" class="card-img-top ms-2 mt-2" alt="..." style="width: 200px;"></div>';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title fs-4 text">' . $rowproduct['title'] . '</h5>';
                        echo '<p class="card-text fs-6 text">' . $rowproduct['label'] . '</p>';
                        echo '<p class="card-text fs-5 text"><b>₹' . $rowproduct['price'] . '</b></p>';
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
</script>
<style>
    .hidden {
        display: none;
    }
</style>
</body>
</html>
