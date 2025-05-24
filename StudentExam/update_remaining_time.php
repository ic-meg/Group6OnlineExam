<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);


    if (isset($data['remaining_time'])) {
        $_SESSION['remaining_time'] = $data['remaining_time'];
        echo json_encode(['status' => 'success']);
        exit;
    }
}


echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
