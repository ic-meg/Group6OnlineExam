<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'onlineexam';

$conn = mysqli_connect($server, $username, $password, $dbname);


if (mysqli_connect_error()) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
} else {
    
    // echo "Successfully connected to database.";
}
?>
