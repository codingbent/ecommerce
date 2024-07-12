<?php
session_start();
if (isset($_POST['c_id'])) {
    $_SESSION['c_id'] = $_POST['c_id'];
}

if (isset($_POST['p_id'])) {
    $_SESSION['p_id'] = $_POST['p_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['e_id'])) {
        $_SESSION['e_id'] = $_POST['e_id']; // Set p_id in session
        echo "Session set";
    } }

?>
