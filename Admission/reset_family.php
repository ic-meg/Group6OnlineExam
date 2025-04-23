<?php
include 'dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'reset') {
        $email = $_SESSION['user_email'];

        $stmt = $conn->prepare("DELETE FROM familybackground WHERE userID = (SELECT userID FROM useraccount WHERE email = ?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Success";
        } else {
            echo "Error";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
