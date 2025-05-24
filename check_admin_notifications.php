<?php
session_start();
include 'dbcon.php';

if (!isset($_SESSION['control_number'])) {
    echo 'false';
    exit;
}

$control_number = $_SESSION['control_number'];

$sql = "SELECT 1 FROM useraccount WHERE control_number = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $control_number);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo 'true';
} else {
    echo 'false';
}

$stmt->close();
$conn->close();
