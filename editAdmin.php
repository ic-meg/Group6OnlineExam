<?php
session_start();
include "dbcon.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminId = $_POST['adminId'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "UPDATE adminaccount SET username=?, password=? WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $username, $password, $adminId);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
