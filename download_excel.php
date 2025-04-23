<?php

include 'dbcon.php'; 


$baseDir = 'C:/xampp/htdocs/Group6OnlineExam/Admission/';


$fileNames = [
    'AdmissionInfo' => 'AdmissionInfo2024.xlsx',
    'PersonalInfo' => 'PersonalInfo2024.xlsx',
    'FamilyBackground' => 'FamilyBackground2024.xlsx',
    'EducationalBackground' => 'EducationalBackground2024.xlsx',
    'MedicalHistory' => 'MedicalHistory2024.xlsx'
];


$fileToServe = isset($_GET['file']) ? $_GET['file'] : 'AdmissionInfo';


if (array_key_exists($fileToServe, $fileNames)) {
    $filePath = $baseDir . $fileNames[$fileToServe];

    echo "<p>Attempting to serve file from: " . htmlspecialchars($filePath) . "</p>";

    
    if (file_exists($filePath)) {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . basename($filePath) . '"');
        header('Cache-Control: max-age=0');
        readfile($filePath);
        exit();
    } else {
        echo "<p>File not found.</p>";
    }
} else {
    echo "<p>Invalid file request.</p>";
}
?>
