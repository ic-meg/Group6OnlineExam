<?php 

include 'dbcon.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once __DIR__ . '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->load();

$EmailAddress = $_SESSION['user_email'];

function sendemail_notify($EmailAddress, $formatted_date, $formatted_time, $actionType){
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom($_ENV['MAIL_USERNAME'], 'Online Entrance Exam');
        $mail->addAddress($EmailAddress); 

        $mail->isHTML(true);
        $mail->Subject = "CvSU Online Entrance Exam Schedule";

     
        if ($actionType === 'update') {
            $mail->Body = "
                <p><b>Hello,</b></p>
                <p>We are writing to inform you that your exam schedule has been updated:</p>
                <ul>
                    <li><b>Date:</b> $formatted_date</li>
                    <li><b>Time:</b> $formatted_time</li>
                    <li><b>Duration:</b> One hour</li>
                </ul>
                <p>Please ensure that you arrive 30 minutes prior to the exam start time. Being punctual is important.</p>
                <p>If you have any questions or need further assistance, feel free to contact us.</p>
                <p>Best regards,<br>The CvSU Online Entrance Exam Team</p>
            ";
        } else {
            $mail->Body = "
                <p><b>Hello,</b></p>
                <p>We are writing to inform you of the schedule for your upcoming exam:</p>
                <ul>
                    <li><b>Date:</b> $formatted_date</li>
                    <li><b>Time:</b> $formatted_time</li>
                    <li><b>Duration:</b> One hour</li>
                </ul>
                <p>Please ensure that you arrive 30 minutes prior to the exam start time. Being punctual is important.</p>
                <p>If you have any questions or need further assistance, feel free to contact us.</p>
                <p>Best regards,<br>The CvSU Online Entrance Exam Team</p>
            ";
        }

        $mail->send();
    } catch (Exception $e) {
        echo "<p>Email could not be sent to: " . htmlspecialchars($EmailAddress) . "</p>";
        echo "<p>Error: {$mail->ErrorInfo}</p>";
    }
}


$sqlFetch = "SELECT * FROM admin_booking WHERE control_number = ?";
$stmtFetch = $conn->prepare($sqlFetch);
$stmtFetch->bind_param("s", $control_number);
$stmtFetch->execute();
$result = $stmtFetch->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $time = $row['time'];
    $formatted_time = date("g:i A", strtotime($time));

    $original_date = $row['date'];
    $formatted_date = date("l, F j, Y", strtotime($original_date));
}

$stmtFetch->close();
$conn->close();
?>