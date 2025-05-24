<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>Online Entrance Exam | Verification </title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./Login.css" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat Alternates:wght@400&display=swap" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montagu Slab:wght@700&display=swap" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
</head>
<style>
  .custom-ok-button-class {
    background-color: #448b4f;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
  }
</style>

<body>
  <?php

  include "dbcon.php";
  session_start();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require '../vendor/autoload.php';
  require_once __DIR__ . '../vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  function sendemail_verify($EmailAddress, $verification_code)
  {
    $subject = "Email Verification";
    $message = "Hi<br><br>";
    $message .= "Your verification code is:<br>";
    $message .= "<strong>$verification_code</strong><br><br>";
    $message .= "If you did not sign up for our service, please ignore this email.<br><br>";
    $message .= "Best regards,<br>Cavite State University - Imus Campus";

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
      $mail->Subject = $subject;
      $mail->Body = $message;

      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  if (isset($_SESSION['verification_email'])) {
    $email = $_SESSION['verification_email'];
  } else {
    header("Location: signup.php");
    exit;
  }

  if (isset($_POST['verifyCode'])) {
    $verification_code = $_POST['verification_code'];

    $check_email = "SELECT email, verification_code FROM useraccount WHERE email = ? AND verification_code = ? LIMIT 1";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("ss", $email, $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      echo "<script>
       
        Swal.fire({
          icon: 'success',
          title: 'Email Verified Successfully!',
          text: 'Continue creating your account.',
          width: '400px',
          confirmButtonColor: '#448b4f',
          confirmButtonTextColor: '#ffffff',
          confirmButtonClass: 'custom-ok-button-class',
          showCancelButton: false,
          allowOutsideClick: false,
        }).then(function() {
          window.location.href = 'Account.php';
        });
    </script>";
      exit;
    } else {
      echo "<script>
              Swal.fire({
                  title: 'Verification Failed!',
                  text: 'Please try again.',
                  icon: 'error',
                  width: '400px',
                  confirmButtonColor: '#448b4f', 
                  confirmButtonTextColor: '#ffffff', 
                  confirmButtonClass: 'custom-ok-button-class' 
                  
              });
            </script>";
    }
  }

  if (isset($_POST['sendNewCode'])) {
    $verification_code = rand(100000, 999999);
    $_SESSION['verification_code'] = $verification_code;

    $sqlNew = "UPDATE useraccount SET verification_code = ? WHERE email = ?";
    $stmt = $conn->prepare($sqlNew);
    $stmt->bind_param("ss", $verification_code, $email);
    $stmt->execute();

    sendemail_verify($email, $verification_code);

    echo "<script>
    
    Swal.fire({
        title: 'Verification Sent',
        text: 'A new verification code has been sent to your email.',
        icon: 'success',
        width: '400px',
        confirmButtonColor: '#448b4f', 
        confirmButtonTextColor: '#ffffff', 
        confirmButtonClass: 'custom-ok-button-class' //
    });
    </script>";
  }
  ?>


  <div class="container-fluid admin-login">
    <div class="row no-gutters">


      <div class="col-12 col-md-6 d-flex align-items-center justify-content-center green" style="margin-left: -10px;">
        <img
          class="img-fluid imus-campus-scaled-1-icon2"
          alt="School"
          src="./public/imuscampusscaled-1@2x.png" />
        <div class="welcome">
          <h1 class="h1">Welcome to Cavite State University - Imus Campus</h1>
          <h3 class="h3">Login or Sign up to get access to our Online Entrance Examination</h3>
        </div>

      </div>


      <div class="col-12 col-md-6 d-flex flex-column align-items-center justify-content-center position-relative">

        <div class="idk">


          <img class="admin-login-child" alt="" src="./public/ellipse-1@2x.png" />
          <div class="sign-in-to">
            Sign Up
          </div>
          <div class="sign-in-using"> Please verify your email address, then create your account.</div>
          <div class="we-encourage-you"> We encourage you to use a personal email address that is unlikely to change. </div>

          <div class="responsive" style="margin: 0 auto; display: flex; flex-direction: column; align-items: center;">

            <div class="admin-username-wrapper">
              <div class="admin-username1">
                <form action="/Group6OnlineExam/Verification.php" method="POST">
                  <input type="text" name="email" autocomplete="off" class="admin-username-item" required disabled>
                  <label class="username2" style="margin-left: 15px; text-align:left;margin-top:-5px;"><?php echo $email ?></label>
                  <div class="value-input">Value Input</div>
                  <div class="admin-username-inner"></div>
                  <div class="admin-username-child1"></div>
                  <div class="admin-username-child2"></div>
              </div>
            </div>
            <div class="admin-username-container" style="margin-top: -00px;">
              <div class="admin-username1">

                <input type="text" name="verification_code" autocomplete="off" class="admin-username-item">
                <label class="username1" style="margin-left: 15px; text-align:left;margin-top:-5px;">Verification Code</label>
                <div class="value-input">Value Input</div>
                <div class="admin-username-inner"></div>
                <div class="admin-username-child1"></div>
                <div class="admin-username-child2"></div>
              </div>
            </div>


            <input type="submit" name="verifyCode" value="Verify Code" class="menu-item-wrapper7">
            <div class="menu-item10"></div>

            <input type="submit" name="sendNewCode" value="Send New Code" class="menu-item-wrapper7">
            <div class="menu-item10"></div>
            <img class="signup-item" alt="" src="./public/line-1.svg" />



            <input type="button" name="Cancel" value="Cancel" class="menu-item-wrapper7" style="border:none;" onclick="cancelRedirect()">
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  </div>
  </div>
  </div>
  </div>
  </div>
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script>
    function cancelRedirect() {
      window.location.href = 'login.php';
    }
  </script>
</body>

</html>