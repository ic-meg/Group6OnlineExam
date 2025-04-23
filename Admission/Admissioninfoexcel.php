<?php
require 'C:\xampp\htdocs\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'dbconn.php';

$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();


$worksheet->setCellValue('A1', 'User ID');
$worksheet->setCellValue('B1', 'Control Number');
$worksheet->setCellValue('C1', 'Email');
$worksheet->setCellValue('D1', 'Entry');
$worksheet->setCellValue('E1', 'Type Of Student');
$worksheet->setCellValue('F1', 'Applicant Type');
$worksheet->setCellValue('G1', 'SHS Strand');
$worksheet->setCellValue('H1', 'LRN');
$worksheet->setCellValue('I1', 'Program Name');


$query = "
    SELECT ua.userID, ua.control_number, ua.email, ai.Entry, ai.TypeOfStud, ai.ApplicantType, ai.SHSStrand, ai.LRN, ai.ProgramName
    FROM useraccount ua
    INNER JOIN admissioninfo ai ON ua.userID = ai.userID
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
    $worksheet->setCellValue('C' . $rowNumber, $row['email']);
    $worksheet->setCellValue('D' . $rowNumber, $row['Entry']);
    $worksheet->setCellValue('E' . $rowNumber, $row['TypeOfStud']);
    $worksheet->setCellValue('F' . $rowNumber, $row['ApplicantType']);
    $worksheet->setCellValue('G' . $rowNumber, $row['SHSStrand']);
    $worksheet->setCellValue('H' . $rowNumber, $row['LRN']);
    $worksheet->setCellValue('I' . $rowNumber, $row['ProgramName']);
    $rowNumber++;
}

// Specify the filename and path
$filename = 'C:\xampp\htdocs\Group6OnlineExam\Admission\AdmissionInfo2024.xlsx';
$writer = new Xlsx($spreadsheet);


if (file_exists($filename)) {
    unlink($filename);
}


$writer->save($filename);

$conn->close();
?>
