<?php
session_start();
include "dbcon.php";

if (!isset($_SESSION['control_number'])) {
    die("User session not set.");
}

$control_number = $_SESSION['control_number'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_student = "SELECT * FROM useraccount WHERE control_number = ?";
$stmt_student = $conn->prepare($sql_student);
if (!$stmt_student) {
    die("Prepare failed (student query): (" . $conn->errno . ") " . $conn->error);
}
$stmt_student->bind_param("s", $control_number);
$stmt_student->execute();
$result_student = $stmt_student->get_result();
if (!$result_student) {
    die("Execute failed (student query): (" . $stmt_student->errno . ") " . $stmt_student->error);
}

if ($result_student->num_rows > 0) {
    $row_student = $result_student->fetch_assoc();


    $sql_schedule = "SELECT Schedule, date, time FROM admin_booking WHERE control_number = ?";
    $stmt_schedule = $conn->prepare($sql_schedule);
    if (!$stmt_schedule) {
        die("Prepare failed (schedule query): (" . $conn->errno . ") " . $conn->error);
    }
    $stmt_schedule->bind_param("s", $control_number);
    $stmt_schedule->execute();
    $result_schedule = $stmt_schedule->get_result();
    if (!$result_schedule) {
        die("Execute failed (schedule query): (" . $stmt_schedule->errno . ") " . $stmt_schedule->error);
    }

    if ($result_schedule->num_rows > 0) {
        $row_schedule = $result_schedule->fetch_assoc();
        $schedule_status = $row_schedule['Schedule'];
        $schedule_date = $row_schedule['date'];
        $schedule_time = $row_schedule['time'];
        date_default_timezone_set('Asia/Manila'); // Set the timezone to PH time

        $formatted_time = date('g:i A', strtotime($schedule_time));

        if ($schedule_status == 'Scheduled') {
            $scheduled_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $schedule_date . ' ' . $schedule_time);
            $current_datetime = new DateTime();

            if ($current_datetime > $scheduled_datetime) {

                $sql_update_exam_status = "UPDATE admin_booking SET Schedule = 'Missed' WHERE control_number = ?";
                $stmt_update_exam_status = $conn->prepare($sql_update_exam_status);
                $stmt_update_exam_status->bind_param("s", $control_number);
                $stmt_update_exam_status->execute();


                $missed_message = "Sorry, you missed your scheduled exam on " . date('F j, Y', strtotime($schedule_date)) . ' at ' . htmlspecialchars($formatted_time);
            } else {
                $exam_window_start = clone $scheduled_datetime;
                $exam_window_end = clone $scheduled_datetime;
                $exam_window_start->modify('-30 minutes');
                $exam_window_end->modify('+30 minutes');

                if (
                    $current_datetime->format('Y-m-d') == $schedule_date &&
                    $current_datetime >= $exam_window_start && $current_datetime <= $exam_window_end
                ) {
                    echo "<script>window.location.href = 'http://localhost/OnlineExam/StudentExam/StudentExamDescription.php';</script>";
                    exit();
                }
                $missed_message = '';
            }
        } else {
            $missed_message = '';
        }
    } else {
        $schedule_status = '';
        $schedule_date = '';
        $schedule_time = '';
        $formatted_time = '';
    }

    $stmt_schedule->close();
} else {
    $schedule_status = '';
    $schedule_date = '';
    $schedule_time = '';
    $formatted_time = '';
}

$stmt_student->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal Exam Not Available</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <script src="Redirect.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="SPENA.css">
</head>
<style>
    .header h4 {
        font-family: var(--font-montserrat);
    }
</style>

<body>
    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none;">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="StudentDashboard.php">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="StudentProfile.php">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="StudentExamNotAvailable.php" style="border-right: 5px solid white;">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam</span>
                </a>
                <a href="StudentExamSubmitted.php">
                    <img src="./public/icon3.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Result</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Exam</h4>
                <div class="header-icons">
                    <?php include "notif.php"; ?>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                    <script src="redirect.js"></script>
                    <button class="Btn">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <div class="text" onclick="logoutRedirect()">Logout</div>
                    </button>
                </div>
            </div>
            <div class="content d-print-flex" id="content">
                <div class="d-flex align-items-center">
                    <div class="vertical-line"></div>
                    <div class="header-title">
                        <h1>Cavite State University Imus Campus</h1>
                        <p>Online Entrance Exam</p>
                    </div>
                </div><br><br><br>
                <div class="notice-container">
                    <div class="notice">
                        <div class="notice-header bg-dark-green">
                            <h5>Notice</h5>
                        </div>
                        <div class="notice-body">
                            <img src="./public/image-8@2x.png" alt="Notice Icon" class="notice-icon">
                            <br>
                            <!-- <h5>Your exam schedule has not yet been confirmed.</h5> -->
                            <?php
                            if (!empty($missed_message)) {
                                echo '<h5>' . $missed_message . '</h5>';
                            } else {
                                if ($schedule_status == 'Processed') {
                                    echo '<h5>Your exam schedule is currently being processed.</h5>';
                                } elseif ($schedule_status == 'Scheduled') {
                                    echo '<h5>Your exam is scheduled for ' . date('F j, Y', strtotime($schedule_date)) . ' at ' . htmlspecialchars($formatted_time) . '.</h5>';
                                    echo '<p>Please wait for further instructions and arrive at least 30 minutes before the scheduled time.</p>';
                                } elseif ($schedule_status == 'Missed') {
                                    echo '<h5>Sorry, you missed your exam scheduled for ' . date('F j, Y', strtotime($schedule_date)) . ' at ' . htmlspecialchars($formatted_time) . '.Please contact the administration for further instructions.</h5>';
                                } else if ($schedule_status == 'Completed' || $schedule_status == 'FAILED') {
                                    echo '<h5>Congratulations, you completed your exam. See the <a href="StudentExamSubmitted.php">results.</a></h5>';
                                } else {

                                    echo '<h5>Your exam schedule has not yet been confirmed.</h5>';
                                    echo '<h5>Please wait for your schedule.</h5>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            var schoolName = document.querySelector('.SchoolName');

            sidebar.classList.toggle('show');
            content.classList.toggle('sidebar-show');

            if (sidebar.classList.contains('show')) {
                schoolName.style.display = 'block';
            } else {
                schoolName.style.display = 'none';
            }
        }
    </script>
</body>

</html>