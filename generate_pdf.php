<?php
include 'dbcon.php';
require 'C:\xampp\htdocs\vendor\autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:/Users/Meg Angeline Fabian/phpmailer/vendor/autoload.php';


use Dompdf\Dompdf;

session_start();

$control_number = $_SESSION['control_number'];

$dompdf = new Dompdf();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM student_examination_score WHERE control_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $control_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_logic_score = $row['logic_id'];
    $total_math_score = $row['math_id'];
    $total_science_score = $row['science_id'];
    $total_reading_score = $row['reading_id'];
    $status = $row['status'];  
    $total_score = $row['total_score'];
} else {
    echo "Make sure you took the exam, in order to generate the PDF file of your exam result. ";
    exit;
}

$sql = "SELECT firstname, lastname, email FROM imported_control_numbers WHERE control_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $control_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $personalData = $result->fetch_assoc();
    $firstname = $personalData['firstname'];
    $lastname = $personalData['lastname'];
    $email = $personalData['email'];
} else {
    echo "No personal information found.";
    exit;
}

$conn->close();

$percentage = ($total_score / 70) * 100;
$formatted_percentage = number_format($percentage, 2) . '%'; 
$date = date('Y-m-d');

$html = '
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"/>
    <style>
        body {
            font-family: "Montserrat", Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 120px;
            height: auto;
            margin-bottom: 10px;
        }
        .header h3 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }
        .header p {
            margin: 0;
            font-size: 16px;
            color: #777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total-row {
            background-color: #e0e0e0;
            font-weight: bold;
        }
        .disclaimer {
            margin-top: 20px;
            padding: 10px;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #ddd;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="CVSU_LOGO.png" alt="Logo">
            <h3>Cavite State University - Imus Campus</h3>
            <p>Online Entrance Exam Result</p>
        </div>
        <div class="content">
            <table>
                <tbody>
                    <tr>
                        <td><strong>Examinee Name:</strong> ' . htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname) . '</td>
                        <td><strong>Control Number:</strong> ' . htmlspecialchars($control_number) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong> ' . htmlspecialchars($email) . '</td>
                        <td><strong>Date:</strong> ' . htmlspecialchars($date) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Result:</strong> ' . htmlspecialchars($status) . '</td>
                        <td><strong>Percentage:</strong> ' . htmlspecialchars($formatted_percentage) . '</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Logic</td>
                        <td>' . number_format($total_logic_score) . '/17</td>
                    </tr>
                    <tr>
                        <td>Math</td>
                        <td>' . number_format($total_math_score) . '/18</td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td>' . number_format($total_science_score) . '/17</td>
                    </tr>
                    <tr>
                        <td>Reading Comprehension</td>
                        <td>' . number_format($total_reading_score) . '/18</td>
                    </tr>
                    <tr class="total-row">
                        <td>Total Score</td>
                        <td>' . number_format($total_score) . '/70</td>
                    </tr>
                </tbody>
            </table><br>
            <div class="disclaimer">
                <p><strong>Disclaimer:</strong> This document provides the results of the examinee\'s online exam at Cavite State University - Imus Campus. While we strive for accuracy, please contact the examination office for official results or any concerns.</p>
            </div>
        </div>
    </div>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("ExamResult$control_number.pdf", array("Attachment" => 0)); 
$pdfFilePath = __DIR__ . "/ExamResult_$control_number.pdf";
file_put_contents($pdfFilePath, $dompdf->output());



function sendemail_notify($email, $pdfFilePath) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'fabian.megangeline2003@gmail.com';
        $mail->Password = 'upqj akck ojis wmsa'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('fabian.megangeline2003@gmail.com', 'Online Entrance Exam');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "CvSU Online Entrance Exam Result";
        $mail->Body = "
            <p><b>Hello,</b></p>
            <p>We are pleased to inform you that your exam result is now available:</p>
            <p>Please find your exam result PDF attached to this email.</p>
            <p>If you have any questions or need further assistance, feel free to contact us.</p>
            <p>Best regards,<br>The CvSU Online Entrance Exam Team</p>
        ";

        $mail->addAttachment($pdfFilePath); 

        $mail->send();
    
    } catch (Exception $e) {
        echo "<p>Email could not be sent to: " . htmlspecialchars($email) . "</p>";
        echo "<p>Error: {$mail->ErrorInfo}</p>";
    }
}

sendemail_notify($email, $pdfFilePath);


unlink($pdfFilePath);
?>
