<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Online Entrance Exam | Forgot Password</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./ForgetPass.css" />
  <link rel="stylesheet" href="./Login.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat Alternates:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu Slab:wght@700&display=swap" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
</head>
<style>
      .eye-icon {
            top: 24px;
            position: absolute;
            right: 30px;
            cursor: pointer;
            color: #888;
            display: none;
        }
        .eye-icon:hover {
            color: #000;
        }
  .welcome {
    position: absolute;
    background-color: rgba(255, 255, 255, 0.8);
    color: black;
    border-radius: 10px;
    left: 0;
    right: 0;
    text-align: center;
    top: 38%;
    transform: translateY(-50%);
  }

  .h1 {
    font-size: 36px;
    font-weight: 600;
    padding: 35px;
    margin-top: -10px;
    line-height: 1.2;
    opacity: 85%;
  }

  .h3 {
    font-size: 24px;
    left: 100%;
    margin-top: -120px;
    line-height: 1.2;
    opacity: 85%;
    padding: 90px;
  }
</style>


<body>
  <div class="container-fluid admin-login">
    <div class="row no-gutters">
      <div class="col-12 col-md-6 d-flex align-items-center justify-content-center green" style="margin-left: -10px;">
        <img class="img-fluid imus-campus-scaled-1-icon2" alt="School" src="./public/imuscampusscaled-1@2x.png" />
        <div class="welcome">
          <h1 class="h1">Welcome to Cavite State University - Imus Campus</h1>
          <h3 class="h3">Login or Sign up to get access to our Online Entrance Examination</h3>
        </div>
      </div>

      <div class="col-12 col-md-6 d-flex flex-column align-items-center justify-content-center position-relative">
        <a href="Login.php">
          <div class="go-back" style="padding: 15px;">
            <span class="span7"> &lt;- </span>
            <span class="go-back1">Go back</span>
          </div>
        </a>
        <div class="idk">
          <img class="admin-login-child" alt="" src="./public/ellipse-1@2x.png" />
          <div class="sign-in-to" style="margin-top: -10px;">
            Sign In to Cavite State University Imus Campus
          </div>
          <div class="sign-in-using">Forgot Password</div>

          <div class="responsive" style="margin: 0 auto; display: flex; flex-direction: column; align-items: center;">
            <div class="admin-username-wrapper">
              <div class="admin-username1">
                <form action="/Group6OnlineExam/VerifyForgot.php" method="POST">
                  <input required type="text" name="GetControlNumber" autocomplete="off" class="admin-username-item" disabled>
                  <?php
include "dbcon.php";
session_start();

if (isset($_POST['update_password'])) {
    $GetControlNumber = $_SESSION['GetControlNumber'];
    $NewPassword = $_POST['NewPassword'];


    if (strlen($NewPassword) < 8 || !preg_match('/[A-Z]/', $NewPassword) || !preg_match('/[a-z]/', $NewPassword) || !preg_match('/[0-9]/', $NewPassword) || !preg_match('/[^a-zA-Z0-9]/', $NewPassword)) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Warning",
                text: "Password must be at least 8 characters long and include an upper case letter, a lower case letter, a number, and a special character.",
                icon: "warning"
            });
        </script>';
    } else {

        // $hashedPassword = password_hash($NewPassword, PASSWORD_DEFAULT);

  
        $updateQuery = "UPDATE useraccount SET password = ? WHERE control_number = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        $stmtUpdate->bind_param("ss", $NewPassword, $GetControlNumber);
        if ($stmtUpdate->execute()) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: "Success",
                    text: "Password updated successfully.",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "Login.php";
                    }
                });
            </script>';
        } else {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: "Error",
                    text: "Error updating password. Please try again.",
                    icon: "error"
                });
            </script>';
        }
        $stmtUpdate->close();
    }
    $conn->close();
}
?>
                  <?php
           
                if (isset($_SESSION['GetControlNumber'])) {
                    $GetControlNumber = $_SESSION['GetControlNumber'];
                ?>
                    <label class="username2" style="margin-left: -70px; top:20px;"><?php echo $GetControlNumber; ?></label>
                <?php
                }
                ?>
                  <div class="value-input">Value Input</div>
                  <div class="admin-username-inner"></div>
                  <div class="admin-username-child1"></div>
                  <div class="admin-username-child2"></div>
              </div>
            </div>
        
            <div class="admin-username-container">
              <div class="admin-username1">
                <input required type="password" name="NewPassword" id="password" autocomplete="off" class="admin-username-item">
                <label class="username1">Password</label>
                <div class="eye-icon" id="togglePassword">
                  <i class="fas fa-eye" id="eyeOpen"></i>
                  <i class="fas fa-eye-slash" id="eyeClosed" style="display: none;"></i>
              </div>
                <div class="value-input">Value Input</div>
                <div class="admin-username-inner"></div>
                <div class="admin-username-child1"></div>
                <div class="admin-username-child2"></div>
              </div>
            </div>
            <!-- <img class="signup-item" alt="" src="./public/line-1.svg" /> -->
            <input type="submit" value="Update Password" name="update_password" class="menu-item-wrapper7"
              style="width: 100vh; border:none;">
            <div class="menu-item10"></div>
            </input>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <?php 

// include "dbcon.php";

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require 'C:/Users/Meg Angeline Fabian/phpmailer/vendor/autoload.php';

// function sendemail_verify($EmailAddress, $verification_code){
//     $subject = "Email Verification";
//     $message = "Hi<br><br>";
//     $message .= "Your verification code is:<br>";
//     $message .= "<strong>$verification_code</strong><br><br>";
//     $message .= "If you did not sign up for our service, please ignore this email.<br><br>";
//     $message .= "Best regards,<br>Cavite State University - Imus Campus";

//     $mail = new PHPMailer(true);
//     try {
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';
//         $mail->SMTPAuth = true;
//         $mail->Username = 'fabian.megangeline2003@gmail.com'; // your Gmail address
//         $mail->Password = 'upqj akck ojis wmsa'; // your Gmail password
//         $mail->SMTPSecure = 'ssl';
//         $mail->Port = 465;

//         $mail->setFrom('megangeline08@gmail.com', 'Online Entrance Exam');
//         $mail->addAddress($EmailAddress);

//         $mail->isHTML(true);
//         $mail->Subject = $subject;
//         $mail->Body = $message;

//         $mail->send();

//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }
// }

// if (isset($_POST['sendCode'])) {
//     $EmailAddress = $_POST['EmailAddress'];

//     $check_query = "SELECT * FROM useraccount WHERE email = '$EmailAddress'";
//     $check_result = mysqli_query($conn, $check_query);

//     if(mysqli_num_rows($check_result)){
//       echo "<script>
//       Swal.fire({
//         icon: 'error',
//         title: 'Email Exists!',
//         text: 'Email already exists. Please use another email.',
//         confirmButtonColor: '#448b4f',
//         confirmButtonTextColor: '#ffffff'
//       }).then(function() {
//         window.location.href = 'Signup.php';
//       });
//       </script>";
//     }else{
//       $verification_code = rand(100000, 999999); 

//       $insert_query = "INSERT INTO useraccount (email, verification_code) VALUES ('$EmailAddress', '$verification_code')";
//       $insert_run = mysqli_query($conn, $insert_query);
  
//       if ($insert_run) {
//         session_start();
//         $_SESSION['verification_email'] = $EmailAddress;
  
//         sendemail_verify($EmailAddress, $verification_code);
//         echo "<script>
//         Swal.fire({
//           icon: 'success',
//           title: 'Verification Code Sent!',
//           text: 'Verification code is sent to your email address.',
//           confirmButtonColor: '#448b4f',
//           confirmButtonTextColor: '#ffffff'
//         }).then(function() {
//           window.location.href = 'Verification.php';
//         });
//         </script>";
//         header("Location: Verification.php");
//         exit;  
//       } else {
//         echo "<script>
//         Swal.fire({
//           icon: 'error',
//           title: 'Error!',
//           html: '<div style=\"font-size: 18px; padding: 20px;\">Failed to store the verification code.</div>',
//           confirmButtonTextColor: '#ffffff'
//         })
//         </script>";
//       }
//     }
// }
?>

  <script>
    const passwordField = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');
    const eyeIcon = document.getElementById('togglePassword');

    passwordField.addEventListener('input', function () {
        if (passwordField.value.length > 0) {
            eyeIcon.style.display = 'inline';
        } else {
            eyeIcon.style.display = 'none';
        }
    });

    eyeIcon.addEventListener('click', function () {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeOpen.style.display = 'none';
            eyeClosed.style.display = 'inline';
        } else {
            passwordField.type = 'password';
            eyeOpen.style.display = 'inline';
            eyeClosed.style.display = 'none';
        }
    });
</script>

  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
</body>

</html>
