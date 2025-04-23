<?php
include "dbcon.php";

if (isset($_GET['file'])) {
    $file = $_GET['file'];

    
    $sql = "SELECT * FROM requirements WHERE form137 = ? OR form138 = ? OR PSA = ? OR 1x1 = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $file, $file, $file, $file);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['form137'] === $file) {
            $fileContent = $row['form137'];
        } elseif ($row['form138'] === $file) {
            $fileContent = $row['form138'];
        } elseif ($row['PSA'] === $file) {
            $fileContent = $row['PSA'];
        } elseif ($row['1x1'] === $file) {
            $fileContent = $row['1x1'];
        }

        
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($file));
        echo $fileContent;
    } else {
        echo "File not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
