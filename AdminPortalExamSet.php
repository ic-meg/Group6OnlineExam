<?php
session_start();
include "dbcon.php";


$sqlExamSet = "SELECT * FROM admin_exam_set";
$result = mysqli_query($conn, $sqlExamSet);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['exam_id'] = $row['exam_id'];
} else {
    echo "Error fetching data or no data found";
    exit;
}


$totalItems = isset($_SESSION['totalItems']) ? $_SESSION['totalItems'] : 'N/A';


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Exam Set</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="AdminPortalExamSet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="Redirect.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap"/>
    <style>
        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .floating-label input {
            padding: 1.8rem 0.75rem 0.25rem;
        }

        .floating-label label {
            position: absolute;
            top: 0.45rem;
            left: 0.75rem;
            font-size: 1rem;
            transition: all 0.2s ease-out;
            pointer-events: none;
            color: #999;
        }

        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            top: 0.35rem;
            left: 0.75rem;
            font-size: 0.75rem;
            color: #000;
        }

        .custom-btn {
            background-color: var(--color-darkslategray-100);
            color: #fff; 
            border-color: #6c757d;
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
        .header h4 {
            font-family: var(--font-montserrat);
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
                <a href="AdminDashboard.php">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="AdminProfile.php">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="AdminPortalExamSet.php" style="border-right: 5px solid white;">
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
                <h4>Admin Exam Set</h4>
                <div class="header-icons">
                
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
            <div class="content" id="content"><br><br><br><br><br>
                <!-- <div class="search-and-table-container">
                    <div class="group">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                            <g>
                                <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                            </g>
                        </svg>
                        <input class="input" type="search" placeholder="Search" />
                    </div> -->
                    
                        <table class="table table-striped">
                            <thead class="headExam">
                                <tr>
                                    <th colspan="6">Exam Set List</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Information</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $row['exam_id'] ?></th>
                                    <td><?php echo $row['date'] ?></td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td>Duration: <?php echo $row['duration']?> mins<br>Total items: <?php echo htmlspecialchars($totalItems); ?></td>
                                    <td class="active">Active</td>
                                    
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle custom-btn" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" href="ExamSetView.php">View</a>
                                                <a class="dropdown-item" href="#" id="editExamSet1">Edit</a>
                                                
                          
                                            </div>
                                        </div>
                                    </td>
                            </tbody>
                        </table>
                    
                </div>
            </div>
        </div>
    </div>

<!--Edit Exam Set Modal-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="update_exam_set.php"> <!-- Ensure correct action -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Exam Set</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="examSetTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="examSetTitle" name="examSetTitle" placeholder="Enter Title" required>
                    </div>
                    <input type="hidden" id="exam_id" name="exam_id"> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="saveChangesBtn" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

 <!--Delete Exam Set Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Exam Set</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal body content -->
                    <p>Are you sure to delete [title] from exam list?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Continue</button>
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
        $(document).ready(function() {
        $('#editExamSet1').click(function(e) {
            e.preventDefault();
            var exam_id = $(this).data('exam-id'); 
            var examSetTitle = $(this).data('exam-title'); 
            $('#exam_id').val(exam_id); 
            $('#examSetTitle').val(examSetTitle); 
            $('#editModal').modal('show');
        });
    });

        $(document).ready(function() {
            $('#deleteExamSet1').click(function(e) {
                e.preventDefault();
                $('#deleteModal').modal('show');
            });
        });
    </script>
    
</body>
</html>
