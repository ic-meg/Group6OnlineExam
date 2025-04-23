<?php
include "dbcon.php";

session_start();

$sql_count_examinee = "SELECT COUNT(*) as exm_count from student_examination_score";

$sql_count_student = "SELECT COUNT(*) as std_count from useraccount";

$sql_count_student_passed = "SELECT COUNT(*) as ps_count from student_examination_score where status = 'PASSED'";

$sql_count_student_failed = "SELECT COUNT(*) as fl_count from student_examination_score where status = 'FAILED'";



$result_1 = $conn->query($sql_count_examinee);

$result_2 = $conn->query($sql_count_student);

$result_3 = $conn->query($sql_count_student_passed);

$result_4 = $conn->query($sql_count_student_failed);

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    
    if ($userId == 2130) {
        $showAddAdmin = true;
    }
} else {
    echo "No user ID found in the session.";
}


?>




<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="AdminPortalDashboard.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap">
    
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
            background: #b2b2b3;
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
        
        .header > h4 {
            margin-left: 70px;
        }
        
        .content {
            transition: margin-left 0.3s;
            padding: 20px 20px 20px 90px;
            z-index: 0;
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

        .main-style{
            margin: 10px 0px 10px 0px;
        }

        .background-container {
            /* margin-left: -50px; */
            background-image: url('./public/10136775-17973908-1@2x.png');
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            display: flex;
            justify-content: center;
            padding: 188px 20px 45px 20px;
        }
        .container-fluid {
            background-image: url('./public/group-3@2x.png');
            background-position: center;
            background-repeat: no-repeat; 
            padding: 40px 20px 40px 20px;
            transform: translateY(-70px);
        }
        .img {
            height: 100px;
            width: 100px;
            
            
        }
        .container > b{
            font-size: 40px;
            position: relative;
            left: -130px;
        }

        .main-style {
            color: white;
            font-size: 20px;
        }

        .container > b{
            font-size: 40px;
        }

        .con{
            height: 20vh;
        }
        
        @media only screen and (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -70px;
                width: 70px;
            }

            .sidebar.show {
                left: 0;
                width: 250px;
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

            .header > h4{
                margin: 0px 0px 0px 0px;
            }

            .container{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .content{
                padding: 20px 20px 20px 50px;
            }
        }

        

        @media only screen and (max-width: 668px){
            .container > b{
                font-size: 30px;
            }

            .content{
                padding: 20px 20px 20px 20px;
            }
        }

        

    </style>
</head>
<body>
<div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="./public/CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none; font-size: 18px;">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="#" style="border-right: 5px solid white;">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="AdminProfile.php">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="AdminPortalExamSet.php">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam Set</span>
                </a>
                <a href="AdminManageExaminee.php">
                    <img src="./public/icon25.svg" alt="Manage Examinee Icon" class="menu-icon">
                    <span class="menu-label">Manage Examinee</span>
                </a>
                <?php if ($showAddAdmin): ?>
                    <a href="AddAdmin.php">
                        <img src="./public/items.png" alt="Add Admin Icon" class="menu-icon" style="filter: invert(1) brightness(2);">
                        <span class="menu-label">Add Admin</span>
                    </a>

                <?php endif; ?>
            </div>
        </div>
    </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center"> 
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Admin Dashboard</h4>
                <div class="header-icons">
                <?php include "adminnotif.php"?>
                    <script src="Redirect.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                   
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
                <!-- CONTENT DITO -->
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="background-container"> 
                            <div class="container-fluid">
                                <div class="container">
                               
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                    <img src="./public/boy-1@2x.png" alt="" class="img" />&nbsp;
                                    
                                    <b>Good Afternoon Admin!</b>
                                            <div class="row gx-5 gy-5" style="width: 100%;">
                                                <div class="col-lg-3 col-md-6 col-sm-6 p-4">
                                                        <div class="row con" style="background-color: #048bcb;">
                                                            <div class="col-md-6 col-sm-6 col-6">
                                                                <h1 class="main-style" style="font-size: 12.5px;">Total Examinees</h1>
                                                                <img src="./public/-icon-user.svg" alt="" style="height: 45px;width: 45px;">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-6"> 
                                                            <h1 class="main-style" style="font-size: 49px;  margin-left: 140px;">
                                                                    <?php
                                                                        if($result_1->num_rows>0){
                                                                            while($row = $result_1->fetch_assoc()){
                                                                                echo $row["exm_count"];
                                                                            }
                                                                        }else{
                                                                            echo "0";
                                                                        }
                                                                    ?>
                                                                </h1>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 col-sm-6 p-4">
                                                    <div class="row con" style="background-color: green;">
                                                        <div class="col-md-6 col-sm-6 col-6">
                                                            <h1 class="main-style" style="font-size: 12.5px;">Total Registered Students</h1>
                                                            <img src="./public/-icon-user.svg" alt="" style="height: 45px;width: 45px;">
                                                        </div>
                                        
                                                        <div class="col-md-6 col-sm-6 col-6"> 
                                                            <h1 class="main-style" style="font-size: 49px; margin-left: 140px;">
                                                            <?php
                                                                 if($result_2->num_rows>0){
                                                                    while($row = $result_2->fetch_assoc()){
                                                                            echo $row["std_count"];
                                                                        }
                                                                   }else{
                                                                        echo "0";
                                                                    }
                                                            ?>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-3 col-md-6 col-sm-6 p-4">
                                                    <div class="row con" style="background-color: #f3cd43;">
                                                        <div class="col-md-6 col-sm-6 col-6">
                                                            <h1 class="main-style" style="font-size: 12.5px;">Total Failed on the Exam</h1>
                                                            <img src="./public/icon20.svg" alt="" style="height: 45px;width: 45px;">
                                                        </div>
                                                    
                                                        <div class="col-md-6 col-sm-6 col-6">
                                                            <h1 class="main-style" style="font-size: 49px;  margin-left: 140px;">
                                                            <?php
                                                                if($result_4->num_rows>0){
                                                                    while($row = $result_4->fetch_assoc()){
                                                                            echo $row["fl_count"];
                                                                        }
                                                                    }else{
                                                                        echo "0";
                                                                    }
                                                            ?>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 col-sm-6 p-4">
                                                    <div class="row con" style="background-color: #e84848;">
                                                        <div class="col-md-6 col-sm-6 col-6">
                                                            <h1 class="main-style" style="font-size: 12.5px;">Total Pass on the Exam</h1>
                                                            <img src="./public/icon21.svg" alt="" style="height: 45px;width: 45px;">
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-6">
                                                        <h1 class="main-style" style="font-size: 49px;  margin-left: 140px;">
                                                            <?php
                                                                if($result_3->num_rows>0){
                                                                    while($row = $result_3->fetch_assoc()){
                                                                            echo $row["ps_count"];
                                                                        }
                                                                    }else{
                                                                        echo "0";
                                                                    }
                                                            ?>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                    </div> <br>
                                   
                                </div>
                            </div>
                        </div>
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