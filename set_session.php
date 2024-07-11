<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['c_id'])) {
        $c_id = $_POST['c_id'];
        
       
        $_SESSION['c_id'] = $c_id;

        $response = array('status' => 'success');
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'c_id not provided');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
