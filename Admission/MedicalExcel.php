<?php
require 'C:\xampp\htdocs\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'dbconn.php';


$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

$worksheet->setCellValue('A1', 'User ID');
$worksheet->setCellValue('B1', 'Control Number');
$worksheet->setCellValue('C1', 'Medications');
$worksheet->setCellValue('D1', 'Type of Illness');
$worksheet->setCellValue('E1', 'PWD');


$query = "
    SELECT ua.userID, ua.control_number, mh.Medications, mh.typeOfIllness, mh.PWD
    FROM useraccount ua
    INNER JOIN medicalhistory mh ON ua.userID = mh.userID
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
    $worksheet->setCellValue('C' . $rowNumber, $row['Medications']);
    $worksheet->setCellValue('D' . $rowNumber, $row['typeOfIllness']);
    $worksheet->setCellValue('E' . $rowNumber, $row['PWD']);
    $rowNumber++;
}


$filename = 'C:\xampp\htdocs\Group6OnlineExam\Admission\MedicalHistory2024.xlsx';
$writer = new Xlsx($spreadsheet);


if (file_exists($filename)) {
    unlink($filename);
}

$writer->save($filename);

$conn->close();
?>
