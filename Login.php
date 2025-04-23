
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Online Entrance Exam | Sign in</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./Login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap"
  />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap"
  />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
  />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat Alternates:wght@400&display=swap"
  />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montagu Slab:wght@700&display=swap"
  />
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
</style>
<body>
<?php
session_start();
include "dbcon.php";

if (isset($_POST['signin'])) {
    $userInput = $_POST['username']; 
    $password = $_POST['password'];

     
    $stmtAdminCheck = $conn->prepare("SELECT admin_id FROM adminaccount WHERE (username = ? OR email = ?) AND password = ?");
    $stmtAdminCheck->bind_param("sss", $userInput, $userInput, $password);
    $stmtAdminCheck->execute();
    $resultAdminCheck = $stmtAdminCheck->get_result();

    if ($resultAdminCheck && $resultAdminCheck->num_rows > 0) {
        $rowAdmin = $resultAdminCheck->fetch_assoc();
        $_SESSION['user_id'] = $rowAdmin['admin_id'];
        $_SESSION['username'] = $userInput;
        $_SESSION['user_type'] = 'admin';
        header("Location: AdminDashboard.php");
        exit;
    } else {
        
        $stmtStudentCheck = $conn->prepare("SELECT control_number, username FROM useraccount WHERE (control_number = ? OR username = ?) AND password = ?");
        if (!$stmtStudentCheck) {
            die('Error in preparing statement: ' . $conn->error);
        }

        $stmtStudentCheck->bind_param("sss", $userInput, $userInput, $password);
        $stmtStudentCheck->execute();
        $resultStudentCheck = $stmtStudentCheck->get_result();

        if ($resultStudentCheck && $resultStudentCheck->num_rows > 0) {
            $rowStudent = $resultStudentCheck->fetch_assoc();
            $_SESSION['control_number'] = $rowStudent['control_number'];
            $_SESSION['username'] = $rowStudent['username'];
            $_SESSION['user_type'] = 'student';
            header("Location: StudentDashboard.php");
            exit;
        } else {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Account does not exist',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'Login.php';
                    }
                });
            </script>";
        }
    }

    $stmtAdminCheck->close();
    $stmtStudentCheck->close();
}

mysqli_close($conn);
?>



  <div class="container-fluid admin-login">
    <div class="row no-gutters">
      
    <div class="col-12 col-md-6 d-flex align-items-center justify-content-center green" style="margin-left: -10px;">
        <img
          class="img-fluid imus-campus-scaled-1-icon2"
          alt="School"
          src="./public/imuscampusscaled-1@2x.png"   />
          <div class="welcome">
          <h1 class="h1">Welcome to Cavite State University - Imus Campus</h1>
          <h3 class="h3">Login or Sign up to get access to our Online Entrance Examination</h3>
          </div>

      </div>
      
      <div class="col-12 col-md-6 d-flex flex-column align-items-center justify-content-center position-relative">
        <a href="Guess.php">
          <div class="go-back" style="padding: 15px;">
            <span class="span7"> &lt;- </span>
            <span class="go-back1">Go back</span></div></a>
           <a href="Signup.php" style="text-decoration:none;" class="SignupLink"> <span class="go-back1" style="text-align: right; font-size: medium; display: block; margin: 0 auto;">Don't have an account? Sign up</span></a>

        <div class="idk">

       
        <img class="admin-login-child" alt="" src="./public/ellipse-1@2x.png"/>  
        <div class="sign-in-to" style="margin-top: -10px;">
          Sign In to Cavite State University Imus Campus
        </div>
        <div class="sign-in-using">Sign in using your control number or username. </div>
       
        <div class="responsive" style="margin: 0 auto; display: flex; flex-direction: column; align-items: center;">
        
          <div class="admin-username-wrapper">
            <div class="admin-username1">
            <form action="" method="POST">
              <input  type="text"  name="username" autocomplete="off" class="admin-username-item" required>
              <label class="username2" style="margin-left: -15px; margin-top: -5px;">Control Number</label>
              <div class="value-input" >Value Input</div>
              <div class="admin-username-inner"></div>
              <div class="admin-username-child1"></div>
              <div class="admin-username-child2"></div>
            </div>
          </div>
          <div class="admin-username-container">
            <div class="admin-username1">
              
              <input type="password" name="password" id= "password" autocomplete="off" class="admin-username-item" required>
              <label class="username1" >Password</label>
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
        
        <a href="ForgotPass.php"  >
          <div class="forgot-your-password" style="margin-left: -290px;">Forgot your password?</div>
        </a>
        <input type="submit" name="signin" value="Sign in" class="menu-item-wrapper7">
          <div class="menu-item10"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

 
      </div>
    </div>
  </div>
</div>
</div>
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>

</body>
</html>
