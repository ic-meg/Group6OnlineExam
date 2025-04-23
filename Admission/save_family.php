<?php
// Include database connection
include 'dbconn.php';

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    echo 'User not logged in.';
    exit();
}

$email = $_SESSION['user_email'];

// Retrieve and sanitize form data
$fatherName = isset($_POST['FathersName']) ? htmlspecialchars(trim($_POST['FathersName'])) : '';
$fatherContact = isset($_POST['FatherContact']) ? htmlspecialchars(trim($_POST['FatherContact'])) : '';
$fatherOccupation = isset($_POST['FathersOccupation']) ? htmlspecialchars(trim($_POST['FathersOccupation'])) : '';
$motherName = isset($_POST['MothersName']) ? htmlspecialchars(trim($_POST['MothersName'])) : '';
$motherContact = isset($_POST['MothersContact']) ? htmlspecialchars(trim($_POST['MothersContact'])) : '';
$motherOccupation = isset($_POST['MothersOccupation']) ? htmlspecialchars(trim($_POST['MothersOccupation'])) : '';
$familyIncome = isset($_POST['FamilyIncome']) ? htmlspecialchars(trim($_POST['FamilyIncome'])) : '';
$siblings = isset($_POST['NumberOfSib']) ? (int)$_POST['NumberOfSib'] : 0;
$birthOrder = isset($_POST['BirthOrder']) ? htmlspecialchars(trim($_POST['BirthOrder'])) : '';
$guardianName = isset($_POST['GuardiansName']) ? htmlspecialchars(trim($_POST['GuardiansName'])) : '';
$guardianContact = isset($_POST['GuardiansContact']) ? htmlspecialchars(trim($_POST['GuardiansContact'])) : '';
$guardianOccupation = isset($_POST['GuardiansOccupation']) ? htmlspecialchars(trim($_POST['GuardiansOccupation'])) : '';
$soloParent = isset($_POST['SoloParent']) ? htmlspecialchars(trim($_POST['SoloParent'])) : '';
$familyAbroad = isset($_POST['WorkingAbroad']) ? htmlspecialchars(trim($_POST['WorkingAbroad'])) : '';

// Validate input
if (empty($guardianName) || empty($guardianContact) || empty($guardianOccupation) || empty($familyIncome)) {
    echo 'Required fields must be filled out.';
    exit();
}

// Prepare and execute query to get userID based on email
$stmt = $conn->prepare("SELECT userID FROM useraccount WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userID = $row['userID'];

    // Use INSERT ... ON DUPLICATE KEY UPDATE to handle both insert and update
    $stmt = $conn->prepare("INSERT INTO family_background (userID, FathersName, FathersContact, FathersOccu, MothersName, MothersContact, MothersOccu, MonthlyIncome, NumOfSib, BirthOrder, GuardianName, GuardianContact, GuardianOccu, SoloParent, FamWorkingAbroad)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssissssss", $userID, $fatherName, $fatherContact, $fatherOccupation, $motherName, $motherContact, $motherOccupation, $familyIncome, $siblings, $birthOrder, $guardianName, $guardianContact, $guardianOccupation, $soloParent, $familyAbroad);

    if ($stmt->execute()) {
        echo 'Success'; // Return success response
    } else {
        // Log error details for debugging
        error_log("Error: " . $stmt->error);
        echo 'Error: Unable to save family background information.';
    }
} else {
    echo 'User not found.';
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
