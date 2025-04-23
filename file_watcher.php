<?php
$excelFile = 'C:/Users/Meg Angeline Fabian/Downloads/control_numbers.xlsx';
$lastModifiedTime = filemtime($excelFile);

while (true) {
    clearstatcache();
    $currentModifiedTime = filemtime($excelFile);
    
    if ($currentModifiedTime !== $lastModifiedTime) {
        
        require 'importcn.php';
        
        $lastModifiedTime = $currentModifiedTime;
    }
    
  
    sleep(10);
}
?>
