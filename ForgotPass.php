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
          <div class="sign-in-using">Update password using control number</div>

          <div class="responsive" style="margin: 0 auto; display: flex; flex-direction: column; align-items: center;">
            <div class="admin-username-wrapper">
              <div class="admin-username1">
                <form action="/Group6OnlineExam/ForgotPass.php" method="POST">
                  <input required type="text" name="GetControlNumber" autocomplete="off" class="admin-username-item">
                  <label class="username2">Control Number</label>
                  <div class="value-input">Value Input</div>
                  <div class="admin-username-inner"></div>
                  <div class="admin-username-child1"></div>
                  <div class="admin-username-child2"></div>
              </div>
            </div>

            <!-- <div class="admin-username-container">
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
            </div> -->
            <!-- <img class="signup-item" alt="" src="./public/line-1.svg" /> -->
            <input type="submit" value="Continue" name="next" class="menu-item-wrapper7"
              style="width: 100vh; border:none;">
            <div class="menu-item10"></div>
            </input>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include "dbcon.php";

  if (isset($_POST['next'])) {
    session_start();
    $GetControlNumber = $_POST['GetControlNumber'];


    $checkExistQuery = "SELECT control_number FROM useraccount WHERE control_number = ?";
    $stmtCheckExist = $conn->prepare($checkExistQuery);
    $stmtCheckExist->bind_param("s", $GetControlNumber);
    $stmtCheckExist->execute();
    $result = $stmtCheckExist->get_result();

    if ($result->num_rows > 0) {
      $_SESSION['GetControlNumber'] = $GetControlNumber;
      echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script>
              Swal.fire({
                  title: "Success",
                  text: "Control Number exists.",
                  icon: "success"
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = "VerifyForgot.php";
                  }
              });
          </script>';
    } else {
      echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script>
              Swal.fire({
                  title: "Error",
                  text: "Control number does not exist.",
                  icon: "error"
              });
          </script>';
    }
    $stmtCheckExist->close();
    $conn->close();
  }
  ?>


  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
</body>

</html>