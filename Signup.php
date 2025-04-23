

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Online Entrance Exam | Sign up</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./Login.css" />
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
<body>


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
        
        <div class="idk">

       
        <img class="admin-login-child" alt="" src="./public/ellipse-1@2x.png"/>  
        <div class="sign-in-to">
          Sign Up 
        </div>
        <div class="sign-in-using"> Please verify your control number, then create your account.</div>
        <div class="we-encourage-you"> We encourage you to use the given control number on your admission. </div>
       
        <div class="responsive" style="margin: 0 auto; display: flex; flex-direction: column; align-items: center;">
        
          <div class="admin-username-wrapper">
            <div class="admin-username1">
            <form action="/Group6OnlineExam/Signup.php" method="POST">
              <input  type="text"  name="control_number" autocomplete="off" class="admin-username-item" required>
              <label class="username2" style="margin-left: 15px; text-align:left;margin-top:-5px;">Control Number</label>
              <div class="value-input" >Value Input</div>
              <div class="admin-username-inner"></div>
              <div class="admin-username-child1"></div>
              <div class="admin-username-child2"></div>
            </div>
          </div>
    
   
        <input type="submit" name="signup" value="Verify Control Number" class="menu-item-wrapper7">
        <?php 
  
        ?>
          <div class="menu-item10"></div>
          <img class="signup-item" alt="" src="./public/line-1.svg" />

          
          <input type="button" name="Cancel" value="Cancel" class="menu-item-wrapper7" style="border:none;" onclick="cancelRedirect()">

          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
     
          


<?php
include "dbcon.php";
session_start();
if (isset($_POST['signup'])) {

    $control_number = $_POST['control_number'];
    $_SESSION['control_number'] = $control_number;


    $stmt = $conn->prepare("SELECT control_number FROM imported_control_numbers WHERE control_number = ?");
    $stmt->bind_param("s", $control_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
     
        $isValid = true;
    } else {
    
        $isValid = false;
    }

    $stmt->close();

    if ($isValid) {
        
        $stmt_check_account = $conn->prepare("SELECT control_number FROM useraccount WHERE control_number = ?");
        $stmt_check_account->bind_param("s", $control_number);
        $stmt_check_account->execute();
        $result_check_account = $stmt_check_account->get_result();

        if ($result_check_account->num_rows > 0) {
            // Account already exists
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Account Exists',
                    text: 'An account with this control number already exists.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'Signup.php';
                    }
                });
            </script>";
        } else {
            // No account exists, proceed with registration
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Control Number Verified',
                    text: 'Control number is valid. Proceeding with registration.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'Account.php';
                    }
                });
            </script>";
        }

        $stmt_check_account->close();
    } else {
        // Control number is invalid
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Control Number',
                text: 'The control number you entered is not valid.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'Signup.php';
                }
            });
        </script>";
    }

    $conn->close();
}
?>


      </div>
    </div>
  </div>
</div>
</div>
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script>
    function cancelRedirect() {
        window.location.href = 'Guess.php';
    }
  </script>
  

 
</body>
</html>
