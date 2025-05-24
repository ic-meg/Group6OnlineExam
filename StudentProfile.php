<?php
session_start();
include 'C:\xampp\htdocs\OnlineExam\Admission\dbconn.php';
include 'student_session.php';
$control_number = $_SESSION['control_number'];

$sqlFetchUserID = "
    SELECT userID
    FROM useraccount
    WHERE control_number = ?
";

$stmtFetchUserID = $conn->prepare($sqlFetchUserID);

if (!$stmtFetchUserID) {
    echo "Error in preparing statement: " . $conn->error;
    exit;
}

$stmtFetchUserID->bind_param("s", $control_number);
$stmtFetchUserID->execute();
$resultUserID = $stmtFetchUserID->get_result();

if ($resultUserID && $resultUserID->num_rows > 0) {
    $rowUserID = $resultUserID->fetch_assoc();
    $userID = $rowUserID['userID'];
} else {
    echo "Error fetching userID or no data found";
    exit;
}

$sqlFetchUser = "
    SELECT name, email
    FROM useraccount
    WHERE userID = ?
";

$stmtFetchUser = $conn->prepare($sqlFetchUser);

if (!$stmtFetchUser) {
    echo "Error in preparing statement: " . $conn->error;
    exit;
}

$stmtFetchUser->bind_param("s", $userID);
$stmtFetchUser->execute();
$resultUser = $stmtFetchUser->get_result();

if ($resultUser && $resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();

    $_SESSION['user_email'] = isset($rowUser['email']) ? $rowUser['email'] : 'No information yet';
} else {
    echo "Error fetching data or no data found";
    exit;
}


$firstname = isset($rowUser['name']) ? $rowUser['name'] : 'No information yet';


$username = isset($rowUser['username']) ? $rowUser['username'] : 'No information yet';
$password = isset($rowUser['password']) ? $rowUser['password'] : 'No information yet';
$email = isset($rowUser['email']) ? $rowUser['email'] : 'No information yet';




$sqlFetchPersonalInfo = "
    SELECT DateOfBirth, PlaceOfBirth, Region, Province, Town, Barangay, Street, ZipCode
    FROM personalinfo
    WHERE userID = ?
";

$stmtFetchPersonalInfo = $conn->prepare($sqlFetchPersonalInfo);

if (!$stmtFetchPersonalInfo) {
    echo "Error in preparing statement: " . $conn->error;
    exit;
}

$stmtFetchPersonalInfo->bind_param("s", $userID);
$stmtFetchPersonalInfo->execute();
$resultPersonalInfo = $stmtFetchPersonalInfo->get_result();

if ($resultPersonalInfo && $resultPersonalInfo->num_rows > 0) {
    $rowPersonalInfo = $resultPersonalInfo->fetch_assoc();
} else {
    echo "Error fetching personal info or no data found";
    exit;
}


$birthdate = isset($rowPersonalInfo['DateOfBirth']) ? $rowPersonalInfo['DateOfBirth'] : 'No information yet';
$placeOfBirth = isset($rowPersonalInfo['PlaceOfBirth']) ? $rowPersonalInfo['PlaceOfBirth'] : 'No information yet';
$region = isset($rowPersonalInfo['Region']) ? $rowPersonalInfo['Region'] : 'No information yet';
$province = isset($rowPersonalInfo['Province']) ? $rowPersonalInfo['Province'] : 'No information yet';
$town = isset($rowPersonalInfo['Town']) ? $rowPersonalInfo['Town'] : 'No information yet';
$barangay = isset($rowPersonalInfo['Barangay']) ? $rowPersonalInfo['Barangay'] : 'No information yet';
$street = isset($rowPersonalInfo['Street']) ? $rowPersonalInfo['Street'] : 'No information yet';
$zipCode = isset($rowPersonalInfo['ZipCode']) ? $rowPersonalInfo['ZipCode'] : 'No information yet';


$sqlFetchFamilyBackground = "
    SELECT GuardiansName, GuardiansContact, GuardiansOccu
    FROM familybackground
    WHERE userID = ?
";

$stmtFetchFamilyBackground = $conn->prepare($sqlFetchFamilyBackground);

if (!$stmtFetchFamilyBackground) {
    echo "Error in preparing statement: " . $conn->error;
    exit;
}

$stmtFetchFamilyBackground->bind_param("s", $userID);
$stmtFetchFamilyBackground->execute();
$resultFamilyBackground = $stmtFetchFamilyBackground->get_result();

if ($resultFamilyBackground && $resultFamilyBackground->num_rows > 0) {
    $rowFamilyBackground = $resultFamilyBackground->fetch_assoc();
} else {
    echo "Error fetching family background or no data found";
    exit;
}


$guardiansName = isset($rowFamilyBackground['GuardiansName']) ? $rowFamilyBackground['GuardiansName'] : 'No information yet';
$guardiansContact = isset($rowFamilyBackground['GuardiansContact']) ? $rowFamilyBackground['GuardiansContact'] : 'No information yet';
$guardiansOccu = isset($rowFamilyBackground['GuardiansOccu']) ? $rowFamilyBackground['GuardiansOccu'] : 'No information yet';


$stmtFetchUserID->close();
$stmtFetchUser->close();
$stmtFetchPersonalInfo->close();
$stmtFetchFamilyBackground->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Entrance Exam | Profile</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <script src="Redirect.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" />
    <style>
        .logo-and-campus {
            display: flex;
            align-items: center;
            padding: 10px;
        }

        .logo-and-campus h4 {
            display: none;
            font-size: 18px;
        }

        .header h4 {
            font-family: var(--font-montserrat);
        }

        .school-logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
            cursor: pointer;
        }

        .logo-and-campus h4 {
            margin: 0;
            font-size: 16px;
        }

        .bg-dark-green {
            background-color: #448b4f;
        }

        .sidebar {
            height: 100vh;
            color: white;
            font-family: var(--font-montserrat);
            width: 70px;
            transition: all 0.2s;
            position: fixed;
            z-index: 1;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            margin-left: 10px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, .075);
            border-right: 5px solid white;
        }

        .sidebar.show {
            width: 250px;
        }

        .header {
            background: #f5f5f5;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
            color: black;
            padding: 10px;
        }

        .header h4 {
            margin-left: 70px;
        }

        .content {
            padding: 20px;
            transition: margin-left 0.3s;
            margin-left: 70px;
        }

        .content.sidebar-show {
            margin-left: calc(70px + 250px);
            transition: margin-left 0.3s ease;
        }

        .logout-button {
            font-family: var(--font-montserrat);
            padding: 8px 16px;
            background-color: #FFCD4D;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
        }

        .logout-button:hover {
            background-color: rgb(129, 122, 122);
            color: white;
        }

        .header-icons img {
            width: 37px;
            height: 37px;
            margin-bottom: 5px;
            margin-left: 10px;
            cursor: pointer;
        }

        .menu-icon {
            width: 24px;
            height: 24px;
            vertical-align: middle;
            margin-right: 10px;
        }

        .menu-label {
            display: none;
            vertical-align: middle;
        }

        .sidebar.show .menu-label {
            display: inline;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -70px;
                width: 70px;
            }

            .sidebar.show {
                left: 0;
                width: 250px;
            }

            .content {
                margin-left: 0;
            }

            .content.sidebar-show {
                margin-left: 250px;
            }

            .btn {
                background-color: #448b4f;
            }

            .btn:hover {
                background-color: #448b4f;
            }

            .iconsandLabel {
                font-family: var(--font-montserrat);
            }
        }

        .student-info-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 700px;
            padding: 20px;
            margin: auto;
        }

        .profile-header {
            background-color: #2e7d32;
            color: white;
            text-align: center;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
            border: 3px solid #ffffff;
        }

        .profile-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .profile-header p {
            margin: 5px 0 0;
        }

        .active {
            background-color: #c8e6c9;
            color: #2e7d32;
            display: inline-block;
            padding: 2px 10px;
            border-radius: 10px;
            font-size: 14px;
            margin-top: 10px;
        }

        .student-content {
            padding: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group label {
            width: 150px;
            color: #555;
            font-weight: bold;
        }

        .form-group input {
            flex: 1;
            padding: 8px;
            box-sizing: border-box;
            border: none;
            border-bottom: 1px solid #ccc;
            background-color: transparent;
            color: #333;
            width: 100%;
        }

        .form-group input[readonly] {
            background-color: transparent;
            cursor: not-allowed;
            border-bottom: 1px solid transparent;
        }

        .edit-btn {
            display: block;
            text-align: center;
            background-color: #ffcc00;
            color: #333;
            text-decoration: none;
            padding: 10px 0;
            border-radius: 5px;
            width: 100px;
            margin-left: auto;
            margin-top: 20px;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            display: inline-block;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="StudentDashboard.php">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="#" style="border-right: 5px solid white;">
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
                <h4>Examinee Profile</h4>
                <div class="header-icons">
                    <?php include "notif.php"; ?>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                    <script src="redirect.js"></script>
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
                <div class="student-info-container">
                    <div class="profile-header">
                        <img src="profile-pic.png" alt="Profile Picture">
                        <h2><?php echo $firstname; ?></h2>
                        <p>Control Number: <?php echo $control_number; ?></p>
                        <!-- <div class="active">ACTIVE</div> -->
                    </div>
                    <div class="student-content">
                        <div class="title">Examinee Information</div>
                        <!-- <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" value="<?php echo $password; ?>" readonly>
                        </div> -->
                        <div class="form-group">
                            <label for="fullname">Fullname:</label>
                            <input type="text" id="fullname" name="fullname" value="<?php echo $firstname; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Birthdate:</label>
                            <input type="text" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>" readonly>
                        </div>
                        <!-- <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="text" id="age" name="age" value="<?php echo $age; ?>" readonly>
                        </div> -->
                        <div class="form-group">
                            <label for="birthplace">Place of birth:</label>
                            <input type="text" id="birthplace" name="birthplace" value="<?php echo $placeOfBirth; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Full Address:</label>
                            <input type="text" id="address" name="address" value="<?php echo $town . ","; ?> <?php echo $province; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
                        </div>
                        <!-- <div class="form-group">
                            <label for="phone">Phone No.:</label>
                            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" readonly>
                        </div> -->
                        <div class="form-group">
                            <label for="guardian">Guardian Name:</label>
                            <input type="text" id="guardian" name="guardian" value="<?php echo $guardiansName ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="occupation">Occupation:</label>
                            <input type="text" id="occupation" name="occupation" value="<?php echo $guardiansOccu ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact No.:</label>
                            <input type="text" id="contact" name="contact" value="<?php echo $guardiansContact ?>" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
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
</body>

</html>