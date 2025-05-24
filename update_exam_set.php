<?php
session_start();
include "dbcon.php";

if (isset($_SESSION['exam_id'])) {
    $exam_id = $_SESSION['exam_id'];
} else {
    echo "Error: Exam ID not found in session.";
    exit;
}


$examSetTitle = $_POST['examSetTitle'];


$sql = "UPDATE admin_exam_set SET title = ? WHERE exam_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $examSetTitle, $exam_id);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();


    echo "<script>
        alert('Exam Set title updated successfully.');
        window.location.href = 'AdminPortalExamSet.php'; // Redirect to the same page or another if needed
    </script>";
    exit();
} else {
    echo "Error: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
