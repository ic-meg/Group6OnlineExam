<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Online Entrance Exam | Verification </title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./Login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    .eye-icon {
      top: 24px;
      position: absolute;
      right: 10px;
      cursor: pointer;
      color: #888;
      display: none;
    }

    .eye-icon:hover {
      color: #000;
    }
  </style>
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
  .containerofall {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 20px;
    max-width: 600px;
    margin: auto;
    font-size: large;
    margin-top: -30px;

  }

  .containerofall div {
    margin: 5px 0;

  }

  @media (max-width: 1200px) {
    .containerofall {
      padding: 15px;

    }
  }

  @media (max-width: 900px) {
    .containerofall {
      padding: 10px;
      font-size: 0.9em;
    }
  }

  @media (max-width: 600px) {
    .containerofall {
      padding: 10px;
      font-size: 0.8em;
    }
  }

  @media (max-width: 400px) {
    .containerofall {
      padding: 5px;
      font-size: 0.75em;
    }


  }
</style>

<body>
  <?php
  session_start();
  include "dbcon.php";
  if (isset($_SESSION['control_number'])) {
    $control_number = $_SESSION['control_number'];
  } else {
    $control_number = "";
  }

  if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $Confirmpassword = $_POST['Confirmpassword'];
    $control_number = $_SESSION['control_number'];

    $checkUser = "SELECT * FROM useraccount WHERE username = '$username'";
    $checkSQL = mysqli_query($conn, $checkUser);



    if (strlen($password) < 10 || strlen($password) > 24 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
      echo "<script>
      Swal.fire({
        icon: 'warning',
        title: 'Validation Error!',
        text: 'Password must be 10-24 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
        confirmButtonColor: '#448b4f',
        confirmButtonTextColor: '#ffffff',
        
      });
      </script>";
    } elseif ($password !== $Confirmpassword) {
      echo "<script>
      Swal.fire({
        icon: 'warning',
        title: 'Password Mismatch!',
        text: 'Password and confirm password do not match.',
        confirmButtonColor: '#448b4f',
        confirmButtonTextColor: '#ffffff'
      });
      </script>";
    } elseif (mysqli_num_rows($checkSQL)) {
      echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Username Exists!',
        text: 'username already exists. Please use another username.',
        confirmButtonColor: '#448b4f',
        confirmButtonTextColor: '#ffffff'
      }).then(function() {
        window.location.href = 'Account.php';
      });
      </script>";
    } else {

      // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $insertStmt = $conn->prepare("INSERT INTO useraccount (control_number, username, password) VALUES (?, ?, ?)");
      $insertStmt->bind_param("sss", $control_number, $username, $password);

      if ($insertStmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'You successfully signed up. You can now access our exam by logging in.',
              confirmButtonColor: '#448b4f',
              confirmButtonTextColor: '#ffffff'
          }).then(function() {
              window.location.href = 'Login.php';
          });
          </script>";
      } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
          Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Failed to sign up. Please try again.',
              confirmButtonColor: '#448b4f',
              confirmButtonTextColor: '#ffffff'
          });
          </script>";
      }
    }
  }
  ?>

  <div class="container-fluid admin-login">
    <div class="row no-gutters">


      <div class="col-12 col-md-6 d-flex align-items-center justify-content-center green" style="margin-left: -10px; ">
        <img
          class="img-fluid imus-campus-scaled-1-icon2"
          style="height: 133vh;"
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
          <div class="sign-in-using"> Please verify your control number, then create your account.</div>
          <div class="we-encourage-you"> We encourage you to use the given control number on your admission. </div>

          <div class="responsive" style="margin: 0 auto; display: flex; flex-direction: column; align-items: center;">

            <div class="admin-username-wrapper">
              <div class="admin-username1">
                <form action="/OnlineExam/Account.php" method="POST">
                  <input type="text" name="username" autocomplete="off" class="admin-username-item" disabled>
                  <label class="username2" style="margin-left: 15px; text-align:left;margin-top:-5px;"><?php echo $control_number ?></label>
                  <div class="value-input">Value Input</div>
                  <div class="admin-username-inner"></div>
                  <div class="admin-username-child1"></div>
                  <div class="admin-username-child2"></div>
              </div>
            </div>
            <div class="admin-username-container" style="margin-top: -00px;">
              <div class="admin-username1">

                <input type="text" name="username" autocomplete="off" class="admin-username-item" required>
                <label class="username1" style="margin-left: 15px; text-align:left;margin-top:-5px;">Username</label>
                <div class="value-input">Value Input</div>
                <div class="admin-username-inner"></div>
                <div class="admin-username-child1"></div>
                <div class="admin-username-child2"></div>
              </div>
            </div>

            <!-- <div class="admin-username-container" style="margin-top: -00px;">
            <div class="admin-username1">
              
              <input type="text" name="Firstname" autocomplete="off" class="admin-username-item" required>
              <label class="username1" style="margin-left: 15px; text-align:left;margin-top:-5px;">Firstname</label>
              <div class="value-input">Value Input</div>
              <div class="admin-username-inner"></div>
              <div class="admin-username-child1"></div>
              <div class="admin-username-child2"></div>
            </div>
          </div> 
          <div class="admin-username-container" style="margin-top: -00px;">
            <div class="admin-username1">
              
              <input type="text" name="Lastname" autocomplete="off" class="admin-username-item" required>
              <label class="username1" style="margin-left: 15px; text-align:left;margin-top:-5px;">Lastname</label>
              <div class="value-input">Value Input</div>
              <div class="admin-username-inner"></div>
              <div class="admin-username-child1"></div>
              <div class="admin-username-child2"></div>
            </div>
          </div>  -->
            <div class="containerofall">
              <div>
                <b>Your password must contain</b>
              </div>
              <div>
                <b>✓</b> 10-24 Character
              </div>
              <div>
                <b>3 out of 4 of the following</b>
              </div>
              <div>
                <b>✓</b> Lowercase Letter
              </div>
              <div>
                <b>✓</b> Uppercase Letter
              </div>
              <div>
                <b>✓</b> Digits (0-9)
              </div>
              <div>
                <b>✓</b> Special Characters: @ # $ % ^ & * - _ + = [] {} \ : ‘ , ? / ~ ” () ; !
              </div>
            </div>
            <div class="admin-username-container" style="margin-top: -00px;">
              <div class="admin-username1">

                <input type="password" name="password" id="password" autocomplete="off" class="admin-username-item" required>
                <label class="username1" style="margin-left: 15px; text-align:left;margin-top:-5px;">Password</label>
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

            <div class="admin-username-container" style="margin-top: -00px;">
              <div class="admin-username1">

                <input type="password" name="Confirmpassword" id="confirmPassword" autocomplete="off" class="admin-username-item" required>
                <label class="username1" style="margin-left: 15px; text-align:left;margin-top:-5px;">Confirm Password</label>
                <div class="eye-icon" id="toggleConfirmPassword">
                  <i class="fas fa-eye" id="eyeOpen"></i>
                  <i class="fas fa-eye-slash" id="eyeClosed" style="display: none;"></i>
                </div>
                <div class="value-input">Value Input</div>
                <div class="admin-username-inner"></div>
                <div class="admin-username-child1"></div>
                <div class="admin-username-child2"></div>
              </div>
            </div>


            <input type="submit" name="signup" value="Sign up" class="menu-item-wrapper7">
            <div class="menu-item10"></div>



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

  </div>
  </div>
  </div>
  </div>
  </div>
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script>
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirmPassword');

    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');
    const eyeIcon = document.getElementById('togglePassword');

    const eyeOpenConfirm = document.getElementById('eyeOpenConfirm');
    const eyeClosedConfirm = document.getElementById('eyeClosedConfirm');
    const eyeIconConfirm = document.getElementById('toggleConfirmPassword');

    function toggleVisibility(field, eyeOpen, eyeClosed, eyeIcon) {
      if (field.type === 'password') {
        field.type = 'text';
        eyeOpen.style.display = 'none';
        eyeClosed.style.display = 'inline';
      } else {
        field.type = 'password';
        eyeOpen.style.display = 'inline';
        eyeClosed.style.display = 'none';
      }
    }

    function setupPasswordVisibilityToggle(field, eyeOpen, eyeClosed, eyeIcon) {
      field.addEventListener('input', function() {
        if (field.value.length > 0) {
          eyeIcon.style.display = 'inline';
        } else {
          eyeIcon.style.display = 'none';
        }
      });

      eyeIcon.addEventListener('click', function() {
        toggleVisibility(field, eyeOpen, eyeClosed, eyeIcon);
      });
    }

    setupPasswordVisibilityToggle(passwordField, eyeOpen, eyeClosed, eyeIcon);
    setupPasswordVisibilityToggle(confirmPasswordField, eyeOpenConfirm, eyeClosedConfirm, eyeIconConfirm);
  </script>
</body>

</html>