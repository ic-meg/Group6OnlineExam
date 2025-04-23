<?php
include "dbcon.php";

session_start();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Examinee</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="AdminPortalExamSet.css">

    <script src="Redirect.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
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
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap"
    />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap"
    />
    <style>
        .custom-btn {
            background-color: var(--color-darkslategray-100);
            color: #fff; /* White text color */
            border-color: #6c757d; /* Matching border color */
        }
        
             .headExam {
            box-shadow: 0 4px 4px rgb(0 0 0 / 25%);
            background-color: var(--color-lavenderblush);
            font-family: var(--font-montserrat);
            width: 2000px;
            height: 43.4px;
            text-align: left;
        }
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
            transition: margin-left 0.3s;
            margin: 30px 30px 30px 100px;
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

        /* .div-container{
            display: flex;
            flex-direction: column;
            padding: 10px;
        } */

        .col-lg-6{
            padding: 10px;
        }

        #search{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        #search > h4{
            margin-right: 10px;
        }

        #view-btn{
            background-color: red;
            width: 100%;
            margin-bottom: 5px;
        }

        #schd-btn{
            background-color: #0C92DE;
            width: 100%;
        }

        button{
            border: none;
            color: white;
            border-radius: 10px;
        }

        #search_inpt{
            border-radius: 10px;
            border: 2px gray solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f9f9f9;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        tbody {
            display: block;
            height: 400px;
            overflow-y: auto;
        }

        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        thead tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        p{
            text-align: center;
        }
        





        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -70px;
                width: 70px;
            }

            .content{
                margin: 10px;
                padding: 50px;
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

        @media only screen and (max-width: 992px){
            
        #search{
            justify-content: flex-start;
            align-items: flex-start;
        }

        }
        .input {
            width: 100%;
            height: 40px;
            line-height: 28px;
            padding: 0 1rem;
            padding-left: 2.5rem;
            border: 2px solid transparent;
            border-radius: 8px;
            outline: none;
            background-color: #f3f3f4;
            color: #0d0c22;
            transition: 0.3s ease;
        }

        .input::placeholder {
            color: #9e9ea7;
        }

        .input:focus,
        input:hover {
            outline: none;
            border-color: rgba(0, 48, 73, 0.4);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgb(0 48 73 / 10%);
        }

        .icon {
            position: absolute;
            left: 1rem;
            fill: #9e9ea7;
            width: 1rem;
            height: 1rem;
        }

        .active{
            text-align: center;
            background-color: var(--color-seagreen-100);
            color: white;
        }
        
         .dropdown-toggle{
            text-align: center;
            background-color: var(--color-darkslategray-100);
            color: white;
        }
        .dropdown {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            
        }
     


    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none; font-size: 18px;">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="AdminDashboard.php">
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

                <a href="AdminManageExaminee.php" style="border-right: 5px solid white;">
                    <img src="    ./public/icon25.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Manage Examinee</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
        <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Admin Manage Examinee</h4>
                <div class="header-icons">
                <?php include"adminnotif.php";?>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <!-- Include your custom redirect.js -->
                    <script src="Redirect.js"></script>
                    <button class="Btn">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <div class="text" onclick="logoutRedirect()">Logout</div>
                    </button>
                </div>
            </div><br><br><br>
            <div class="content" id="content">
                <div class="container-fluid">
                    <div class="row justify-content-end">
                <table class="table" style="text-align: center;">
                <div class="row">
                <thead class="headExam">
                                <tr>
                                    <th colspan="6">List of examinee</th>
                                </tr>
                </thead>
        
                <div class="search-and-table-container">
                    <div class="group" id="search">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                            <g>
                                <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                            </g>
                        </svg>
                        <input class="input" type="search" placeholder="Search" id="search_inpt"/>
                    </div>
                
                
                <thead>
                    <tr>
                    <th scope="col">Examinee code</th>
                    <!-- <th scope="col">Email</th> -->
                    <th scope="col">Username</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id = 'search_tbl'>

                <?php
                $sql1 = "SELECT  * FROM useraccount";

                $result = $conn->query($sql1);
                
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["control_number"] . "</td>";
            // echo "<td>" . $row["username"] . "</td>";

            
            $stmt2 = $conn->prepare("SELECT * FROM useraccount WHERE control_number = ?");
            $stmt2->bind_param("i", $row["control_number"]);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {

     
                    $stmt3 = $conn->prepare("SELECT * FROM useraccount WHERE control_number = ?");
                    $stmt3->bind_param("i", $row2["control_number"]);
                    $stmt3->execute();
                    $result3 = $stmt3->get_result();

                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                         
                            echo "<td>". $row3["username"] ."</td>";
                            
                        }
                    } else {
                        echo "<td>No personal details found</td>";
                    }
                    $stmt4 = $conn->prepare("SELECT * FROM admin_booking WHERE control_number = ?");
                    $stmt4->bind_param("i", $row2["control_number"]);
                    $stmt4->execute();
                    $result4 = $stmt4->get_result();
                    if ($result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $bg_color = ($row4["Schedule"] == "Processed"   ) ? "red" : "green";
                            $bg_color = ($row4["Schedule"] == "Missed") ? "red" : "green";
                            echo '<td>
                            <p style="background-color: ' . $bg_color . '; border-radius: 10px; margin: 5px; color: white;">'. $row4["Schedule"] .'</p>
                            </td>';
                            echo '<td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle custom-btn" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
                            
                      
                            $check_sql = "SELECT * FROM admin_booking WHERE control_number = ?";
                            $check_stmt = $conn->prepare($check_sql);
                            $check_stmt->bind_param("i", $row2['control_number']);
                            $check_stmt->execute();
                            $check_result = $check_stmt->get_result();
                            
                            if ($check_result->num_rows > 0) {
                               
                                if ($row4["Schedule"] == "Processed") {
                          
                                    echo '<form method="post" action="AdminStudentRecords.php" style="display:inline;">
                                            <button class="dropdown-item" name="btn_vw" value="' . $row2['control_number'] . '">View</button>
                                        </form>
                                        <form method="post" action="AdminSchedule.php" style="display:inline;">
                                            <button class="dropdown-item" name="btn_schd" value="' . $row2['control_number'] . '">Schedule</button>
                                        </form>
                                       ';
                                } elseif ($row4["Schedule"] == "Missed") {
                                 
                                    echo '
                                <form method="post" action="AdminSchedule.php" style="display:inline;">
                                            <button class="dropdown-item" name="btn_schd" value="' . $row2['control_number'] . '">Reschedule</button>
                                        </form>';
                                }  elseif ($row4["Schedule"] == "Completed") {
                                    
                                    echo '<form method="post" action="Admin_student.php" style="display:inline;">
                                    <button class="dropdown-item" name="btn_vw" value="' . $row2['control_number'] . '">View Status</button>
                                </form>
                              ';
                                }else {
                                  
                                    echo '<button class="dropdown-item" disabled>Already Scheduled</button>';
                                    echo '<form method="post" action="AdminSchedule.php" style="display:inline;">
                                    <button class="dropdown-item" name="btn_vw" value="' . $row2['control_number'] . '">Edit</button>
                                </form>';
                                }
                            } else {
           
                                echo '<form method="post" action="AdminSchedule.php" style="display:inline;">
                                        <button class="dropdown-item" name="btn_schd" value="' . $row2['control_number'] . '">Schedule</button>
                                    </form>';
                                
                          
                                echo '<form method="post" action="AdminStudentRecords.php" style="display:inline;">
                                        <button class="dropdown-item" name="btn_vw" value="' . $row2['control_number'] . '">View</button>
                                    </form>';
                            }
                            
                            echo '</div>
                                </div>
                            </td>';
                        }
                    } else {
                       
                        echo '<td><p style="background-color:red; border-radius: 10px; margin: 5px; color: white;">Not scheduled</p></td>';
                        echo '<td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle custom-btn" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                
                                    <form method="post" action="AdminSchedule.php" style="display:inline;">
                                        <button class="dropdown-item" name="btn_schd" value="' . $row2['control_number'] . '">Schedule</button>
                                    </form>
                                </div>
                            </div>
                        </td>';
                    }
                }
                
            } else {
            
    
                echo "<td colspan='1'>No student info found</td>";
                echo "<td colspan='1'>No student info found</td>";
                echo "<td colspan='1'>No student info found</td>";
            }

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='12'>No results found</td></tr>";
    }



    $conn->close();
?>

   
    
                </tbody>
                </table>
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


          
const searchInput = document.getElementById('search_inpt');
const tableBody = document.getElementById('search_tbl');


searchInput.addEventListener('input', function() {
    const searchValue = this.value.toLowerCase().trim();

  
    Array.from(tableBody.getElementsByTagName('tr')).forEach(function(row) {
        const text = row.innerText.toLowerCase();

       
        if (text.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

            
        </script>
    </body>
    </html>
