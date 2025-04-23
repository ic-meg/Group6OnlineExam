<?php



$data = json_decode(file_get_contents("php://input"), true);

include "dbcon.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$proctoringStatus = $conn->real_escape_string($data['proctoringStatus']);
$testAttemptId = $conn->real_escape_string($data['testAttemptId']);
$timestamp = $conn->real_escape_string($data['timestamp']);

$sql = "INSERT INTO proctoring_reports (name, email, proctorstatus, testAttemptID, timestamp)
        VALUES ('$name', '$email', '$proctoringStatus', '$testAttemptId', '$timestamp')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Data saved successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

$conn->close();
