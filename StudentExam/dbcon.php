<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'onlineexam';

$conn = mysqli_connect($server, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
} else {
    // Uncomment the line below during development to verify connection
    // echo "Successfully connected to database.";
}
?>
