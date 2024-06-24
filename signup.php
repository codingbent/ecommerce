<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $confirm_pass = $_POST['cpass'];

    if ($pass !== $confirm_pass) {
        echo "<script>alert('Passwords do not match. Please try again.');window.location.href = 'registration.php';</script>";
        // header("Location: registration.php");
        exit; 
    }


    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO user (firstname, lastname, email, pass) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_pass);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

mysqli_close($con);
?>
