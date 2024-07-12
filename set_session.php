<?php
session_start();
if (isset($_POST['c_id'])) {
    $_SESSION['c_id'] = $_POST['c_id'];
}
?>
