<?php 
    include "dashboard.php";
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Entrance Exam | Examinee Dashboard</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    
    <link rel="stylesheet" href="./StudentPortalDashboard.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" />
    

</head>
<style>
        .header h4 {
            font-family: var(--font-montserrat);
        }


</style>

<body>
    <!---------- NAV BAR ------------>
    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none;">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="StudentDashboard.php" style="border-right: 5px solid white;">
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
                <a href="StudentExamSubmitted.php">
                    <img src="./public/icon3.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Result</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Examinee Dashboard</h4>
                <div class="header-icons">
                <?php include "notif.php"?>


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

                <!---------- CLOVER BOX ------------>
                    <div class="jumbotron jumbotron-fluid">
                    <div class="container"></p>

                       
                            <img src="./public/clover-1@2x.png" alt="" class="clover" />
                            <?php if ($schedule_status == 'Processed'): ?>
                            <h1 class="display-4">Your schedule is currently being processed</h1>
                            <p class="here">Please wait for further instructions.</p>
                            <?php elseif ($schedule_status == 'Scheduled'): ?>
                                <h1 class="display-4">Welcome to CvSU - Imus Campus Online Entrance Exam</h1>
                                <?php if (!empty($missed_message)): ?>
                                    <p class="here"><?php echo $missed_message; ?></p>
                                <?php else: ?>
                                    <p class="here">Your exam is scheduled for <?php echo date('F j, Y', strtotime($schedule_date)). ' at ' . htmlspecialchars($formatted_time)  ?></p>
                                <?php endif; ?>
                            <?php elseif ($schedule_status == 'Missed'): ?>
                                <h1 class="display-4">Welcome to CvSU - Imus Campus Online Entrance Exam</h1>
                                <p class="here">Sorry, you missed your exam scheduled for <?php echo date('F j, Y', strtotime($schedule_date)) . ' at ' . htmlspecialchars($formatted_time) ?>. Please contact the administration for further instructions.</p>
                                <?php elseif ($schedule_status == 'Completed'): ?>
                                    <h1 class="display-4">Welcome to CvSU - Imus Campus Online Entrance Exam</h1>
                                    <h1 class="here">Congratulations, you have successfully completed your exam.</h1>
                            <?php else: ?>
                                <h1 class="display-4">Welcome to CvSU - Imus Campus Online Entrance Exam</h1>
                                <p class="here">Please wait for further announcements here.</p>
                                <!-- <p class="here">Click <a href="StudentRequirements.php"><em>here</em></a> to send your requirements.</p> -->
                            <?php endif; ?> 
                                                    
                            
                <!-- <h1 class="display-4">Welcome to CvSU - Imus Campus Online Entrance Exam</h1>
                <p class="here">Click <a href="StudentRequirements.php"><em>here</em></a> to send your requirements.</p> -->
          
                <!-- <h1 class="display-4">Your exam schedule is being processed.</h1>
                <p class="here">Please wait for further instructions.</p> -->
          
                        </div>
                    </div>
                <!---------- REPORT ------------>
                

                <div class="card text-center">
                    <div class="card-header">Report</div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">

                                    <div class="card-body" >
                                    <div class="flex-container">
                                        <div class="card border-success mb-3" style="max-width: 18rem;">
                                            <div class="card-header">Percentage of Examinees Passed</div>
                                                <div class="card-body text-success">
                                                    <div class="ellipse-802">
                                                        <!-- <div class="ellipse-80-child2"></div>
                                                        <div class="ellipse-80-child3"></div> -->
                                                        <div class="div64">
                                                            <?php
                                                            
                                                                echo number_format(($c_p_row['tbl_count'] / 100) * 100);
                                                            
                                                            ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <span>
                                            Indicates the percentage of candidates who successfully passed the examination.
                                        </span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">

                                    <div class="card-body" >
                                    <div class="flex-item">
                                        <div class="card border-danger mb-3" style="max-width: 18rem;">
                                            <div class="card-header">Percentage of Examinees Failed</div>
                                                <div class="card-body text-danger">
                                                    <div class="ellipse-382">
                                                        <!-- <div class="ellipse-38-child2"></div>
                                                        <div class="ellipse-38-child3"></div> -->
                                                        <div class="div65">

                                                            <?php
                                                            
                                                                echo number_format(($c_f_row['tbl_count'] / 100) * 100);
                                                            
                                                            ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <span>
                                            Indicates the percentage of candidates who didn't pass the exam.
                                        </span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                                    </div>
                            </div>

                <br>

                <!----------SCHEDULE EXAM ------------>
                <div class="event-schedule-area-two bg-color pad100">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-center">
                                    <div class="title-text">
                                        <h2>Online Exam Schedule</h2>
                                    </div>
                                <p>
                                    Here, it outlines the dates, sessions, venues, and subjects for upcoming exams,<br>
                                    ensuring examinees know when and where their assessments will take place.
                                </p>
                                </div>
                            </div> <!-- col end-->
                        </div> <!-- row end-->


                    <div class="row" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="col-lg-12">
                            <!-- nav-->
                            <ul class="nav custom-tab" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-taThursday" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Category 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Category 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Category 3</a>
                                </li>
                                <li class="nav-item d-none d-lg-block">
                                    <a class="nav-link" id="sunday-tab" data-toggle="tab" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false">Category 4</a>
                                </li>
                            </ul>

                            <!-- day 1-->
                            <div class="tab-content" id="myTabContent" >
                                <div class="tab-pane fade active show" id="home" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">Date</th>
                                                    <th scope="col">Proctor</th>
                                                    <th scope="col">Session</th>
                                                    <th scope="col">Venue</th>
                                                    <th class="text-center" scope="col">Subject</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="inner-box">
                                                    <th scope="row">
                                                        <div class="event-date">
                                                            <span>17</span>
                                                            <p>June</p>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="event-img">
                                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="event-wrap">
                                                            <h3><a href="#">Instructor Name</a></h3>
                                                            <div class="meta">
                                                                <div class="organizers">
                                                                    <a href="#">Gem Marie</a>
                                                                </div>
                                                                <div class="categories">
                                                                    <a href="#">-</a>
                                                                </div>
                                                                <div class="time">
                                                                    <span>08:00 AM - 09:00 AM 1h 00'</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="r-no">
                                                            <span>Zoom</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="primary-btn">
                                                            <a class="btn btn-primary" href="StudentPortalExamNotAvailable.html">Not yet available</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <!-- day 2-->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Date</th>
                                                <th scope="col">Proctor</th>
                                                <th scope="col">Session</th>
                                                <th scope="col">Venue</th>
                                                <th class="text-center" scope="col">Subject</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="inner-box">
                                                <th scope="row">
                                                    <div class="event-date">
                                                        <span>18</span>
                                                        <p>June</p>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="event-img">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="event-wrap">
                                                        <h3><a href="#">Proctor</a></h3>
                                                        <div class="meta">
                                                            <div class="organizers">
                                                                <a href="#">Gem Marie</a>
                                                            </div>
                                                            <div class="categories">
                                                                <a href="#">-</a>
                                                            </div>
                                                            <div class="time">
                                                                <span>08:30 AM - 09:30 AM 1h 00'</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="r-no">
                                                        <span>Zoom</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="primary-btn">
                                                        <a class="btn btn-primary" href="StudentPortalExamNotAvailable.html">Not yet available</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- day 3-->
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Date</th>
                                                <th scope="col">Proctor</th>
                                                <th scope="col">Session</th>
                                                <th scope="col">Venue</th>
                                                <th class="text-center" scope="col">Subject</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="inner-box">
                                                <th scope="row">
                                                    <div class="event-date">
                                                        <span>19</span>
                                                        <p>June</p>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="event-img">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="event-wrap">
                                                        <h3><a href="#">Instructor Name</a></h3>
                                                        <div class="meta">
                                                            <div class="organizers">
                                                                <a href="#">Gem Marie</a>
                                                            </div>
                                                            <div class="categories">
                                                                <a href="#">-</a>
                                                            </div>
                                                            <div class="time">
                                                                <span>08:00 AM - 09:00 AM 1h 00'</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="r-no">
                                                        <span>Zoom</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="primary-btn">
                                                        <a class="btn btn-primary" href="StudentPortalExamNotAvailable.html">Not yet available</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- day 4-->
                            <div class="tab-pane fade" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Date</th>
                                                <th scope="col">Proctor</th>
                                                <th scope="col">Session</th>
                                                <th scope="col">Venue</th>
                                                <th class="text-center" scope="col">Subject</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="inner-box">
                                                <th scope="row">
                                                    <div class="event-date">
                                                        <span>20</span>
                                                        <p>June</p>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="event-img">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="event-wrap">
                                                        <h3><a href="#">Instructor Name</a></h3>
                                                        <div class="meta">
                                                            <div class="organizers">
                                                                <a href="#">Gem Marie</a>
                                                            </div>
                                                            <div class="categories">
                                                                <a href="#">-</a>
                                                            </div>
                                                            <div class="time">
                                                                <span>09:00 AM - 10:00 AM 1h 00'</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="r-no">
                                                        <span>Zoom</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="primary-btn">
                                                        <a class="btn btn-primary" href="StudentPortalExamNotAvailable.html">Not yet available</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- table-responsive -->
                            </div> <!-- tab-pane fade -->
                       </div> <!-- tab-content -->
                    </div> <!-- col-lg-12 -->
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- event-schedule-area-two bg-color pad100 -->
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript"></script>

        <br>
        <br>

                <!---------- POTENTIAL COURSES ------------>
                <div class="container" style="border: 1px solid var(--color-darkgreen); padding: 20px; box-shadow: 5px 10px #888888;">
                    <h2 style="font-family: var(--font-montserrat);">Potential Courses</h2>
                    <table class="table table-bordered" style="font-family: var(--font-montserrat);">
                        <thead style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <tr>
                                <th>Courses</th>
                                <th>Subject</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Information Technology</td>
                                <td>Logic</td>
                                <td>80%</td>
                            </tr>
                            <tr>
                                <td>Education</td>
                                <td>Reading Comprehension</td>
                                <td>90%</td>
                            </tr>
                            <tr>
                                <td>Forensic</td>
                                <td>Science</td>
                                <td>85%</td>
                            </tr>
                            <tr>
                                <td>Computer Science</td>
                                <td>Math</td>
                                <td>95%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br>
                <br>

                <!---------- EXAM RESULTS SUMMARY ------------>
                <div class="container" style="border: 1px solid var(--color-darkgreen); padding: 20px; box-shadow: 5px 10px #888888;">
                    <h2 style="font-family: var(--font-montserrat);">Exam Results Summary</h2>
                    <table class="table table-bordered" style="font-family: var(--font-montserrat);">
                        <thead style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <tr>
                                <th>Subject</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Logic</td>
                                <td><?php echo $row2['logic_id']?></td>
                            </tr>
                            <tr>
                                <td>Math</td>
                                <td><?php echo $row2['math_id']?></td>
                            </tr>
                            <tr>
                                <td>Science</td>
                                <td><?php echo $row2['science_id']?></td>
                            </tr>
                            <tr>
                                <td>Reading Comprehension</td>
                                <td><?php echo $row2['reading_id']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div> <!-- content -->
        </div> <!-- flex-grow-1 -->
    </div>  <!-- d-flex -->
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
         
        </script>
        <script></script>

<?php
$conn->close();
?>
        
</body>
</html>

