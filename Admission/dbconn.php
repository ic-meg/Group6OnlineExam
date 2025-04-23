
<?php 

    $server = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'admission';

    $conn = mysqli_connect($server,$username, $password, $dbname);

    if(mysqli_connect_error()){
        echo 'Connection Failed:  ' . mysqli_connect_error();
        exit;
    }else{
     
    }

?>