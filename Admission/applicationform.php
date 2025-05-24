    <?php
   
    include 'dbconn.php';

    session_start();

    if (!isset($_SESSION['user_email'])) {
        header("Location: ../Signin.php");
        exit();
    }

    $email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';

    
    $query = "SELECT userID FROM useraccount WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();


    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $userID = $user['userID'];


    $tables = [
        'admissioninfo' => 'admissioninfo',
        'personalinfo' => 'personalinfo',
        'familybackground' => 'familybackground',
        'educationalbackground' => 'educationalbackground',
        'medicalhistory' => 'medicalhistory'
    ];


    $completedSections = [];

    foreach ($tables as $key => $table) {
        $checkQuery = "SELECT COUNT(*) as count FROM $table WHERE userID = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("i", $userID);

        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc()['count'];

        if ($count > 0) {
            $completedSections[$key] = true;
        } else {
            $completedSections[$key] = false;
        }
    }
    $allCompleted = !in_array(false, $completedSections);


    function generateControlNumber()
    {
        return str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);
    }

    if ($allCompleted) {
        $checkControlQuery = "SELECT control_number FROM useraccount WHERE userID = ?";
        $stmt = $conn->prepare($checkControlQuery);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $existingControl = $result->fetch_assoc();

        if (!$existingControl['control_number']) {
            $controlNumber = generateControlNumber();
            $updateQuery = "UPDATE useraccount SET control_number = ? WHERE userID = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("si", $controlNumber, $userID);
            $stmt->execute();
        } else {
            $controlNumber = $existingControl['control_number'];
        }
    } else {
        $controlNumber = null;
    }
    //Programm

    $programQuery = "
    SELECT ProgramName, userID 
    FROM admissioninfo 
    WHERE userID = '$userID'
        ";
    $programResult = $conn->query($programQuery);

    if ($programResult->num_rows > 0) {
        $programRow = $programResult->fetch_assoc();
        $programName = $programRow['ProgramName'];
        $userID = $programRow['userID'];
    } else {
        $programName = "Not Found";
        $userID = null;
    }


    if ($userID) {
        $userQuery = "
                SELECT Name 
                FROM useraccount 
                WHERE userID = '$userID'
            ";
        $userResult = $conn->query($userQuery);

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $userName = $userRow['Name'];
        } else {
            $userName = "Not Found";
        }
    } else {
        $userName = "Not Found";
    }
    $conn->close();


    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>CvSU IMUS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap">
    <link rel="stylesheet" href="cvsu_complete.css">
</head>


<body>
    <?php
    include 'Admissioninfoexcel.php';
    include 'PersonalInfoExcel.php';
    include 'FamilyBackgroundExcel.php';
    include 'EducationalBackgroundExcel.php';
    include 'MedicalExcel.php';
    ?>

    <?php
    include 'Header.php';
    include "dbconn.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';


    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();  
    
    function sendemail_with_control_number($EmailAddress, $control_number)
    {
        $subject = "Control Number Assignment";
        $message = "Dear Examinee,<br><br>";
        $message .= "Thank you for completing your requirements.<br>";
        $message .= "Your control number is:<br>";
        $message .= "<strong>$control_number</strong><br><br>";
        $message .= "Please use this control number for any further communication or access to our Online Exam.<br>";
        $message .= "You can access the online exam at the following link:<br>";
        $message .= "<a href='http://localhost/OnlineExam/index.php'>Online Exam Portal</a><br><br>";
        $message .= "If you did not register with us, please ignore this email.<br><br>";
        $message .= "Best regards,<br>Cavite State University - Imus Campus";


        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($_ENV['MAIL_USERNAME'], 'Online Entrance Exam');;
            $mail->addAddress($EmailAddress);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if (isset($_POST['sendControlNumber'])) {
        $EmailAddress = $_POST['EmailAddress'];


        $check_query = "SELECT control_number FROM useraccount WHERE email = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("s", $EmailAddress);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $control_number = $row['control_number'];

            if ($control_number) {

                sendemail_with_control_number($EmailAddress, $control_number);


                $update_query = "UPDATE useraccount SET control_number = ? WHERE email = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param("ss", $control_number, $EmailAddress);
                $update_stmt->execute();


                echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Control Number Sent!',
                text: 'Your control number has been sent to your email address.',
                confirmButtonColor: '#448b4f',
                confirmButtonTextColor: '#ffffff'
            }).then(function() {
                window.location.href = '../index.php';
            });
            </script>";
            } else {
                echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Control number is not available for this email.',
                confirmButtonColor: '#448b4f',
                confirmButtonTextColor: '#ffffff'
            }).then(function() {
                window.location.href = 'Signup.php';
            });
            </script>";
            }
        } else {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Email does not exist.',
            confirmButtonColor: '#448b4f',
            confirmButtonTextColor: '#ffffff'
        }).then(function() {
            window.location.href = 'Signup.php';
        });
        </script>";
        }
    }
    ?>

    <?php
    require '../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    include 'dbconn.php';

    $spreadsheet = new Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();

    $worksheet->setCellValue('A1', 'User ID');
    $worksheet->setCellValue('B1', 'Control Number');
    $worksheet->setCellValue('C1', 'Email');


    $query = "SELECT userID, control_number, email FROM useraccount WHERE control_number IS NOT NULL AND control_number <> ''";
    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }


    $rowNumber = 2;
    while ($row = $result->fetch_assoc()) {
        $worksheet->setCellValue('A' . $rowNumber, $row['userID']);
        $worksheet->setCellValue('B' . $rowNumber, $row['control_number']);
        $worksheet->setCellValue('C' . $rowNumber, $row['email']);
        $rowNumber++;
    }


    $filename = 'C:\xampp\htdocs\OnlineExam\Admission\control_numbers.xlsx'; // Desired filename
    $writer = new Xlsx($spreadsheet);


    if (file_exists($filename)) {
        unlink($filename);
    }

    $writer->save($filename);

    // echo "Data exported successfully to $filename";


    $conn->close();
    ?>
    <div class="content" id="content">
        <div class="d-flex align-items-center">
            <div class="row">
                <div class="col-12 pl-5">
                    <div class="header-title">
                        <h1>Application Form for Admission</h1>
                        <p>1st Sem 2024-2025</p>
                        <p class="additional-info">Please fill out the required fields in the application. Once you finalize, an email should be sent to you for your control number. You need the control number for accessing our online system.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="exam-notice">
                <div class="branch-overlay">Branch: CvSU-Imus</div>
                <div class="inner-notice">
                    <div class="image-text-container">
                        <img src="img/processed.png" alt="Progressed Image" class="progressed">
                        <div class="image-text">Control Number</div>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="image-text-container">
                        <img src="img/processed.png" alt="Progressed Image" class="progressed">
                        <div class="image-text">Submission Schedule</div>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="image-text-container">
                        <img src="img/processed.png" alt="Progressed Image" class="progressed">
                        <div class="image-text">Exam Schedule</div>
                    </div>
                    <div class="horizontal-line-done"></div>
                    <div class="image-text-container">
                        <img src="img/done.png" alt="Progressed Image" class="progressed">
                        <div class="image-text">Admission Result</div>
                    </div>
                </div>
            </div>

            <div class="main-content">
                <div class="left-content">
                    <div class="information-sections">
                        <div class="info-item">
                            <img src="<?php echo $completedSections['admissioninfo'] ? 'img/done.png' : 'img/admission.png'; ?>" alt="Admission Information" class="info-icon">
                            <span class="info-text"> <a href="AdmissionInformation.php">Admission Information</a></span>
                        </div>
                    </div>

                    <div class="information-sections">
                        <div class="info-item">
                            <img src="<?php echo $completedSections['personalinfo'] ? 'img/done.png' : 'img/personal.png'; ?>" alt="Personal Information" class="info-icon">
                            <span class="info-text"> <a href="personal.php">Personal Information</a></span>
                        </div>
                    </div>

                    <div class="information-sections">
                        <div class="info-item">
                            <img src="<?php echo $completedSections['familybackground'] ? 'img/done.png' : 'img/family.png'; ?>" alt="Family Background Information" class="info-icon">
                            <span class="info-text"> <a href="family.php">Family Background</a></span>
                        </div>
                    </div>

                    <div class="information-sections">
                        <div class="info-item">
                            <img src="<?php echo $completedSections['educationalbackground'] ? 'img/done.png' : 'img/educational.png'; ?>" alt="Educational Background Information" class="info-icon">
                            <span class="info-text"> <a href="educational.php">Educational Background</a></span>
                        </div>
                    </div>

                    <div class="information-sections">
                        <div class="info-item">
                            <img src="<?php echo $completedSections['medicalhistory'] ? 'img/done.png' : 'img/medical.png'; ?>" alt="Medical History    Information" class="info-icon">
                            <span class="info-text"><a href="medical.php">Medical History Information</a> </span>
                        </div>
                    </div>
                </div>

                <!-- New Section -->

                <div class="notice-section">
                    <div class="notice-text">
                        <?php if ($allCompleted): ?>
                            <h6>You cannot modify your application info once you have your control number.</h6>

                            <hr>
                            <p>Please get your control number by clicking the button below</p>

                            <button type="button" class="button type1" data-toggle="modal" data-target="#finalizeModal">
                                <span class="btn-txt">ControlNumber</span>
                            </button>

                            <hr>
                            For questions and technical problems,
                            <br>
                            <a href="#">Contact Admission Office</a>
                        <?php else: ?>
                            Please complete the sections to get your control number and your application form.
                            <br><br>
                            For questions and technical problems,
                            <br>
                            <a href="#">Contact Admission Office</a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <!-- Modal for Finalizing Submission -->
            <div class="modal fade" id="finalizeModal" tabindex="-1" role="dialog" aria-labelledby="finalizeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="finalizeModalLabel">CvSU Online Student Admission System</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Make sure all the information is correct. <br> <i>This will be the final data in system.</i></p>
                            <p><strong> <?php echo $userName; ?></strong></p>
                            <p><strong>CVSU-IMUS</strong></p>
                            <p><strong> <?php echo $programName; ?></strong></p>
                            <p>If there are errors, kindly reset the section with the mistake. Are you sure you want to get control number?</p>
                        </div>
                        <div class="modal-footer">
                            <form id="controlNumberForm" method="POST" action="applicationform.php">
                                <input type="hidden" name="sendControlNumber" value="1">
                                <input type="hidden" name="EmailAddress" value="<?php echo $email; ?>">
                                <button type="submit" class="btn btn-primary">Get Control Number</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>