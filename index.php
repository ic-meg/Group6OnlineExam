<!doctype html>
<html lang="en">

<head>
  <title>CvSU Imus - Online Entrance Exam</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS LINK -->
  <link rel="stylesheet" href="Guess.css">
  <link rel="stylesheet" href="global.css">
  <!-- ICON LINK -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Bootstrap CSS -->

  <!-- Offline_Bootstrap -->
  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <!-- Online_Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <?php
  require './vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\IOFactory;

  include "dbcon.php";


  $excelFiles = [
    'personal_info' => 'C:\xampp\htdocs\OnlineExam\Admission\PersonalInfo2024.xlsx',
    'admission_info' => 'C:\xampp\htdocs\OnlineExam\Admission\AdmissionInfo2024.xlsx'
  ];


  $stmt = $conn->prepare("INSERT INTO imported_control_numbers (control_number, firstname, lastname, email) VALUES (?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }


  $personalSpreadsheet = IOFactory::load($excelFiles['personal_info']);
  $personalWorksheet = $personalSpreadsheet->getActiveSheet();

  $personalData = [];

  foreach ($personalWorksheet->getRowIterator() as $row) {
    if ($row->getRowIndex() == 1) continue;

    $controlNumber = $personalWorksheet->getCell('B' . $row->getRowIndex())->getValue();
    $firstname = $personalWorksheet->getCell('C' . $row->getRowIndex())->getValue();
    $lastname = $personalWorksheet->getCell('E' . $row->getRowIndex())->getValue();

    if (!empty($controlNumber) && !empty($firstname) && !empty($lastname)) {
      $personalData[$controlNumber] = [
        'firstname' => $firstname,
        'lastname' => $lastname
      ];
    }
  }


  $admissionSpreadsheet = IOFactory::load($excelFiles['admission_info']);
  $admissionWorksheet = $admissionSpreadsheet->getActiveSheet();

  foreach ($admissionWorksheet->getRowIterator() as $row) {
    if ($row->getRowIndex() == 1) continue;

    $controlNumber = $admissionWorksheet->getCell('B' . $row->getRowIndex())->getValue();
    $email = $admissionWorksheet->getCell('C' . $row->getRowIndex())->getValue();

    if (!empty($controlNumber) && !empty($email) && isset($personalData[$controlNumber])) {
      // Insert data into the database
      $firstname = $personalData[$controlNumber]['firstname'];
      $lastname = $personalData[$controlNumber]['lastname'];
      $stmt->bind_param("ssss", $controlNumber, $firstname, $lastname, $email);
      $stmt->execute();
    }
  }

  $stmt->close();
  $conn->close();

  // echo "Data imported successfully.";
  ?>


  <div class="container-fluid">
    <div class="row row1">
      <div class="nav col-lg-9 col-md-6 col-sm-3">
        <img src="Images/CvSU_LOGO.png" alt="">
        <ul>
          <li><a href="#about_content">About</a></li>
          <li><a href="#exam_content">Exam</a></li>
          <li><a href="#faqs_content">Faqs</a></li>
        </ul>
      </div>
      <div class="nav_butt col-lg-3 col-md-6 col-sm-6">
        <button onclick="loginRedirect()" class="LoginBtn">Login</button>
        <button onclick="signUpRedirect()" class="SignupBtn">Sign up</button>
      </div>
    </div>
    <div class="row row2">
      <div class="col-lg-12">
        <img src="Images/cavitestateu-1@2x.png" alt="">
      </div>
    </div>
    <div class="div-line"></div>
    <div class="row row3" id="about_content">
      <div class="col-lg-12">
        <h1>ABOUT ONLINE EXAM</h1>
        <p>Welcome to the gateway of your future – welcome to Cavite State University Imus online entrance exams. As you embark on your journey toward higher education, professional advancement, or career development, the first step often begins with successfully navigating an entrance exam. In this digital age, the traditional barriers of time and distance are being transcended by the power of technology, offering you an opportunity to take control of your future from anywhere in the world.</p>
        <p>Cavite State University Imus Online entrance exams represent a revolutionary approach to the admissions process, offering prospective students a convenient, accessible, and secure means of demonstrating their readiness for the next phase of their academic or professional journey. Whether you're aspiring to join a prestigious university, enroll in a specialized program, or pursue a career in a competitive field, our platform provides you with the tools and resources you need to succeed.</p>
        <p>Gone are the days of long queues, cumbersome paperwork, and restrictive exam schedules. With online entrance exams, you have the freedom to choose when and where you take your test, allowing you to optimize your preparation and perform at your best. Whether you're an early riser who prefers to study in the quiet of dawn or a night owl who thrives under the glow of moonlight, our platform accommodates your unique preferences and learning style.</p>
        <p>But Cavite State University Imus online entrance exams are more than just a convenient alternative to traditional assessments. They are a reflection of our commitment to equity, accessibility, and meritocracy in education. By leveraging cutting-edge technologies such as remote proctoring, AI-driven analytics, and adaptive testing algorithms, we ensure that every candidate has an equal opportunity to demonstrate their abilities and potential.</p>
        <p>we understand that the journey to success begins with a single step – and that step starts with your entrance exam. With a comprehensive suite of study materials, practice tests, and personalized feedback, we empower you to achieve your goals and unlock your full potential.</p>
        <p>So, take a deep breath, believe in yourself, and let your journey begin. With Cavite State University Imus online entrance exams, the future is yours to shape – and we're here to help you make it a reality.</p>
      </div>
    </div>
    <div class="div-line"></div>
    <div class="row row4" id="exam_content">
      <div class="col-lg-12">
        <h1>STEPS ON TAKING ONLINE EXAM</h1>
        <p><b>STEP 1:</b> Admission - Complete the required information to generate your unique control number. This control number is essential for signing up for our online exams. Make sure to fill in all necessary details accurately to ensure successful registration.</p>
        <p><b>STEP 2:</b> Exam Selection - Browse our catalog of exams and choose the one that aligns with your goals and objectives. Whether you're preparing for a standardized test, professional certification, or academic assessment, we have exams to suit your needs.</p>
        <p><b>STEP 3:</b> Preparation - Prepare for your exam using our study resources, practice questions, and study guides. Familiarize yourself with the exam format and content to maximize your chances of success.</p>
        <p><b>STEP 4:</b> Taking the Exam - When you're ready, schedule your exam and begin the test at your convenience. Follow the instructions provided and answer each question to the best of your ability.</p>
        <p><b>STEP 5:</b> Results - After completing the exam, receive immediate feedback on your performance and view your score. Review your results to identify areas for improvement and plan your next steps accordingly.</p>
      </div>
    </div>
    <div class="div-line"></div>
    <div class="row row5" id="faqs_content">
      <div class=" col-lg-12">
        <h1>FAQS</h1>
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                What is an online entrance exam?
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">An online entrance exam is a test conducted over the internet to evaluate candidates for admission into various academic programs or institutions.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                How do I access the online entrance exam?
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">To access the online entrance exam, log in to your student account on the CvSU - Imus Campus entrance exam portal using your control number. Once logged in, navigate to your dashboard where you'll see the exam schedule. From there, you can select and start your exam at the designated time. Make sure you have a stable internet connection and a compatible device for the exam</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                What should I do if I encounter technical issues during the exam?
              </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">If you experience technical problems during the exam, immediately contact the exam’s technical support team. Document the issue by taking screenshots or noting error messages to provide detailed information. Follow any troubleshooting steps or guidelines provided by the support team. Familiarize yourself with the exam’s procedures for reporting and resolving technical issues to ensure a smooth resolution.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseTwo">
                What should I do if I miss my scheduled exam time?
              </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">If you miss your scheduled exam time, you can request a reschedule through your student dashboard. If rescheduling options are not available, contact the administration for assistance. The admin will help you arrange a new exam time. Be sure to check for new time slots and adhere to any deadlines for rescheduling.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseTwo">
                How can I access my exam results after completing the test?
              </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">After completing the exam, you can view your results by navigating to the Student Result page on your dashboard. This page will display detailed scores, category percentages, and your overall pass/fail status. If you encounter any issues accessing your results, please contact the support team for help.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row row6" id="footer_content">
      <div class="col-lg-12">
        <div class="title">
          <img src="Images/CvSU_LOGO.png" alt="">
          <div>
            <h5>CAVITE STATE UNIVERSITY -IMUS CAMPUS</h5>
            <p>Online Entrance Exam</p>
          </div>
        </div>
        <ul class="footer_links">
          <li><a href="#about_content">About</a></li>
          <li><a href="#exam_content">Exam</a></li>
          <li><a href="#faqs_content">Faqs</a></li>
          <li><a href="#" onclick="loginRedirect()">Login</a></li>
          <li><a href="#" onclick="signUpRedirect()">Sign up</a></li>
        </ul>
        <ul class="social-icons">
          <li><a href="https://www.facebook.com/yourprofile" target="_blank"><i class="fab fa-facebook"></i></a></li>
          <li><a href="https://www.twitter.com/yourprofile" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li><a href="https://www.instagram.com/yourprofile" target="_blank"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- Offline_Bootstrap -->
  <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <!-- Online_Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    function loginRedirect() {
      window.location.href = 'Login.php';
    }

    function signUpRedirect() {
      window.location.href = 'Signup.php';
    }
  </script>
</body>

</html>