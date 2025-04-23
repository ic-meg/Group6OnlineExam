<?php
session_start(); 

include "dbcon.php";


if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    echo "No user ID found in the session.";
    exit; 
}


$sqlFetch = "SELECT * FROM adminaccount WHERE admin_id = ?";
$stmt = mysqli_prepare($conn, $sqlFetch);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
    } else {
        echo "Error fetching data or no data found";
        exit;
    }

    mysqli_stmt_close($stmt); 
} else {
    echo "Error preparing the SQL query.";
    exit;
}

mysqli_close($conn); 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Entrance Exam | Admin Profile</title>
    <script src="Redirect.js"></script>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />
    <style>
        .logo-and-campus {
            display: flex;
            align-items: center;
            padding: 10px;
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
        .header h4 {
            font-family: var(--font-montserrat);
        }

        .bg-dark-green {
            background-color: #13443E;
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
            display: flex;
            justify-content: center;
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
                background-color: #13443E;
            }

            .btn:hover {
                background-color: #13443E;
            }

            .iconsandLabel {
                font-family: var(--font-montserrat);
            }
        }

        .student-info-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            padding: 20px;
            margin-top: 20px;
        }

        .profile-header {
            background-color: #13443E;
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
            color: #13443E;
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
                <h4 class="SchoolName" style="display: none; font-size: 18  px;">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="AdminDashboard.php">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="AdminProfile.php" style="border-right: 5px solid white;">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="AdminPortalExamSet.php">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam Set</span>
                </a>
                <a href="AdminManageExaminee.php">
                    <img src="./public/icon25.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Manage Examinee</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Admin Profile</h4>
                <div class="header-icons">
                  <?php include"adminnotif.php";?>
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
                <div class="admin-info-container student-info-container">
                    <div class="profile-header">
                        <img src="profile-pic.png" alt="Profile Picture">
                        <h2>Admin</h2>
                    </div>
                    <div class="admin-content">
                        <div class="title">Admin Information</div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" value="<?php echo  $row['username'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" value="<?php echo $row['password'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone No.:</label>
                            <input type="text" id="phone" name="phone" value="<?php echo $row['phone'] ?>" readonly>
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
