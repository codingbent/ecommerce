<?php
include 'connection.php';
include 'nav.php';

if ($_SESSION['is_admin'] == "") { ?>
    <script type="text/javascript">
        window.location.href = 'http://localhost/ecommerce/login.php';
    </script>
<?php
    exit();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT * FROM CUSTOMER WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            
            $updateSql = "UPDATE CUSTOMER SET firstname = ?, lastname = ?, email = ?, role = ? WHERE user_id = ?";
            $updateStmt = $con->prepare($updateSql);
            $updateStmt->bind_param('sssii', $firstname, $lastname, $email, $role, $userId);
            
            if ($updateStmt->execute()) {
                echo "<script>alert('User details updated successfully.');</script>";
                // <script>window.location.href 'user.php';</script>
                
            } else {
                echo "<script>alert('Error updating user details: ')</script>" . $con->error;
            }
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<div class="container my-4">
    <h2 class="my-3">Edit User</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="firstname" class="my-2 fs-5 text">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
        </div>
        <div class="form-group">
            <label for="lastname" class="my-2 fs-5 text">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email" class="my-2 fs-5 text">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="role" class="my-2 fs-5 text">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="2" <?php if ($user['role'] == 2) echo 'selected'; ?>>Super Admin</option>
                <option value="1" <?php if ($user['role'] == 1) echo 'selected'; ?>>Admin</option>
                <option value="0" <?php if ($user['role'] == 0) echo 'selected'; ?>>User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary my-2">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>
