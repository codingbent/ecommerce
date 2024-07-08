<?php 
include 'connection.php';
include 'nav.php';

$sql="SELECT * FROM BRAND";
$result=$con->query($sql);

    $sqlproduct = "SELECT * FROM product";
    $resultproduct = $con->query($sqlproduct);

    $sqlcategory="SELECT * FROM category";
    $resultcategory=$con->query($sqlcategory);
?>

<p class="fs-2 text ms-5">
    Fliter
</p>
<form>
<div class="row">
    <aside class="col-sm-4">
    <div class="card">
        <article class="card-group-item">
            <header class="card-header">
                <h6 class="title">Brands </h6>
            </header>
            <?php
                if($result->num_rows > 0) {
                    $c = 0;
                    while($row = $result->fetch_assoc()) {
                        if($c < 5) {
                            echo '<div class="filter-content">';
                            echo '<div class="card-body">';
                            echo '<label class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" value="' . $row['brand_id'] . '">' . $row['brand_name'] . '';
                            echo '<span class="form-check-label">';
                            echo '</span>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<div class="filter-content hidden">';
                            echo '<div class="card-body">';
                            echo '<label class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" value="' . $row['brand_id'] . '">' . $row['brand_name'] . '';
                            echo '<span class="form-check-label">';
                            echo '</span>';
                            echo '</div>';
                            echo '</div>';
                        }
                        $c++;
                    }
                    echo '<p><a href="" id="show-more-link" class="link-underline-primary">Show more</a></p>';
                }
                ?>
        </article>
        
        <!-- <article class="card-group-item">
            <header class="card-header">
                <h6 class="title">Choose type </h6>
            </header>
            <div class="filter-content">
                <div class="card-body">
                <label class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadio" value="">
                <span class="form-check-label">
                    First hand items
                </span>
                </label>
                <label class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadio" value="">
                <span class="form-check-label">
                    Brand new items
                </span>
                </label>
                <label class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadio" value="">
                <span class="form-check-label">
                    Some other option
                </span>
                </label>
                </div>
            </div>
        </article> 
    </div>-->
    <div class="card">
       <article class="card-group-item">
            <header class="card-header"><h6 class="title">Category</h6></header>
            <div class="filter-content">
                <div class="list-group list-group-flush">
                    <div class="m-2">
                    <?php
                    if($resultcategory->num_rows>0){
                        while($rowcategory=$resultcategory->fetch_assoc())
                        {
                            echo '<input class="form-check-input me-2" type="checkbox" name="category[]" value="' . $rowcategory['category_id'] . '" id="' . $rowcategory['category_name'] . '">';
                            echo '<label for="' . $rowcategory['category_name'] . '">' . $rowcategory['category_name'] . '</label><br>';                            
                        }
                    }
                    ?>
                </div>
                </div>
            </div>
        </article>
        <!-- <article class="card-group-item">
            <header class="card-header"><h6 class="title">Color check</h6></header>
            <div class="filter-content">
                <div class="card-body">
                    <label class="btn btn-danger">
                    <input class="" type="checkbox" name="myradio" value="">
                    <span class="form-check-label">Red</span>
                    </label>
                    <label class="btn btn-success">
                    <input class="" type="checkbox" name="myradio" value="">
                    <span class="form-check-label">Green</span>
                    </label>
                    <label class="btn btn-primary">
                    <input class="" type="checkbox" name="myradio" value="">
                    <span class="form-check-label">Blue</span>
                    </label>
                </div>
            </div>
        </article> -->
    </div>
    <div class="card">
        <article class="card-group-item">
            <header class="card-header">
                <h6 class="title">Price Range</h6>
            </header>
            <div class="filter-content">
                <div class="card-body">
                <div class="form-row">
                <div class="form-group col-md-6">
                <label>Min</label>
                <input type="number" class="form-control" id="inputmin" placeholder="₹0" max="99999" min="0">
                </div>
                <div class="form-group col-md-6 text-right">
                <label>Max</label>
                <input type="number" class="form-control" id="inputmax" placeholder="₹10,00,000" maxlength="7" minlength="1">
                </div>
                </div>
                </div>
            </div>
        </article>
        <button class="btn btn-primary border border-dark m-2" onclick="done()" type="submit">Apply</button>
        <button class="btn btn-primary border border-dark m-2" type="reset">Reset</button>
        </form>
        <!-- <article class="card-group-item">
            <header class="card-header">
                <h6 class="title">Selection </h6>
            </header>
            <div class="filter-content">
                <div class="card-body">
                    <div class="custom-control custom-checkbox">
                        <span class="float-right badge badge-light round">52</span>
                        <input type="checkbox" class="custom-control-input" id="Check1">
                        <label class="custom-control-label" for="Check1">Samsung</label>
                    </div> 

                    <div class="custom-control custom-checkbox">
                        <span class="float-right badge badge-light round">132</span>
                        <input type="checkbox" class="custom-control-input" id="Check2">
                        <label class="custom-control-label" for="Check2">Black berry</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <span class="float-right badge badge-light round">17</span>
                        <input type="checkbox" class="custom-control-input" id="Check3">
                        <label class="custom-control-label" for="Check3">Samsung</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <span class="float-right badge badge-light round">7</span>
                        <input type="checkbox" class="custom-control-input" id="Check4">
                        <label class="custom-control-label" for="Check4">Other Brand</label>
                    </div>
                </div>
            </div>
        </article>  -->
    </div> 
    </aside>
    <main class="col-sm-8">
    <?php 
    if ($resultproduct->num_rows > 0) {
        while($rowproduct = $resultproduct->fetch_assoc()){
            echo '<div class="card d-flex mb-2">';
            echo '<img src="' . $rowproduct['image'] . '" class="card-img-top ms-2 mt-2" alt="..." style="width: 150px;">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $rowproduct['title'] . '</h5>';
            echo '<p class="card-text">' . $rowproduct['label'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    }
?>
    </main>
</div>
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

function done(){
    prevent.default()
    var btn=document.getElementsByClassName('submit');
    btn.addEventListener("click", function() {
    var min=document.getElementByIdName('inputmin').value;
    var max=document.getElementByIdName('inputmax').value;
    console.log(min,max);
    })
}
</script>
<style>
.hidden {
    display: none;
}
</style>