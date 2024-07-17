<?php
// Include necessary files
include 'connection.php'; // Ensure this file initializes and handles sessions
include 'nav.php'; // Assuming this file contains your navigation structure

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editAddress'])) {
        // Edit existing address
        $user_id = $_SESSION['user_id'];
        $address_id = mysqli_real_escape_string($con, $_POST['editAddress']);
        $house_no = mysqli_real_escape_string($con, $_POST['inputHouseno']);
        $house_name = mysqli_real_escape_string($con, $_POST['inputHousename']);
        $line1 = mysqli_real_escape_string($con, $_POST['inputAddress1']);
        $line2 = mysqli_real_escape_string($con, $_POST['inputAddress2']);
        $city = mysqli_real_escape_string($con, $_POST['inputCity']);
        $state = mysqli_real_escape_string($con, $_POST['inputState']);
        $pincode = mysqli_real_escape_string($con, $_POST['inputZip']);

        // Check if any data has changed before updating
        $sql_check = "SELECT * FROM address WHERE address_id = $address_id";
        $result_check = $con->query($sql_check);

        if ($result_check->num_rows > 0) {
            $row = $result_check->fetch_assoc();
            if ($row['house_no'] == $house_no && $row['house_name'] == $house_name &&
                $row['line1'] == $line1 && $row['line2'] == $line2 &&
                $row['city'] == $city && $row['state'] == $state && $row['pincode'] == $pincode) {
                echo "<script>alert('No changes made.')</script>";
            } else {
                $sql_update = "UPDATE address SET house_no='$house_no', house_name='$house_name', line1='$line1', line2='$line2', 
                        city='$city', state='$state', pincode='$pincode' WHERE address_id=$address_id AND user_id=$user_id";

                if (mysqli_query($con, $sql_update)) {
                    echo "<script>alert('Address updated successfully')</script>";
                } else {
                    echo "Error updating address: " . mysqli_error($con);
                }
            }
        } else {
            echo "Address not found.";
        }
    } elseif (isset($_POST['inputHouseno']) && isset($_POST['inputHousename']) && isset($_POST['inputAddress1']) &&
        isset($_POST['inputCity']) && isset($_POST['inputState']) && isset($_POST['inputZip'])) {
        // Add new address
        $user_id = $_SESSION['user_id'];
        $house_no = mysqli_real_escape_string($con, $_POST['inputHouseno']);
        $house_name = mysqli_real_escape_string($con, $_POST['inputHousename']);
        $line1 = mysqli_real_escape_string($con, $_POST['inputAddress1']);
        $line2 = mysqli_real_escape_string($con, $_POST['inputAddress2']);
        $city = mysqli_real_escape_string($con, $_POST['inputCity']);
        $state = mysqli_real_escape_string($con, $_POST['inputState']);
        $pincode = mysqli_real_escape_string($con, $_POST['inputZip']);

        $sql_insert = "INSERT INTO address (user_id, house_no, house_name, line1, line2, city, state, country, pincode) 
                VALUES ('$user_id', '$house_no', '$house_name', '$line1', '$line2', '$city', '$state', 'India', '$pincode')";

        if (mysqli_query($con, $sql_insert)) {
            echo "<script>alert('Address added successfully')</script>";
        } else {
            echo "Error adding address: " . mysqli_error($con);
        }
    }
}

// Fetch user details and addresses
$user_id = $_SESSION['user_id'];

// Fetch user details
$sql_user = "SELECT * FROM customer WHERE user_id = $user_id";
$result_user = $con->query($sql_user);

if ($result_user->num_rows > 0) {
    $user_row = $result_user->fetch_assoc();

    // Fetch addresses
    $sql_address = "SELECT * FROM address WHERE user_id = $user_id";
    $result_address = $con->query($sql_address);

    if ($result_address->num_rows > 0) {
        // echo "<div>Addresses:</div>";
        while ($address_row = $result_address->fetch_assoc()) {
            // Display address details with edit/delete options
            ?>
            <form class="row g-3 m-3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="col-md-6">
                    <label for="inputHouseno" class="form-label">House Number<sup>*</sup></label>
                    <input value='<?php echo $address_row['house_no']; ?>' required type="number" class="form-control" id="inputHouseno" name="inputHouseno" placeholder="Enter your house number/flat number" min="1">
                </div>
                <div class="col-md-6">
                    <label for="inputHousename" class="form-label">House Name<sup>*</sup></label>
                    <input value='<?php echo $address_row['house_name']; ?>' required type="text" class="form-control" id="inputHousename" name="inputHousename" placeholder="Enter house name">
                </div>
                <div class="col-12">
                    <label for="inputAddress1" class="form-label">Address 1<sup>*</sup></label>
                    <input value='<?php echo $address_row['line1']; ?>' required type="text" class="form-control" id="inputAddress1" name="inputAddress1" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input value='<?php echo $address_row['line2']; ?>' type="text" class="form-control" id="inputAddress2" name="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City<sup>*</sup></label>
                    <input value='<?php echo $address_row['city']; ?>' required type="text" class="form-control" id="inputCity" name="inputCity">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State<sup>*</sup></label>
                    <select required id="inputState" class="form-select" name="inputState">
                        <option selected>Choose...</option>
                        <!-- PHP loop to select the saved state -->
                        <?php
                        $states = array(
                            "Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar",
                            "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli", "Daman and Diu", "Delhi",
                            "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand",
                            "Karnataka", "Kerala", "Ladakh", "Lakshadweep", "Madhya Pradesh", "Maharashtra",
                            "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Puducherry", "Punjab",
                            "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh",
                            "Uttarakhand", "West Bengal"
                        );

                        foreach ($states as $state_name) {
                            $selected = ($address_row['state'] == $state_name) ? 'selected' : '';
                            echo "<option value='$state_name' $selected>$state_name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip<sup>*</sup></label>
                    <input value='<?php echo $address_row['pincode']; ?>' required type="text" class="form-control" id="inputZip" name="inputZip" maxlength="6">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <input type="hidden" name="editAddress" value="<?php echo $address_row['address_id']; ?>">
                </div>
            </form>
    <?php
        }
    } else {
        // No addresses found, display form to add new address
        ?>
        <form class="row g-3 m-3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="col-md-6">
                <label for="inputHouseno" class="form-label">House Number<sup>*</sup></label>
                <input required type="number" class="form-control" id="inputHouseno" name="inputHouseno" placeholder="Enter your house number/flat number" min="1">
            </div>
            <div class="col-md-6">
                <label for="inputHousename" class="form-label">House Name<sup>*</sup></label>
                <input required type="text" class="form-control" id="inputHousename" name="inputHousename" placeholder="Enter house name">
            </div>
            <div class="col-12">
                <label for="inputAddress1" class="form-label">Address 1<sup>*</sup></label>
                <input required type="text" class="form-control" id="inputAddress1" name="inputAddress1" placeholder="Apartment, studio, or floor">
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" name="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City<sup>*</sup></label>
                <input required type="text" class="form-control" id="inputCity" name="inputCity">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State<sup>*</sup></label>
                <select required id="inputState" class="form-select" name="inputState">
                    <option selected>Choose...</option>
                    <!-- PHP loop to select the saved state -->
                    <?php
                    foreach ($states as $state_name) {
                        echo "<option value='$state_name'>$state_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Zip<sup>*</sup></label>
                <input required type="text" class="form-control" id="inputZip" name="inputZip" maxlength="6">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
<?php
    }
} else {
    echo "User not found.";
}

// Close database connection
$con->close();
?>

<!-- Additional HTML, if any -->

<?php include 'footer.php'; ?>
