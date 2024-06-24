<?php
session_start();
include 'connection.php';
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="index.js"></script>
</head>
<body>
    <div class="container-fluid bg-success py-2">
        <a class="navbar-brand fs-3 fw-bold text-light" href="index.php">Fresh Cart Account</a>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ms-4 my-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Account</li>
        </ol>
    </nav>
    <div class="row my-3">
        <div class="col-4">
            <div class="list-group">
                <a href="#" id="accountInfoTab" class="list-group-item list-group-item-action active" aria-current="true">Account Info</a>
                <a href="#" id="securityTab" class="list-group-item list-group-item-action">Security</a>
                <a href="#" id="privacyTab" class="list-group-item list-group-item-action">Privacy and data</a>
            </div>
        </div>
        <div class="col-8">
            <div id="accountInfoContent" class="content-div">
                <div class="list-group-item">
                    <p class="fs-1 text">Account Info</p>
                    <i class="fa fa-user" style="font-size:80px;"></i>
                    <p class="fs-2 text">Basic Info</p>
                    <p class="fs-4 text">Name</p>
                    <?php
                     echo '
                     <p>'
                        . htmlspecialchars(@$_SESSION['name'] . ' ' . $_SESSION['lname'], ENT_QUOTES, 'UTF-8') . 
                    '</p>';
                    ?>
                    <p class="fs-4 text">Email</p>
                    <?php
                     echo '
                     <p>'
                        . htmlspecialchars(@$_SESSION['email'] , ENT_QUOTES, 'UTF-8') . 
                    '</p>';
                    ?>
                </div>
            </div>
            <div id="securityContent" class="content-div" style="display:none;">
                <div class="list-group-item">
                    <h2>Security</h2>
                    <h4>Logging in to Fresh Cart</h4>
                </div>
            </div>
            <div id="privacyContent" class="content-div" style="display:none;">
                <div class="list-group-item">
                    <h2>Privacy & Data</h2>
                    <h4>Privacy</h4>
                    <p>Privacy Center</p>
                    <p>Take control of your privacy and learn how we protect it.</p>
                    <h4>Third-party apps with account access</h4>
                    <p>Once you allow access to third party apps, you'll see them here. Learn more</p>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.list-group-item').click(function() {
            $('.list-group-item').removeClass('active');
            $(this).addClass('active');

            $('.content-div').hide();
            const target = $(this).attr('id').replace('Tab', 'Content');
            $('#' + target).show();
        });
    });
</script>
</html>
