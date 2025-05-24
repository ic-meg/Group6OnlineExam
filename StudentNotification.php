<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="AdminNotification.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;900&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
  }

  .header {
    background-color: white;
    border-bottom: 1px solid #ddd;
    width: 100%;
    padding: 10px 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
  }

  .header-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .header h1 {
    margin: 0;
    font-size: 24px;
  }

  .notification-container {
    position: relative;
  }

  .notification-btn {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    position: absolute;
    top: 10px;
    left: 20px;
  }

  .notification {
    position: absolute;
    top: 50px;
    /* Adjust as needed */
    left: 0;
    /* Align to the left of the header */
    background-color: #333;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    display: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.3s, transform 0.3s;
  }

  .notification.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
  }

  .close-btn {
    background: none;
    border: none;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 10px;
  }

  @media (max-width: 768px) {
    .header-container {
      flex-direction: column;
      align-items: flex-start;
    }

    .header h1 {
      font-size: 20px;
    }

    .notification-btn {
      margin-top: 10px;
      position: static;
    }
  }
</style>

<body>
  <?php
  session_start();
  include 'dbcon.php';



  if (!isset($_SESSION['user_email'])) {
    echo "No email address found in session.";
    exit;
  }


  if (!isset($_SESSION['control_number']) || $_SESSION['user_type'] !== 'student') {
    header("Location: StudentNotification.php");
    exit;
  }

  $control_number = $_SESSION['control_number'];
  $EmailAddress = $_SESSION['user_email'];


  $sqlFetch = "SELECT * FROM useraccount WHERE control_number = ?";
  $stmtFetch = $conn->prepare($sqlFetch);

  if (!$stmtFetch) {
    echo "Error in preparing statement: " . $conn->error;
    exit;
  }

  $stmtFetch->bind_param("s", $control_number);
  $stmtFetch->execute();
  $result = $stmtFetch->get_result();

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    echo "Error fetching data or no data found";
    exit;
  }

  $firstname = isset($row['username']) ? $row['username'] : 'No information yet';
  $email = isset($row['email']) ? $row['email'] : 'No information yet';

  $stmtFetch->close();
  $conn->close();
  ?>
  <!-- <div class="admin-notification">
    <div class="rectangle-parent87">
      <div class="group-child447" style="width: 2000px;"></div>
      <a href="StudentNotification.php"> <i class="bi bi-bell-fill"></i></a>
      
      <div class="admin-notification1">Student Notification</div>
    </div> -->
  <header class="header">
    <div class="header-container">
      <h1>Notification</h1>

    </div>
  </header>
  <br><br><br><br><br><br>

  <!-- Main -->
  <div class="main-container">
    <div class="container">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item accordion-item-border">
          <h2 class="accordion-header">
            <span style="padding: 0px 0px 0px 19px;">Recent Notification</span>
            <?php

            include 'dbcon.php';


            if (!isset($_SESSION['control_number'])) {
              echo "Control number is not set.";
              exit;
            }
            $control_number = mysqli_real_escape_string($conn, $_SESSION['control_number']);


            $sql_get = "SELECT * FROM useraccount WHERE control_number = '$control_number'";
            $result_get = mysqli_query($conn, $sql_get);

            if (!$result_get) {
              echo "Error executing query: " . mysqli_error($conn);
              exit;
            }

            while ($row_get = mysqli_fetch_array($result_get)) {


              $sql_get_id = "SELECT * FROM admin_booking WHERE control_number = '" . $row_get['control_number'] . "'";
              $result_get_id = mysqli_query($conn, $sql_get_id);


              if (!$result_get_id) {
                echo "Error executing query: " . mysqli_error($conn);
                exit;
              }

              while ($row_get_id = mysqli_fetch_array($result_get_id)) {

                $time = $row_get_id['time'];
                $timestamp = strtotime($time);
                $formatted_time = date("g:i A", $timestamp);


                $original_date = $row_get_id['date'];
                $timestamp = strtotime($original_date);
                $formatted_date = date("l, F j, Y", $timestamp);

                $original_datetime_set = $row_get_id['created_at'];
                $timestamp_set = strtotime($original_datetime_set);
                $formatted_datetime_set = date("n/j/Y - g:i A", $timestamp_set);

                // Prepare email details
                $subject = "CvSU Online Entrance Exam Schedule";
                $message = "
                          <p><b>Hello $firstname,</b></p>
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


                echo '
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne' . $row_get_id['book_id'] . '" aria-expanded="true" aria-controls="collapseOne">
                              <img src="./public/frame-42@2x.png" style="height: 50px;width: 50px;" alt="Recent Notification Icon"/>
                              <div class="row">
                                  <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">Online Entrance Exam Schedule</b></div>
                                  <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">' . $formatted_datetime_set . '</p></div>
                                  <!-- 09/30/23 - 11:43am-->
                              </div>
                          </button>
                          <div id="collapseOne' . $row_get_id['book_id'] . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body" style="font-size: 20px;">
                                  <b>Hello, ' . $firstname . '</b> <br>
                                  <p><b>Exam Details:</b></p>
                                  <ul>
                                      <li><b>Date:</b> ' . $formatted_date . '</li>
                                      <li><b>Time:</b> ' . $formatted_time . '</li>
                                      <li><b>Duration:</b> One Hour</li>
                                  </ul>
                              </div>
                          </div>';
              }
            }

            ?>
            <?php

            $sql_result = "SELECT * FROM student_examination_score WHERE control_number = '$control_number'";
            $result_result = mysqli_query($conn, $sql_result);

            if (!$result_result) {
              echo "Error executing query: " . mysqli_error($conn);
              exit;
            }

            while ($row_result = mysqli_fetch_array($result_result)) {
              $exam_date = $row_result['submittedAt'];
              $result_status = $row_result['status'];

              $timestamp = strtotime($exam_date);
              $formatted_exam_date = date("n/j/Y - g:i A", $timestamp);


              if ($result_status == 'PASSED') {
                $result_message = '<p>Congratulations! We are thrilled to inform you that you have successfully passed your exam.</p>
                                          <p>Your hard work and dedication have truly paid off. We encourage you to continue striving for excellence in your future academic and professional endeavors. If you need any further assistance or have any questions, please feel free to reach out to us.</p>
                                          <p>Best wishes,<br>The CvSU Online Entrance Exam Team</p>';
              } else if ($result_status == 'FAILED') {
                $result_message = '<p>We regret to inform you that, unfortunately, you did not pass the exam this time.</p>
                                          <p>We understand that this news may be disappointing. Please remember that setbacks are a part of the learning journey. We encourage you to review your performance and seek additional resources or support if needed. If you have any questions about your results or next steps, please do not hesitate to contact us. We are here to support you in your academic journey.</p>
                                          <p>Best regards,<br>The CvSU Online Entrance Exam Team</p>';
              } else {
                $result_message = '<p>We have received your exam results and will update you with the status soon. Thank you for your patience.</p>';
              }

              echo '
                    <div class="accordion-item accordion-item-border">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResult' . $row_result['studExam_id'] . '" aria-expanded="false" aria-controls="collapseResult">
                                <img src="./public/envelope-dots@2x.png" style="height: 50px;width: 50px;background-color: #001133; border-radius: 5px;" alt="Exam Results Icon"/>
                                <div class="row">
                                    <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">Exam Result Notification</b></div>
                                    <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">' . $exam_date . '</p></div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseResult' . $row_result['studExam_id'] . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="font-size: 20px;">
                                <b>Hello, ' . $firstname . '</b> <br><br>
                                
                                ' . $result_message . '
                            </div>
                        </div>
                    </div>';
            }
            ?>


            <!-- =</div>
          <div class="accordion-item accordion-item-border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <img src="./public/add-user-group-woman-man@2x.png" style="height: 50px;width: 50px;background-color: #001133; border-radius: 5px;" alt="New Registered Students Icon"/>
                <div class="row">
                  <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">New Registered Students</b></div>
                  <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">10/21/23 - 02:45pm</p></div>
                </div>
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body" style="font-size: 20px;">
                <b>Hello Admin!</b> <br>
                <p>Just a heads-up that we have new registered students for the upcoming online entrance exam.</p>
                <p><b>Details:</b></p>
                <ul>
                  <li><b>Student ID:</b> 202210291</li>
                  <li><b>Name:</b> Juan Carlos Dela-Cruz</li>
                  <li><b>Reminder:</b> Please ensure all new students are properly enrolled and have access to necessary exam information.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item accordion-item-border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <img src="./public/envelope-dots@2x.png" style="height: 50px;width: 50px;background-color: #001133; border-radius: 5px;" alt="New Message Icon"/>
                <div class="row">
                  <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">New Message</b></div>
                  <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">03/09/23 - 07:00am</p></div>
                </div>
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body" style="font-size: 20px;">
                <b>Hello Admin!</b> <br>
                <p>You have new messages awaiting your attention. Please log in to your account to view and respond to them.</p>
              </div>
            </div>
          </div>
          <div class="accordion-item accordion-item-border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <img src="./public/total-sales@2x.png" style="height: 50px;width: 50px;background-color: #001133; border-radius: 5px;" alt="Number of Students Icon"/>
                <div class="row">
                  <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">Number of Students</b></div>
                  <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">05/18/23 - 11:00am</p></div>
                </div>
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body" style="font-size: 20px;">
                <b>Hello Admin!</b> <br>
                <p>The total number of students registered for the upcoming online entrance exam is [number].</p>
              </div>
            </div>
          </div> -->

            <div>&nbsp;</div>
        </div>
      </div>
    </div>
  </div>
  <div class="arrow-left-group" id="frameContainer">
    <a href="StudentDashboard.php" style="color: black; text-decoration:none;"><img class="arrow-left-icon1" alt="Back Arrow" src="public/16--arrowleft.svg" />

  </div>


  <script>
    var buttonText = document.getElementById("buttonText");
    if (buttonText) {
      buttonText.addEventListener("click", function() {
        window.location.href = "./StudentNotification.php";
      });
    }

    var frameContainer = document.getElementById("frameContainer");
    if (frameContainer) {
      frameContainer.addEventListener("click", function() {
        window.location.href = "./StudentNotification.php";
      });
    }
    document.body.style.zoom = "80%";
  </script>
</body>

</html>