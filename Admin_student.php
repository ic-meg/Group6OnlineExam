<?php
include "dbcon.php";

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Examinee</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="./SPEL.css">
    <link rel="stylesheet" href="AdminPortalExamSet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />
    <style>
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

        .col-lg-6 {
            padding: 10px;
        }

        #search {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        #search>h4 {
            margin-right: 10px;
        }

        #search_inpt {
            border-radius: 10px;
            border: 2px gray solid;

        }

        @media only screen and (max-width: 992px) {

            #search {
                justify-content: flex-start;
                align-items: flex-start;
            }

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
                <a href="#">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="#">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="#">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam Set</span>
                </a>
                <a href="#">
                    <img src="    ./public/icon25.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Manage Examinee</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Examinees </h4>
                <div class="header-icons">
                    <img src="icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
                    <button class="Btn">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <script src="Redirect.js"></script>
                        <div class="text" onclick="logoutRedirect()">Logout</div>
                    </button>
                </div>
            </div>
            <div class="content" id="content">
                <table class="table" style="text-align: center;">
                    <div class="row">

                        <thead class="headExam">
                            <tr>
                                <th colspan="6">List of Examinees</th>
                            </tr>
                        </thead><br> <br><br>

                        <div class="search-and-table-container">
                            <div class="group" id="search">
                                <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                                    <g>
                                        <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                                    </g>
                                </svg>
                                <input class="input" type="search" placeholder="Search" id="search_inpt" />
                            </div>

                        </div>
                        <thead>
                            <tr>
                                <th scope="col">Student ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Score</th>
                            </tr>
                        </thead>
                        <tbody id='search_tbl'>
                            <?php
                            $sql1 = "SELECT  * FROM student_examination_score";

                            $result = $conn->query($sql1);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";

                                    echo "<td>" . $row["control_number"] . "</td>";

                                    $stmt1 = $conn->prepare("SELECT * FROM useraccount WHERE control_number = ?");
                                    $stmt1->bind_param("i", $row["control_number"]);
                                    $stmt1->execute();
                                    $result1 = $stmt1->get_result();

                                    if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {

                                            echo "<td>" . $row1["username"] . "</td>";
                                        }
                                    } else {
                                        echo "<td>--</td>";
                                    }
                                    if ($row["status"] == "PASSED" || $row["status"] == "passed") {
                                        echo '<td><p style = "background-color:green; border-radius: 10px; margin: 5px; color: white;">' . $row["status"] . '</p></td>';
                                    } else {
                                        echo '<td><p style = "background-color:red; border-radius: 10px; margin: 5px; color: white;">' . $row["status"] . '</p></td>';
                                    }

                                    echo "<td>" . $row["total_score"] . "</td>";

                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>--</td></tr>";
                            }
                            ?>
                        </tbody>

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