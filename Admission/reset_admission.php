<?php
include 'dbconn.php';
$email = $_POST['email'];


$stmt = $conn->prepare("SELECT userID FROM useraccount WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userID = $row['userID'];

    $stmt = $conn->prepare("DELETE FROM admissioninfo WHERE userID = ?");
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        echo "Admission information reset successfully.";
        echo "<script>window.location.href = 'AdmissionInformation.php';</script>";
    } else {
        echo "Error resetting admission information: " . $stmt->error;
    }
} else {
    echo "User not found.";
}
