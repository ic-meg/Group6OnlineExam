<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Online Admission and Examination | CvSU - Imus Campus</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            position: relative;
        }

        .fullscreen-image {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            display: block;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 69, 38, 0.8); /* Dark green with 80% opacity */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .logo {
            width: 200px;
            height: auto;
            margin-bottom: -10px;
        }

        .overlay div p {
            margin: 10px 0;
        }

        .btn-google {
            background-color: white;
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }

         .modal.fade .modal-dialog {
            transform: translateY(-100px); 
            transition: transform 0.5s ease-in-out;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
        }
    </style>
</head>
<body>
<?php
    include 'dbconn.php';
    session_start();
    require_once 'C:\xampp\htdocs\vendor/autoload.php';

    // init configuration
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); 
    $dotenv->load();
    
    $clientID = $_ENV['GOOGLE_CLIENT_ID'];
    $clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'];
    $redirectUri = $_ENV['REDIRECT_URI'];
    

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

   
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);
     
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;
        
        $_SESSION['user_email'] = $email;
        
        $checkQuery = "SELECT * FROM useraccount WHERE email = '{$email}'";
        $checkResult = mysqli_query($conn, $checkQuery);
        
        $newUser = false;
        $hasControlNumber = false;
        
        if($checkResult->num_rows == 0){
          
            $insertQ = "INSERT INTO useraccount (email, name) VALUES ('$email', '$name')";
            $insertResult = mysqli_query($conn, $insertQ);
            
            if ($insertResult) {
                $newUser = true;
            }
        } else {
            
            $userData = $checkResult->fetch_assoc();
            if (!empty($userData['control_number'])) {
                $hasControlNumber = true;
            }
        }

        if ($newUser) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful!',
                text: 'Redirecting to Admission Information...',
                confirmButtonColor: '#448b4f',
                confirmButtonTextColor: '#ffffff'
            }).then(function() {
                window.location.href = 'applicationform.php';
            });
            </script>";
        } elseif ($hasControlNumber) {
            // Redirect to a page or show a message indicating control number is already assigned
            echo "<script>
            Swal.fire({
                icon: 'info',
                title: 'Control Number Assigned',
                text: 'You already have a control number. Redirecting to the exam...',
                confirmButtonColor: '#448b4f',
                confirmButtonTextColor: '#ffffff'
            }).then(function() {
                window.location.href = '../Guess.php'; // Redirect to the exam page or any other appropriate page
            });
            </script>";
        } else {
            echo "<script>
            window.location.href = 'applicationform.php';
            </script>";
        }
        exit();
    } else { ?>
 
    <img class="fullscreen-image" alt="Background Image" src="cvsuimus.jpg"/>
    <div class="overlay">
        <div>
            <img class="logo" alt="CvSU Logo" src="CvSU_LOGO.png"/>
            <h4>Cavite State University</h4>
            <h6>Online Student Admission and Examination System</h6>
            <p>1st semester 2024-2025</p>
            <p>By signing in, you are authorizing Cavite State University <br> to collect, store
            and process the data given to the system <br>
            for the purpose of applying to this University.</p>

            <br>
            <div class="col-md-12">
                <a class="btn btn-primary" href="<?php echo $client->createAuthUrl()?>">
                    <img src="https://img.icons8.com/color/24/000000/google-logo.png" class="btn-google" alt="Google Logo"> Sign in with Google
                </a>
            </div>
            <br>

            <p>© 2024</p>
        </div>
    </div>
    <?php } ?>
     <!-- Modal for Admission Process Information -->
     <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">CvSU Online Admission System</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>THIS ADMISSION PROCESS IS FOR THE 1st SEMESTER OF 2024-2025.</li>
                        <li>THE SYSTEM IS EXCLUSIVE FOR NEW INCOMING FIRST YEAR STUDENTS, TRANSFEREES, SECOND COURSERS AND TCP APPLICANTS.</li>
                        <li>If you are a shiftee or an old student that is enrolled or was enrolled in CvSU, DO NOT USE THIS SYSTEM</li>
                        <li>Use only one email address in the application and remember well your password. We prohibit the applicant to use multiple email addresses in order to create another account with same name. Once we traced that multiple entry of same name, we will only acknowledge the first entry and disregard the rest.</li>
                        <li>Applicants are prohibited from sharing the same email address to other applicants. Use your own email address in applying.</li>
                        <li>Input all your information with honesty and integrity. The data encoded and submitted documents will be subjected for validation and verification to your school.</li>
                        <li>Applicants who will violate the aforementioned guidelines will be disqualified from the list of application.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <script>
        // Show the modal when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            var infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
            infoModal.show();
        });
    </script>
    </div>
</body>
</html>
