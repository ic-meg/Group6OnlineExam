<?php
include "dbcon.php";

if (isset($_POST['btn_vw'])) {
    $contol_number = $_POST['btn_vw'];


    $sql = "SELECT * FROM requirements WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $base_folder = "RequiredDocu/";

        while ($row = $result->fetch_assoc()) {

            $form137_path = (strpos($row['form137'], $base_folder) === false && !is_absolute_path($row['form137'])) ? $base_folder . $row['form137'] : $row['form137'];
            $form138_path = (strpos($row['form138'], $base_folder) === false && !is_absolute_path($row['form138'])) ? $base_folder . $row['form138'] : $row['form138'];
            $psa_path = (strpos($row['PSA'], $base_folder) === false && !is_absolute_path($row['PSA'])) ? $base_folder . $row['PSA'] : $row['PSA'];
            $pic1x1_path = (strpos($row['1x1'], $base_folder) === false && !is_absolute_path($row['1x1'])) ? $base_folder . $row['1x1'] : $row['1x1'];


            $form137_filename = basename($form137_path);
            $form138_filename = basename($form138_path);
            $psa_filename = basename($psa_path);
            $pic1x1_filename = basename($pic1x1_path);
        }
    } else {
        echo '<p>No records found for student ID: ' . $student_id . '</p>';
    }

    $stmt->close();
    $conn->close();
}


function is_absolute_path($path)
{
    return ($path[0] === '/' || $path[0] === '\\' || strpos($path, ':') !== false);
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Examinee</title>
    <link rel="stylesheet" href="AdminStudentRecords.css">
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

            .sidebar {
                background-color: #13443E;
            }
        }
    </style>
</head>

<body>
    <?php
    include "dbcon.php";

    if (isset($_POST['btn_vw'])) {
        $student_id = $_POST['btn_vw'];
    }
    ?>
    <!-------- NAR BAR ------>
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
                <a href="AdminProfile.php">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="AdminPortalExamSet.php">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam Set</span>
                </a>
                <a href="AdminManageExaminee.php" style="border-right: 5px solid white;">
                    <img src="./public/icon25.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Manage Examinee</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Admin Manage Examinee</h4>
                <div class="header-icons">
                    <img src="icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
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
                <!-- <section style="background-color: #eee;"> -->
                <div class="container py-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-------- PROFILE -------->
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="profile-pic.png" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3">
                                        <?php

                                        $stmt = $conn->prepare("SELECT firstname, middlename, lastname FROM personal_details WHERE student_id = ?");
                                        $stmt->bind_param("i", $student_id);


                                        $stmt->execute();


                                        $stmt->bind_result($firstname, $middlename, $lastname);


                                        if ($stmt->fetch()) {
                                            echo $firstname . " " . $middlename . " " . $lastname;
                                        } else {
                                            echo "No student found with ID: " . $student_id;
                                        }


                                        $stmt->close();
                                        ?>
                                    </h5>
                                    <p class="text-muted mb-3">
                                        <?php

                                        $stmt = $conn->prepare("SELECT Examinee_ID FROM student WHERE Student_ID = ?");
                                        $stmt->bind_param("i", $student_id);


                                        $stmt->execute();


                                        $stmt->bind_result($Examinee_ID);

                                        if ($stmt->fetch()) {
                                            echo "Examinee ID:" . $Examinee_ID;
                                        } else {
                                            echo "No student found with ID: " . $Student_ID;
                                        }


                                        $stmt->close();
                                        ?>
                                    </p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <form method="post" action="AdminSchedule.php">
                                            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                                            <button type="submit" name="btn_schd" value="<?php echo $student_id; ?>" class="btn1">Schedule Now</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-------- REQUIREMENTS -------->
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <img class="admin-portal-viewexaminee-child5" src="./public/rectangle-103@2x.png" />
                                            <p class="form137 mb-0"><a href="<?php echo htmlspecialchars($form137_path); ?>" target="_blank"><?php echo $form137_filename ?></a></p>
                                            <i class="fas fa-globe fa-lg text-warning"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <img class="admin-portal-viewexaminee-child6" src="./public/rectangle-103@2x.png" />
                                            <p class="mb-0"><a href="<?php echo htmlspecialchars($form138_path); ?>" target="_blank"><?php echo $form138_filename ?></a></p>
                                            <i class="fab fa-github fa-lg text-body"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <img class="admin-portal-viewexaminee-child7" src="./public/rectangle-103@2x.png" />
                                            <p class="mb-0"><a href="<?php echo htmlspecialchars($psa_path); ?>" target="_blank"><?php echo $psa_filename ?></a></p>
                                            <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <img class="admin-portal-viewexaminee-child5" src="./public/rectangle-103@2x.png" />
                                            <p class="mb-0"><a href="<?php echo htmlspecialchars($pic1x1_path); ?>" target="_blank"><?php echo $pic1x1_filename ?></a></p>
                                            <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-------- col-lg-4 -------->

                        <!-------- GENERAL DETAILS  -------->
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                <?php
                                                // Prepare and bind
                                                $stmt = $conn->prepare("SELECT firstname, middlename, lastname FROM personal_details WHERE student_id = ?");
                                                $stmt->bind_param("i", $student_id);

                                       
                                                $stmt->execute();

                                          
                                                $stmt->bind_result($firstname, $middlename, $lastname);

                                                // Fetch the result
                                                if ($stmt->fetch()) {
                                                    echo $firstname . " " . $middlename . " " . $lastname;
                                                } else {
                                                    echo "No student found with ID: " . $student_id;
                                                }


                                                $stmt->close();
                                                ?>

                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                <?php
                                                if (isset($_POST['btn_vw'])) {
                                                    $student_id = $_POST['btn_vw'];

                                                    $stmt = $conn->prepare("SELECT email FROM useraccount WHERE Examinee_ID = (SELECT Examinee_ID FROM student WHERE Student_ID = ?)");
                                                    $stmt->bind_param("i", $student_id);


                                                    $stmt->execute();


                                                    $stmt->bind_result($email);


                                                    if ($stmt->fetch()) {
                                                        echo $email;
                                                    } else {
                                                        echo "No student found with ID: " . $student_id;
                                                    }


                                                    $stmt->close();
                                                } else {
                                                    echo "Student ID not provided.";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Birthdate</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                <?php

                                                $stmt = $conn->prepare("SELECT birthdate FROM personal_details WHERE student_id = ?");
                                                $stmt->bind_param("i", $student_id);


                                                $stmt->execute();


                                                $stmt->bind_result($birthdate);

                                                if ($stmt->fetch()) {
                                                    echo $birthdate;
                                                } else {
                                                    echo "No student found with ID: " . $student_id;
                                                }


                                                $stmt->close();
                                                ?>

                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Age</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                <?php

                                                $stmt = $conn->prepare("SELECT age FROM personal_details WHERE student_id = ?");
                                                $stmt->bind_param("i", $student_id);


                                                $stmt->execute();


                                                $stmt->bind_result($age);

                                                if ($stmt->fetch()) {
                                                    echo $age;
                                                } else {
                                                    echo "No student found with ID: " . $student_id;
                                                }


                                                $stmt->close();
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                <?php

                                                $stmt = $conn->prepare("SELECT fullAddress FROM personal_details WHERE student_id = ?");
                                                $stmt->bind_param("i", $student_id);

                                                $stmt->execute();

                                                $stmt->bind_result($fullAddress);


                                                if ($stmt->fetch()) {
                                                    echo $fullAddress;
                                                } else {
                                                    echo "No student found with ID: " . $student_id;
                                                }

                                                $stmt->close();
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-------- card mb-4 -------->

                            <!-------- ACADEMIC FOR STUDENTS -------->
                            <div class="col-lg-13">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Senior High School</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <?php

                                                    $stmt = $conn->prepare("SELECT seniorHighSchool FROM academic_details WHERE student_id = ?");
                                                    $stmt->bind_param("i", $student_id);


                                                    $stmt->execute();


                                                    $stmt->bind_result($seniorHighSchool);


                                                    if ($stmt->fetch()) {
                                                        echo $seniorHighSchool;
                                                    } else {
                                                        echo "No student found with ID: " . $student_id;
                                                    }


                                                    $stmt->close();
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Strand</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <?php

                                                    $stmt = $conn->prepare("SELECT strand FROM academic_details WHERE student_id = ?");
                                                    $stmt->bind_param("i", $student_id);

                                                 
                                                    $stmt->execute();

                                                    $stmt->bind_result($strand);

                                                    if ($stmt->fetch()) {
                                                        echo $strand;
                                                    } else {
                                                        echo "No student found with ID: " . $student_id;
                                                    }

                                                    
                                                    $stmt->close();
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">General Weighted Average</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">
                                                    <?php
                                                    // Prepare and bind
                                                    $stmt = $conn->prepare("SELECT GWA FROM academic_details WHERE student_id = ?");
                                                    $stmt->bind_param("i", $student_id);

                                                    // Execute the query
                                                    $stmt->execute();

                                                    $stmt->bind_result($GWA);

                                                    if ($stmt->fetch()) {
                                                        echo $GWA;
                                                    } else {
                                                        echo "No student found with ID: " . $student_id;
                                                    }

                                                 
                                                    $stmt->close();
                                                    ?>
                                                </p>
                                            </div>
                                        </div>


                                    </div>
                                </div> <!-------- card mb-4 -------->

                                <!-------- EMERGENCY CONTACT -------->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                Emergency Contact
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Guardian Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            <?php
                                                            // Prepare and bind
                                                            $stmt = $conn->prepare("SELECT guardiansName FROM personal_details WHERE student_id = ?");
                                                            $stmt->bind_param("i", $student_id);

                                                      
                                                            $stmt->execute();

                                                            $stmt->bind_result($guardiansName);

                                                            // Fetch the result
                                                            if ($stmt->fetch()) {
                                                                echo $guardiansName;
                                                            } else {
                                                                echo "No student found with ID: " . $student_id;
                                                            }

                                                            $stmt->close();
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Relationship</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            <?php
                                                           
                                                            $stmt = $conn->prepare("SELECT relationship FROM personal_details WHERE student_id = ?");
                                                            $stmt->bind_param("i", $student_id);

                                                            $stmt->execute();

                                                            $stmt->bind_result($relationship);

                                                            if ($stmt->fetch()) {
                                                                echo $relationship;
                                                            } else {
                                                                echo "No student found with ID: " . $student_id;
                                                            }

                                                            $stmt->close();
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Contact Number</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            <?php
                                                            // Prepare and bind
                                                            $stmt = $conn->prepare("SELECT guardianPhone FROM personal_details WHERE student_id = ?");
                                                            $stmt->bind_param("i", $student_id);

                                                            // Execute the query
                                                            $stmt->execute();

                                                            // Bind result variables
                                                            $stmt->bind_result($guardianPhone);

                                                            // Fetch the result
                                                            if ($stmt->fetch()) {
                                                                echo $guardianPhone;
                                                            } else {
                                                                echo "No student found with ID: " . $student_id;
                                                            }

                                                            // Close statement and connection
                                                            $stmt->close();
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> <!-------- card-body -------->
                                        </div> <!-------- card -------->
                                    </div> <!-------- col-lg-12 -------->
                                </div> <!-------- row emergency contact -------->
                            </div> <!-------- col-lg-8 -------->
                        </div> <!-------- row  -------->
                    </div> <!-------- container py-5 -------->
                    </section>

                </div>
            </div>
        </div>
        <script>
            function schedule() {
                window.location.href = 'AdminSchedule.php';
            }

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