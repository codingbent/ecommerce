<?php
session_start();
include 'connection.php';
// $email=$_SESSION['email'];
// $sql="SELECT user_id FROM customer where email =$_SESSION['email']";
// $result5=mysqli_query($con,$sql);
// echo $result5;
// die();

if(empty(@$_SESSION['email']))
{
  $totalRows=0;
}
else if(isset($_SESSION['user_id'])){
  $user=$_SESSION['user_id'];
  $sqlCountRows = "SELECT COUNT(*) AS total_rows FROM cart c, customer u where c.user_id=$user";
  $resultCountRows = $con->query($sqlCountRows);
  if ($resultCountRows) {
      $rowTotalRows = $resultCountRows->fetch_assoc();
      $totalRows = $rowTotalRows['total_rows'];
  } else {
      $totalRows = 0;
  }
}
?>

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
<div class="container px-3 ">                           
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
                  <a class="navbar-brand fs-3 fw-bold" href="index.php">Fresh Cart</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="d-flex mx-auto ">
                      <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Location</button>
                    </form>
                    <div class="icons">
                        <a type="button" class="btn position-relative">
                            <i class="fa fa-heart"style="font-size:36px;"></i>
                            <span class="position-absolute translate-middle badge rounded-pill bg-success" style="top: 10px;left: 50px;">
                                5
                                <span class="visually-hidden">New Alerts</span>
                              </span>
                          </a>
                          <?php
                          if (empty(@$_SESSION['email'])) {
                              echo '<a href="login.php">Login</a>/<a href="registration.php">Registration</a>';
                          } else {
                              echo '
                             <div class="btn-group">
                              <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'
                              .(@$_SESSION['name']) . 
                              '</button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="userdashboard.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="logout.php" onclick="session_destroy();">Log Out</a></li>
                              </ul>
                            </div>';
                          }
                          ?>
                          <a type="button" class="btn position-relative" href="cart.php">
                            <i class="fa fa-shopping-cart"style="font-size:36px;"></i>
                            <span class="position-absolute translate-middle badge rounded-pill bg-success" style="top: 10px;left: 50px;">
                                <?php echo @$totalRows ;?>
                                <span class="visually-hidden">New Alerts</span>
                              </span>
                          </a>
                    </div>
                </div>
                </div>
              </nav> 
        </div>
        <div class="nav navbottom-nav px-5 d-flex">
            <button class="btn btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                All Departments
              </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
            <button class="btn btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Home</button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
            <button class="btn btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
            <button class="btn btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
            <button class="btn btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dashboard</button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
            <!-- <button class="btn btn-lg" type="button">Docs</button> -->
            <?php if(@$_SESSION['is_admin']==="1" || @$_SESSION['is_admin']==="2"){?>
            <button class="btn btn-lg dropdown-toggle" id="product" type="button" data-bs-toggle="dropdown" aria-expanded="false">Products</button>
            <ul class="dropdown-menu" id="product">
              <li><a class="dropdown-item" href="addProduct.php">Add Product</a></li>
              <li><a class="dropdown-item" href="productList.php">Product list</a></li>
              <li><a class="dropdown-item" href="#">Categories</a></li>
            </ul>
            
            <?php }?>
            <?php if(@$_SESSION['is_admin']==="2"){?>
              <button class="btn btn-lg dropdown-toggle" id="product" type="button" data-bs-toggle="dropdown" aria-expanded="false">Role</button>
              <ul class="dropdown-menu" id="product">
                <li><a class="dropdown-item" href="user.php">All User</a></li>
              </ul>
             
            <?php }?>
        </div>
            
    </div>
</body>
</html>