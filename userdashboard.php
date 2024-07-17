<?php
include 'connection.php'; // Ensure this file initializes and handles sessions
include 'nav.php'; // Assuming this file contains your navigation structure
?>

<div class="row my-3">
    <div class="col-4">
        <div class="list-group">
            <a id="accountInfoTab" class="list-group-item list-group-item-action active" aria-current="true">Account Info</a>
            <a id="orderInfoTab" class="list-group-item list-group-item-action">Order details</a>
            <a id="securityTab" class="list-group-item list-group-item-action">Security</a>
            <a id="privacyTab" class="list-group-item list-group-item-action">Privacy and Data</a>
        </div>
    </div>
    <div class="col-8">
        <div id="accountInfoContent" class="content-div">
            <div class="list-group-item">
                <p class="fs-1 text">Account Info</p>
                <i class="fa fa-user" style="font-size:80px;"></i>
                <p class="fs-2 text">Basic Info</p>
                <p class="fs-4 text">Name</p>
                <p><?php echo htmlspecialchars(@$_SESSION['name'] . ' ' . @$_SESSION['lname']); ?></p>
                <p class="fs-4 text">Email</p>
                <p><?php echo htmlspecialchars(@$_SESSION['email']); ?></p>
            </div>
        </div>
        <div id="orderInfoContent" class="content-div">
            <div class="list-group-item">
                <p class="fs-1 text">Order details</p>
                <?php
                // $user_id=$_SESSION['user_id'];
                //     $sql="SELECT * FROM ORDER WHERE user_id=$user_id";
                //     $result=$con->query($sql);
                //     print_r($result);
                    
                ?>
            </div>
        </div>
        <div id="securityContent" class="content-div" style="display:none;">
            <div class="list-group-item">
                <h2>Security</h2>
                <h4>Logging in to Fresh Cart</h4>
                <!-- Add security-related content here -->
            </div>
        </div>
        <div id="privacyContent" class="content-div" style="display:none;">
            <div class="list-group-item">
                <h2>Privacy & Data</h2>
                <h4>Privacy</h4>
                <p>Privacy Center</p>
                <p>Take control of your privacy and learn how we protect it.</p>
                <h4>Third-party apps with account access</h4>
                <p>Once you allow access to third-party apps, you'll see them here. Learn more</p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<?php include 'footer.php'; ?>
