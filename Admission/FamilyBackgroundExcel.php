<?php
require 'C:\xampp\htdocs\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'dbconn.php';

$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();


$worksheet->setCellValue('A1', 'User ID');
$worksheet->setCellValue('B1', 'Control Number');
$worksheet->setCellValue('C1', 'Father\'s Name');
$worksheet->setCellValue('D1', 'Father\'s Contact');
$worksheet->setCellValue('E1', 'Father\'s Occupation');
$worksheet->setCellValue('F1', 'Mother\'s Name');
$worksheet->setCellValue('G1', 'Mother\'s Contact');
$worksheet->setCellValue('H1', 'Mother\'s Occupation');
$worksheet->setCellValue('I1', 'Monthly Income');
$worksheet->setCellValue('J1', 'Number of Siblings');
$worksheet->setCellValue('K1', 'Birth Order');
$worksheet->setCellValue('L1', 'Guardian\'s Name');
$worksheet->setCellValue('M1', 'Guardian\'s Contact');
$worksheet->setCellValue('N1', 'Guardian\'s Occupation');
$worksheet->setCellValue('O1', 'Solo Parent');
$worksheet->setCellValue('P1', 'Family Working Abroad');


$query = "
    SELECT ua.userID, ua.control_number, fb.FathersName, fb.FathersContact, fb.FathersOccu, fb.MothersName, fb.MothersContact, fb.MothersOccu, fb.MonthlyIncome, fb.NumOfSib, fb.BirthOrder, fb.GuardiansName, fb.GuardiansContact, fb.GuardiansOccu, fb.SoloParent, fb.FamWorkingAbroad
    FROM useraccount ua
    INNER JOIN familybackground fb ON ua.userID = fb.userID
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
    $worksheet->setCellValue('C' . $rowNumber, $row['FathersName']);
    $worksheet->setCellValue('D' . $rowNumber, $row['FathersContact']);
    $worksheet->setCellValue('E' . $rowNumber, $row['FathersOccu']);
    $worksheet->setCellValue('F' . $rowNumber, $row['MothersName']);
    $worksheet->setCellValue('G' . $rowNumber, $row['MothersContact']);
    $worksheet->setCellValue('H' . $rowNumber, $row['MothersOccu']);
    $worksheet->setCellValue('I' . $rowNumber, $row['MonthlyIncome']);
    $worksheet->setCellValue('J' . $rowNumber, $row['NumOfSib']);
    $worksheet->setCellValue('K' . $rowNumber, $row['BirthOrder']);
    $worksheet->setCellValue('L' . $rowNumber, $row['GuardiansName']);
    $worksheet->setCellValue('M' . $rowNumber, $row['GuardiansContact']);
    $worksheet->setCellValue('N' . $rowNumber, $row['GuardiansOccu']);
    $worksheet->setCellValue('O' . $rowNumber, $row['SoloParent']);
    $worksheet->setCellValue('P' . $rowNumber, $row['FamWorkingAbroad']);
    $rowNumber++;
}


$filename = 'C:\xampp\htdocs\Group6OnlineExam\Admission\FamilyBackground2024.xlsx';
$writer = new Xlsx($spreadsheet);

if (file_exists($filename)) {
    unlink($filename);
}


$writer->save($filename);

$conn->close();
?>
