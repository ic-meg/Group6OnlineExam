

<?php
include 'dbconn.php';


session_start();


if (!isset($_SESSION['user_email'])) {
    echo 'User not logged in.';
    exit();
}

$email = $_SESSION['user_email'];


$entry = isset($_POST['entry']) ? $_POST['entry'] : '';
$typeOfStud = isset($_POST['typeOfStud']) ? $_POST['typeOfStud'] : '';
$applicantType = isset($_POST['applicantType']) ? $_POST['applicantType'] : '';
$SHSStrand = isset($_POST['SHSStrand']) ? $_POST['SHSStrand'] : '';
$LRN = isset($_POST['LRN']) ? $_POST['LRN'] : '';
$ProgramName = isset($_POST['ProgramName']) ? $_POST['ProgramName'] : '';


if (empty($entry) || empty($typeOfStud) || empty($applicantType) || empty($SHSStrand) || empty($ProgramName)) {
    echo 'All required fields must be filled out.';
    exit();
}


$stmt = $conn->prepare("SELECT userID FROM useraccount WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userID = $row['userID'];


    $stmt = $conn->prepare("INSERT INTO admissioninfo (userID, Entry, TypeOfStud, ApplicantType, SHSstrand, LRN, ProgramName) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE Entry = VALUES(Entry), TypeOfStud = VALUES(TypeOfStud), ApplicantType = VALUES(ApplicantType), 
        SHSstrand = VALUES(SHSstrand), LRN = VALUES(LRN), ProgramName = VALUES(ProgramName)");
    $stmt->bind_param("issssss", $userID, $entry, $typeOfStud, $applicantType, $SHSStrand, $LRN, $ProgramName);

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
