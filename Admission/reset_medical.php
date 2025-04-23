<?php
include 'dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'reset') {
        if (!isset($_SESSION['user_email'])) {
            echo 'User not logged in.';
            exit();
        }

        $email = $_SESSION['user_email'];
        echo $email;
        // Prepare and execute the query
        $stmt = $conn->prepare("
            DELETE FROM medicalhistory 
            WHERE userID = (
                SELECT userID 
                FROM useraccount 
                WHERE email = ?
            )
        ");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Success";
        } else {
            echo "No rows affected or error occurred.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
