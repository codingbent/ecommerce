
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
    <?php include 'nav.php'?>
  <section class=" two my-5">
    <div id="carouselExample" class="carousel slide">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://thumbs.dreamstime.com/b/showcase-pickles-canned-vegetables-store-carousel-st-petersburg-russia-october-food-products-109698940.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://thumbs.dreamstime.com/b/showcase-pickles-canned-vegetables-store-carousel-st-petersburg-russia-october-food-products-109698940.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://thumbs.dreamstime.com/b/showcase-pickles-canned-vegetables-store-carousel-st-petersburg-russia-october-food-products-109698940.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
   </section>
  <section class="three my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-around rounded-4">      
        <div class="card text-bg-dark rounded-4">
          <img src="https://i.pinimg.com/originals/00/1e/b6/001eb6b05fd2e3d4950a3e3eb146edd5.jpg" class="card-img" alt="...">
          <div class="card-img-overlay mx-3">
            <h5 class="card-title">Fruits and Vegetables</h5>
            <p class="card-text">Get Upto 30% Off</p>
            <button type="button" class="btn btn-dark">Shop Now</button>
          </div>
        </div>
        <div class="card text-bg-dark">
          <img src="https://static.vecteezy.com/system/resources/thumbnails/033/107/942/small_2x/a-basket-of-freshly-baked-bread-web-banner-with-copy-space-generative-ai-photo.jpg" class="card-img" alt="...">
          <div class="card-img-overlay mx-3">
            <h5 class="card-title">Freshly Baked buns</h5>
            <p class="card-text">Get Upto 30% Off</p>
            <button type="button" class="btn btn-dark">Shop Now</button>
          </div>
        </div>
    </div>
  </section>
  <?php
  include 'product.php';
  include 'footer.php';
  ?>
  </body>
</html>
