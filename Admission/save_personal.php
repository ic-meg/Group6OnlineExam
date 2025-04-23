<?php
include 'dbconn.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    echo 'User not logged in.';
    exit();
}

$email = $_SESSION['user_email'];

// Retrieve POST data
$firstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
$middleName = isset($_POST['MiddleName']) ? $_POST['MiddleName'] : '';
$lastName = isset($_POST['LastName']) ? $_POST['LastName'] : '';
$suffix = isset($_POST['Suffix']) ? $_POST['Suffix'] : '';
$region = isset($_POST['Region']) ? $_POST['Region'] : '';
$province = isset($_POST['Province']) ? $_POST['Province'] : '';
$town = isset($_POST['Town']) ? $_POST['Town'] : '';
$barangay = isset($_POST['Barangay']) ? $_POST['Barangay'] : '';
$street = isset($_POST['Street']) ? $_POST['Street'] : '';
$zipCode = isset($_POST['ZipCode']) ? $_POST['ZipCode'] : '';
$cellphoneNum = isset($_POST['CellphoneNumber']) ? $_POST['CellphoneNumber'] : '';
$landlineNum = isset($_POST['LandlineNumber']) ? $_POST['LandlineNumber'] : '';
$civilStatus = isset($_POST['CivilStatus']) ? $_POST['CivilStatus'] : '';
$sex = isset($_POST['Sex']) ? $_POST['Sex'] : '';
$dateOfBirth = isset($_POST['DateOfBirth']) ? $_POST['DateOfBirth'] : '';
$placeOfBirth = isset($_POST['PlaceOfBirth']) ? $_POST['PlaceOfBirth'] : '';
$religion = isset($_POST['Religion']) ? $_POST['Religion'] : '';
$indigenous = isset($_POST['Indigenous']) ? $_POST['Indigenous'] : '';

// Validate required fields
if (empty($firstName) || empty($lastName) || empty($region) || empty($province) || empty($town) || empty($barangay) || 
    empty($street) || empty($zipCode) || empty($cellphoneNum) || empty($dateOfBirth) || empty($placeOfBirth) || 
    empty($indigenous)) {
    echo 'All required fields must be filled out.';
    exit();
}

// Fetch user ID
$stmt = $conn->prepare("SELECT userID FROM useraccount WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userID = $row['userID'];

    // Insert or update personal info
    $stmt = $conn->prepare("INSERT INTO personalinfo (userID, FirstName, MiddleName, LastName, Suffix, Region, Province, Town, Barangay, 
        Street, ZipCode, CellphoneNumber, LandlineNumber, CivilStatus, Sex, DateOfBirth, PlaceOfBirth, Religion, Indigenous) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE FirstName = VALUES(FirstName), MiddleName = VALUES(MiddleName), LastName = VALUES(LastName), 
        Suffix = VALUES(Suffix), Region = VALUES(Region), Province = VALUES(Province), Town = VALUES(Town), Barangay = VALUES(Barangay), 
        Street = VALUES(Street), ZipCode = VALUES(ZipCode), CellphoneNumber = VALUES(CellphoneNumber), LandlineNumber = VALUES(LandlineNumber), 
        CivilStatus = VALUES(CivilStatus), Sex = VALUES(Sex), DateOfBirth = VALUES(DateOfBirth), PlaceOfBirth = VALUES(PlaceOfBirth), 
        Religion = VALUES(Religion), Indigenous = VALUES(Indigenous)");

    $stmt->bind_param("isssssssssssssssss", $userID, $firstName, $middleName, $lastName, $suffix, $region, $province, $town, $barangay, $street, 
        $zipCode, $cellphoneNum, $landlineNum, $civilStatus, $sex, $dateOfBirth, $placeOfBirth, $religion, $indigenous);

    if ($stmt->execute()) {
        echo 'Success'; 
    } else {
        echo 'Error: ' . $stmt->error; 
    }
} else {
    echo 'User not found.';
}

$stmt->close();
$conn->close();
?>
