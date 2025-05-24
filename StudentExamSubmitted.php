<?php
include "dbcon.php";
session_start();

$control_number = $_SESSION['control_number'];


$sql1 = "SELECT * FROM useraccount WHERE control_number = ?";
$stmt1 = $conn->prepare($sql1);

if (!$stmt1) {
    die("Prepare failed (student query): " . $conn->error);
}

$stmt1->bind_param("s", $control_number);
$stmt1->execute();
$result1 = $stmt1->get_result();
$row1 = $result1->fetch_assoc();
$stmt1->close();


$sql2 = "SELECT * FROM student_examination_score WHERE control_number = ?";
$stmt2 = $conn->prepare($sql2);

if (!$stmt2) {
    die("Prepare failed (exam score query): " . $conn->error);
}

$stmt2->bind_param("s", $control_number);
$stmt2->execute();
$result2 = $stmt2->get_result();
$row2 = $result2->fetch_assoc();
$stmt2->close();

$sql3 = "SELECT * FROM admin_booking WHERE control_number = ?";

$stmt3 = $conn->prepare($sql3);

if (!$stmt3) {
    die("Prepare failed (booking query): " . $conn->error);
}

$stmt3->bind_param("s", $control_number);
$stmt3->execute();

$result3 = $stmt3->get_result();
$row3 = $result3->fetch_assoc();

$stmt3->close();


$total_logic_score = isset($row2['logic_id']) ? ($row2['logic_id'] / 17) * 100 : 0;
$total_math_score = isset($row2['math_id']) ? ($row2['math_id'] / 18) * 100 : 0;
$total_science_score = isset($row2['science_id']) ? ($row2['science_id'] / 17) * 100 : 0;
$total_reading_score = isset($row2['reading_id']) ? ($row2['reading_id'] / 18) * 100 : 0;
$Overall_score = isset($row2['total_score']) ? ($row2['total_score'] / 70) * 100 : 0;

$base_score = 70;
$total_score = isset($row2['total_score']) ? $row2['total_score'] : 0;

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Submitted</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="StudentExamSubmitted.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <style>
        .logo-and-campus {
            display: flex;
            align-items: center;
            padding: 10px;
        }

        .school-logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
            cursor: pointer;
        }

        .logo-and-campus h4 {
            margin: 0;
            font-size: 16px;
        }

        .bg-dark-green {
            background-color: #448b4f;
        }

        .sidebar {
            height: 100vh;
            color: white;
            font-family: var(--font-montserrat);
            width: 70px;
            transition: all 0.2s;
            position: fixed;
            z-index: 1;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            margin-left: 10px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #b2b2b3;
        }

        .sidebar.show {
            width: 250px;
        }

        .header {
            background: #f5f5f5;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
            color: black;
            padding: 10px;
        }

        .header h4 {
            margin-left: 70px;
        }

        .content {
            padding: 20px;
            transition: margin-left 0.3s;
            margin-left: 70px;
        }

        .content.sidebar-show {
            margin-left: calc(70px + 250px);
            transition: margin-left 0.3s ease;
        }

        .logout-button {
            font-family: var(--font-montserrat);
            padding: 8px 16px;
            background-color: #FFCD4D;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
        }

        .logout-button:hover {
            background-color: rgb(129, 122, 122);
            color: white;
        }

        .header-icons img {
            width: 37px;
            height: 37px;
            margin-bottom: 5px;
            margin-left: 10px;
            cursor: pointer;
        }

        .menu-icon {
            width: 24px;
            height: 24px;
            vertical-align: middle;
            margin-right: 10px;
        }

        .menu-label {
            display: none;
            vertical-align: middle;
        }

        .sidebar.show .menu-label {
            display: inline;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -70px;
                width: 70px;
            }

            .sidebar.show {
                left: 0;
                width: 250px;
            }

            .content {
                margin-left: 0;
            }

            .content.sidebar-show {
                margin-left: 250px;
            }

            .btn {
                background-color: #448b4f;
            }

            .btn:hover {
                background-color: #448b4f;
            }

            .iconsandLabel {
                font-family: var(--font-montserrat);
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="./public/CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
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
                <a href="StudentExamNotAvailable.php">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam</span>
                </a>
                <a href="StudentExamSubmitted.php" style="border-right: 5px solid white;">
                    <img src="./public/icon3.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Result</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Result</h4>
                <div class="header-icons">
                    <?php include "notif.php"; ?>
                    <script src="Redirect.js"></script>

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
            <div class="content" id="content">

                <!---------TEST COMPLETED-------->
                <?php

                $status1 = $row2['status'];
                if ($status1 == "PASSED") {
                    echo '<div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Congratulations!</h4>
                    <hr>
                    <p>You can now proceed to submit your requirements for enrollment. Scroll down to see the needed requirements.</p>
                </div>';
                } else if ($status1 == "FAILED") {
                    echo '<div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Thank you for trying!</h4>
                    <hr>
                    <p>Sorry, you cannot proceed to submit your requirements for enrollment. </p>
                </div>';
                }

                ?>

                <!---------CVSU IMUS CAMPUS-------->
                <div class="d-flex align-items-center">
                    <div class="vertical-line"></div>
                    <div class="header-title">
                        <h1>Cavite State University Imus Campus</h1>
                        <p>Online Entrance Exam</p>
                    </div>
                </div>

                <!---------SCORE BOARD-------->
                <div class="container py-5">
                    <div class="row">
                        <script type="text/javascript" src="progress.js"></script>
                        <div class="col-lg-12 mx-auto mb-5 text-white text-center">
                            <h1 class="display-4">Score Board</h1>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4">
                            <div class="bg-white rounded-lg p-5 shadow">
                                <h2 class="h6 font-weight-bold text-center mb-4">Logic</h2>
                                <div class="progress mx-auto" data-value='<?php echo number_format($total_logic_score, 2); ?>'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-primary"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-primary"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                        <div class="h2 font-weight-bold"><?php echo number_format($total_logic_score, 2) ?><sup class="small">%</sup></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4">
                            <div class="bg-white rounded-lg p-5 shadow">
                                <h2 class="h6 font-weight-bold text-center mb-4">Math</h2>
                                <div class="progress mx-auto" data-value='<?php echo number_format($total_math_score, 2) ?>'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-danger"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-danger"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                        <div class="h2 font-weight-bold"><?php echo number_format($total_math_score, 2) ?><sup class="small">%</sup></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4">
                            <div class="bg-white rounded-lg p-5 shadow">
                                <h2 class="h6 font-weight-bold text-center mb-4">Science</h2>
                                <div class="progress mx-auto" data-value='<?php echo number_format($total_science_score, 2) ?>'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-success"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-success"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                        <div class="h2 font-weight-bold"><?php echo number_format($total_science_score, 2) ?><sup class="small">%</sup></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4">
                            <div class="bg-white rounded-lg p-5 shadow">
                                <h2 class="h6 font-weight-bold text-center mb-1">Reading Comprehension</h2>
                                <div class="progress mx-auto" data-value='<?php echo number_format($total_reading_score, 2) ?>'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-warning"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-warning"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                        <div class="h2 font-weight-bold"><?php echo number_format($total_reading_score, 2) ?><sup class="small">%</sup></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(function() {
                        $(".progress").each(function() {
                            var value = $(this).attr('data-value');
                            var left = $(this).find('.progress-left .progress-bar');
                            var right = $(this).find('.progress-right .progress-bar');
                            if (value > 0) {
                                if (value <= 50) {
                                    right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                                } else {
                                    right.css('transform', 'rotate(180deg)')
                                    left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                                }
                            }
                        });

                        function percentageToDegrees(percentage) {
                            return percentage / 100 * 360;
                        }
                    });
                </script>

                <!---------YOUR TOTAL SCORE-------->
                <div class="col-lg-12 mx-auto mb-5 text-white text-center">
                    <h1 class="display-4">Your Total Score</h1>
                </div> <br>
                <div class="card-container">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p style="font-size: 60px;"><?php echo $total_score . " / " . $base_score ?></p>
                            </div>
                            <div class="card-back">
                                <p style="font-size: 60px;"><?php echo number_format($Overall_score, 2) ?>%</p>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <!---------METRICS-------->
                <section class=" text-center">
                    <table class="table table-bordered">
                        <thead style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.10);">
                            <tr>
                                <th scope="col">Date</th>
                                <!-- <th scope="col">Duration</th> -->
                                <th scope="col">Start at</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $row3['date'] ?></td>
                                <!-- <td><?php echo $row2['duration'] ?></td> -->
                                <td><?php echo $row3['time'] ?></td>
                                <td><?php echo $row2['status'] ?></td>
                            </tr>
                        </tbody>
                    </table>

                </section>
                <div class="view-exam-sheet" onclick="viewExamSheet()">View Result</div>
                <img class="pngtree-test-icon-png-image-65" src="./public/pngtreetesticonpngimage-6591706-1@2x.png">
                <!---------EXAM SHEET-------->


                <!---------REQUIREMENTS-------->
                <?php


                $stmt_status = $conn->prepare("SELECT status FROM student_examination_score WHERE control_number = ?");
                $stmt_status->bind_param("i", $student_id);
                $stmt_status->execute();
                $stmt_status->bind_result($status);
                $stmt_status->fetch();


                $status1 = $row2['status'];

                echo '';
                if ($status1 == "PASSED") {


                    echo '
                        <!---------REQUIREMENTS-------->
                        <section>
                            <h2>Requirements to Enroll</h2>
                            <h4 class="enroll">To proceed with registration, you must meet the enrollment requirements</h4><br>
                            <h4 class="enroll">
                                ● Form 138 <br>
                                ● Good Moral <br>
                                ● NOA <br>
                                ● Medical Clearance
                            </h4>
                        </section>
                        ';
                } else {

                    echo '';
                }



                ?>

            </div>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            var schoolName = document.querySelector('.SchoolName');
            schoolName.style.display = 'none';
            sidebar.classList.toggle('show');
            content.classList.toggle('sidebar-show');
            if (sidebar.classList.contains('show')) {
                schoolName.style.display = 'block';
            } else {
                schoolName.style.display = 'none';
            }
        }

        function viewExamSheet() {
            window.open('generate_pdf.php', '_blank');
        }
    </script>
</body>

</html>