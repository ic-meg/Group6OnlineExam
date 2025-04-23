<?php
require 'C:\xampp\htdocs\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'dbconn.php';

$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();


$worksheet->setCellValue('A1', 'User ID');
$worksheet->setCellValue('B1', 'Control Number');
$worksheet->setCellValue('C1', 'Elementary School Name');
$worksheet->setCellValue('D1', 'Elementary School Address');
$worksheet->setCellValue('E1', 'Elementary Year Graduated');
$worksheet->setCellValue('F1', 'Elementary Type');
$worksheet->setCellValue('G1', 'High School Name');
$worksheet->setCellValue('H1', 'High School Address');
$worksheet->setCellValue('I1', 'High School Year Graduated');
$worksheet->setCellValue('J1', 'High School Type');
$worksheet->setCellValue('K1', 'SHS Name');
$worksheet->setCellValue('L1', 'SHS Address');
$worksheet->setCellValue('M1', 'SHS Year Graduated');
$worksheet->setCellValue('N1', 'SHS Type');
$worksheet->setCellValue('O1', 'Vocational School Name');
$worksheet->setCellValue('P1', 'Vocational School Address');
$worksheet->setCellValue('Q1', 'Vocational Year Graduated');
$worksheet->setCellValue('R1', 'Vocational Type');


$query = "
    SELECT ua.userID, ua.control_number, eb.ElemSchoolName, eb.ElemSchoolAddress, eb.ElemYearGraduated, eb.ElemType, eb.HighSchoolName, eb.HighSchoolAddress, eb.HighSchoolGraduated, eb.HighSchoolType, eb.SHSName, eb.SHSAddress, eb.SHSYearGraduated, eb.SHSType, eb.VocName, eb.VocAddress, eb.VocYearGraduated, eb.VocType
    FROM useraccount ua
    INNER JOIN educationalbackground eb ON ua.userID = eb.userID
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
    $worksheet->setCellValue('C' . $rowNumber, $row['ElemSchoolName']);
    $worksheet->setCellValue('D' . $rowNumber, $row['ElemSchoolAddress']);
    $worksheet->setCellValue('E' . $rowNumber, $row['ElemYearGraduated']);
    $worksheet->setCellValue('F' . $rowNumber, $row['ElemType']);
    $worksheet->setCellValue('G' . $rowNumber, $row['HighSchoolName']);
    $worksheet->setCellValue('H' . $rowNumber, $row['HighSchoolAddress']);
    $worksheet->setCellValue('I' . $rowNumber, $row['HighSchoolGraduated']);
    $worksheet->setCellValue('J' . $rowNumber, $row['HighSchoolType']);
    $worksheet->setCellValue('K' . $rowNumber, $row['SHSName']);
    $worksheet->setCellValue('L' . $rowNumber, $row['SHSAddress']);
    $worksheet->setCellValue('M' . $rowNumber, $row['SHSYearGraduated']);
    $worksheet->setCellValue('N' . $rowNumber, $row['SHSType']);
    $worksheet->setCellValue('O' . $rowNumber, $row['VocName']);
    $worksheet->setCellValue('P' . $rowNumber, $row['VocAddress']);
    $worksheet->setCellValue('Q' . $rowNumber, $row['VocYearGraduated']);
    $worksheet->setCellValue('R' . $rowNumber, $row['VocType']);
    $rowNumber++;
}


$filename = 'C:\xampp\htdocs\Group6OnlineExam\Admission\EducationalBackground2024.xlsx';
$writer = new Xlsx($spreadsheet);


if (file_exists($filename)) {
    unlink($filename);
}


$writer->save($filename);

$conn->close();
?>
