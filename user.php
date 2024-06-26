<?php
include 'connection.php';
include 'nav.php';

if ($_SESSION['is_admin'] == "") { ?>
    <script type="text/javascript">
        window.location.href = 'http://localhost/ecommerce/login.php';
    </script>
<?php 
}

$sqlusers = "SELECT * FROM CUSTOMER";
$resultCountRows = $con->query($sqlusers);

if ($resultCountRows->num_rows > 0) { ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Post</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $row_number = 1;
            while ($row_result = mysqli_fetch_assoc($resultCountRows)) { ?>
                <tr>
                    <th scope="row"><?php echo $row_number++; ?></th>
                    <td><?php echo htmlspecialchars($row_result['firstname']); ?></td>
                    <td><?php echo htmlspecialchars($row_result['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($row_result['email']); ?></td>
                    <td>
                <select>
                    <option value="2" <?php if ($row_result['role'] == 2) echo 'selected'; ?>>Super Admin</option>
                    <option value="1" <?php if ($row_result['role'] == 1) echo 'selected'; ?>>Admin</option>
                    <option value="0" <?php if ($row_result['role'] == 0) echo 'selected'; ?>>User</option>
                </select>
            </td>
            <td>
                <?php ?>
                <a href="edit_user.php?id=<?php echo htmlspecialchars($row_result['user_id']); ?>" class="btn btn-primary">Edit</a>
            </td>
        </tr>
            <?php } ?>
        </tbody>
    </table>
<?php 
} else {
    echo "No results found.";
}

include 'footer.php';
?>
