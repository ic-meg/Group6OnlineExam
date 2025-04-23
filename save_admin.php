<?php
session_start();
include "dbcon.php"; 


$username = $_POST['username'];
$password = $_POST['password'];
$adminId = $_POST['adminId'];


if ($adminId) {
    
    $sql = "UPDATE adminaccount SET username = ?, password = ? WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $password, $adminId);
} else {
    $sql = "INSERT INTO adminaccount (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
}

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}

$stmt->close();
$conn->close();
?>
