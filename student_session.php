<?php

if (!isset($_SESSION['user_email'])) {
    header("Location: ../Signin.php");
    exit();
}

if (!isset($_SESSION['control_number']) || empty($_SESSION['control_number'])) {
    header("Location: ../applicationform.php");
    exit();
}
