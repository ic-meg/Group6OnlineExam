<?php
session_start();
include "dbcon.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminId = $_POST['adminId'];

    $sql = "DELETE FROM adminaccount WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $adminId);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
