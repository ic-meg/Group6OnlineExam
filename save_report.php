<?php
session_start();


$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['reportData'])) {
  
    $_SESSION['reportData'] = $data['reportData'];
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No report data received']);
}
