<?php

require '../vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'dbconn.php';

$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();


$worksheet->setCellValue('A1', 'User ID');
$worksheet->setCellValue('B1', 'Control Number');
$worksheet->setCellValue('C1', 'First Name');
$worksheet->setCellValue('D1', 'Middle Name');
$worksheet->setCellValue('E1', 'Last Name');
$worksheet->setCellValue('F1', 'Suffix');
$worksheet->setCellValue('G1', 'Region');
$worksheet->setCellValue('H1', 'Province');
$worksheet->setCellValue('I1', 'Town');
$worksheet->setCellValue('J1', 'Barangay');
$worksheet->setCellValue('K1', 'Street');
$worksheet->setCellValue('L1', 'Zip Code');
$worksheet->setCellValue('M1', 'Cellphone Number');
$worksheet->setCellValue('N1', 'Landline Number');
$worksheet->setCellValue('O1', 'Civil Status');
$worksheet->setCellValue('P1', 'Sex');
$worksheet->setCellValue('Q1', 'Date of Birth');
$worksheet->setCellValue('R1', 'Place of Birth');
$worksheet->setCellValue('S1', 'Religion');
$worksheet->setCellValue('T1', 'Indigenous');


$query = "
    SELECT ua.userID, ua.control_number, pi.FirstName, pi.MiddleName, pi.LastName, pi.Suffix, pi.Region, pi.Province, pi.Town, pi.Barangay, pi.Street, pi.ZipCode, pi.CellphoneNumber, pi.LandlineNumber, pi.CivilStatus, pi.Sex, pi.DateOfBirth, pi.PlaceOfBirth, pi.Religion, pi.Indigenous
    FROM useraccount ua
    INNER JOIN personalinfo pi ON ua.userID = pi.userID
    WHERE ua.control_number IS NOT NULL AND ua.control_number <> ''
";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$rowNumber = 2; 


while ($row = $result->fetch_assoc()) {
    $worksheet->setCellValue('A' . $rowNumber, $row['userID']);
    $worksheet->setCellValue('B' . $rowNumber, $row['control_number']);
    $worksheet->setCellValue('C' . $rowNumber, $row['FirstName']);
    $worksheet->setCellValue('D' . $rowNumber, $row['MiddleName']);
    $worksheet->setCellValue('E' . $rowNumber, $row['LastName']);
    $worksheet->setCellValue('F' . $rowNumber, $row['Suffix']);
    $worksheet->setCellValue('G' . $rowNumber, $row['Region']);
    $worksheet->setCellValue('H' . $rowNumber, $row['Province']);
    $worksheet->setCellValue('I' . $rowNumber, $row['Town']);
    $worksheet->setCellValue('J' . $rowNumber, $row['Barangay']);
    $worksheet->setCellValue('K' . $rowNumber, $row['Street']);
    $worksheet->setCellValue('L' . $rowNumber, $row['ZipCode']);
    $worksheet->setCellValue('M' . $rowNumber, $row['CellphoneNumber']);
    $worksheet->setCellValue('N' . $rowNumber, $row['LandlineNumber']);
    $worksheet->setCellValue('O' . $rowNumber, $row['CivilStatus']);
    $worksheet->setCellValue('P' . $rowNumber, $row['Sex']);
    $worksheet->setCellValue('Q' . $rowNumber, $row['DateOfBirth']);
    $worksheet->setCellValue('R' . $rowNumber, $row['PlaceOfBirth']);
    $worksheet->setCellValue('S' . $rowNumber, $row['Religion']);
    $worksheet->setCellValue('T' . $rowNumber, $row['Indigenous']);
    $rowNumber++;
}


$filename = 'C:\xampp\htdocs\OnlineExam\Admission\PersonalInfo2024.xlsx';
$writer = new Xlsx($spreadsheet);


if (file_exists($filename)) {
    unlink($filename);
}


$writer->save($filename);

$conn->close();
?>
