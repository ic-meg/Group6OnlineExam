<?php

include "dbcon.php";

session_start();
$user_id = $_SESSION['user_id'];
// $_SESSION['Examinee_ID'];

$student_tbl =  "SELECT MAX(Student_ID) FROM student";

$result = mysqli_query($conn, $student_tbl);

$id = mysqli_fetch_assoc($result);

$std_id_inc = $id['MAX(Student_ID)'] + 1;


// for functioning lang to
$examinee_tbl =  "SELECT MAX(Examinee_ID) FROM useraccount";

$result1 = mysqli_query($conn, $examinee_tbl);

$id1 = mysqli_fetch_assoc($result1);

$examinee_id_inc = $id1['MAX(Examinee_ID)'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Requirements</title>

    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
</head>
<style>
    .student-requirements_container {
        text-align: left;
        font-family: var(--font-montserrat);
        max-width: 50%;
        margin: 0 auto;
    }

    .custom-file-input {
        cursor: pointer;
    }

    .generalDetailsForStudents {
        text-align: left;
        font-size: 20px;
        max-width: 910px;
        margin: 0 auto;
        font-family: var(--font-montserrat);
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

    @media (max-width: 768px) {

        .student-requirements_container,
        .generalDetailsForStudents {
            max-width: 90%;
        }

        .vh-100 {
            min-height: 100vh;
            padding-top: 50px;
            /* Adjust padding for spacing */
        }

        .header h4 {
            margin-left: 10px;
        }
    }
</style>

<body>



    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none;">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="StudentDashboard.php" style="border-right: 5px solid white;">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="StudentProfile.php">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="StudentExamNotAvailable.php">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam</span>
                </a>
                <a href="#">
                    <img src="./public/icon3.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Result</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Requirements</h4>
                <div class="header-icons">
                    <img src="icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
                    <script></script>
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
                <!-- CONTENT Dito -->
                <div class="student-requirements_container ">
                    <h3> STUDENT REQUIREMENTS</h3>
                    <p>Please confirm or complete the information below to begin the exam scheduling process.</p>


                </div>
                <hr>
                <!-- 
                    <div class="generalDetailsForStudents">
                        <h6> IMPORTANT NOTE:<br> Your legal name below must match the first name and
                          last name as it appears on the ID you will present for exam check in.<br>
                          If they do not match, you will not be able to take your exam and your
                          exam fee will not refunded.</h6><br><br>
                        
                    </div> -->


                <form action="StudentRequirements.php" method="POST" enctype="multipart/form-data">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="w-50">
                            <p><b>GENERAL DETAILS FOR STUDENTS</b></p>
                            <div class="">
                                <input type="text" class="form-control" id="floatingInput" required placeholder="FIRST NAME" name="firstname"><br>
                                <input type="text" class="form-control" id="floatingInput" placeholder="MIDDLE NAME" name="middlename"><br>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8">
                                    <div class="">
                                        <input type="text" class="form-control" id="lastName" required placeholder="LAST NAME" name="lastname">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="">
                                        <input type="text" class="form-control" id="suffix" placeholder="SUFFIX" name="suffix">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8">
                                    <div class="">
                                        <input type="date" class="form-control" id="birthDate" required name="birthdate" placeholder="BIRTH DATE">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="">
                                        <input type="text" class="form-control" min="1" max="100" required name="age" id="age" placeholder="AGE">
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <input type="text" class="form-control" id="floatingInput" required name="fulladdress" placeholder="FULL ADDRESS"><br>
                                <input type="text" class="form-control" id="floatingInput" required placeholder="PLACE OF BIRTH" name="pob"><br>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8">
                                    <div class="">
                                        <input type="text" class="form-control" id="mothersname" required placeholder="MOTHER'S NAME (FIRST NAME, MIDDLE NAME, LAST NAME)" name="mothername">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="">
                                        <input type="text" class="form-control" id="occupationMother" required placeholder="OCCUPATION" name="m_occupation">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8">
                                    <div class="">
                                        <input type="text" class="form-control" id="fathersname" placeholder="FATHER'S NAME (FIRST NAME, MIDDLE NAME, LAST NAME)" name="fathername">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="">
                                        <input type="text" class="form-control" id="occupationFather" required placeholder="OCCUPATION" name="f_occupation">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8">
                                    <div class="">
                                        <input type="text" class="form-control" id="guardiansname" required placeholder="GUARDIANS NAME (FIRST NAME, MIDDLE NAME, LAST NAME)" name="guardiansname">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="">
                                        <input type="text" class="form-control" id="phoneNumber" required placeholder="Phone Number" name="phone_Number">
                                    </div>
                                </div>

                            </div>
                            <input type="text" class="form-control" id="floatingInput" required placeholder="RELATIONSHIP" name="relationship"><br>

                            <?php

                            $personal_tbl =  "SELECT MAX(personal_id) FROM personal_details";

                            $result = mysqli_query($conn, $personal_tbl);

                            $id = mysqli_fetch_assoc($result);

                            $personal_id_inc = $id['MAX(personal_id)'] + 1;



                            ?>

                            <hr>



                            <p><b>ACADEMIC FOR STUDENTS</b></p>

                            <div class="">
                                <input type="text" class="form-control" id="schoolName" required placeholder="SCHOOL NAME" name="schoolname"><br>


                            </div>
                            <select class="form-select" id="COURSE" required aria-label="COURSE" name="track">
                                <option selected>Choose your track</option>
                                <option value="STEM">STEM</option>
                                <option value="ABM">ABM</option>
                                <option value="HUMSS">HUMSS</option>
                                <option value="TVL-ICT">TVL - ICT </option>
                                <option value="TVL-Home Economics">TVL - Home Economics</option>
                                <option value="TVL-Industrial Arts">TVL - Industrial Arts</option>
                            </select> <br>
                            <input type="text" class="form-control" id="sy" required min="1" max="100" placeholder="GENERAL WEIGHTED AVERAGE (GWA)" name="GWA" oninput="validateNumberInput(event)">


                            <?php

                            $academic_tbl =  "SELECT MAX(academic_id) FROM academic_details";

                            $result = mysqli_query($conn, $academic_tbl);

                            $id = mysqli_fetch_assoc($result);

                            $academic_id_inc = $id['MAX(academic_id)'] + 1;


                            ?>


                            <hr>
                            <p><b>REQUIRED DOCUMENTS</b></p>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="FORM137" required name="form137">
                                        <label class="custom-file-label" for="FORM137">FORM137</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="FORM138" required name="form138">
                                        <label class="custom-file-label" for="FORM138">FORM138</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="PSA" required name="psa">
                                        <label class="custom-file-label" for="PSA">PSA</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="1X1PIC" required name="1x1pic">
                                        <label class="custom-file-label" for="1X1PIC">1X1 PICTURE</label>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $requirement_tbl =  "SELECT MAX(requirement_id) FROM requirements";

                            $result = mysqli_query($conn, $requirement_tbl);

                            $id = mysqli_fetch_assoc($result);

                            $requirement_id_inc = $id['MAX(requirement_id)'] + 1;



                            ?>

                            <br>
                            <!-- Submit Button -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success rounded-pill w-100" name="submit">Submit</button>
                                </div>
                            </div>
                </form>

            </div>

        </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script>
        //  custom file input labels display the selected file name
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
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

        function msg() {
            alert("Hello Student " + <?= $std_id_inc ?> + " you are now registered. Your schedule is now on process.");
            // Successful upload, now redirect

        }

        function validateNumberInput(event) {
            const input = event.target;
            let value = input.value;


            value = value.replace(/[^0-9.]/g, '');


            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }

            input.value = value;
        }
    </script>
</body>
<?php

if (isset($_POST["submit"])) {

    if (
        !empty($_POST["firstname"]) && !empty($_POST["lastname"]) &&
        !empty($_POST["birthdate"]) && !empty($_POST["age"]) &&
        !empty($_POST["fulladdress"]) && !empty($_POST["pob"]) && !empty($_POST["mothername"]) &&
        !empty($_POST["m_occupation"]) && !empty($_POST["fathername"]) && !empty($_POST["f_occupation"]) &&
        !empty($_POST["schoolname"]) && !empty($_POST["track"]) && !empty($_POST["GWA"]) &&
        isset($_FILES["form137"]) && isset($_FILES["form138"]) && isset($_FILES["psa"]) && isset($_FILES["1x1pic"])
    ) {




        $firstname = $_POST["firstname"];
        $middlename = $_POST["middlename"];
        $lastname = $_POST["lastname"];
        $suffix = $_POST["suffix"];
        $birthdate = $_POST["birthdate"];
        $age = $_POST["age"];
        $fulladdress = $_POST["fulladdress"];
        $pob = $_POST["pob"];
        $mother_name = $_POST["mothername"];
        $mother_occupation = $_POST["m_occupation"];
        $father_name = $_POST["fathername"];
        $father_occupation = $_POST["f_occupation"];
        $guardiansName = $_POST["guardiansname"];
        $guardianPhone = $_POST["phone_Number"];
        $relationship = $_POST["relationship"];

        // ACADEMIC FOR STUDENT
        $schoolname = $_POST["schoolname"];
        $track = $_POST["track"];
        $gwa = $_POST["GWA"];

        // REQUIREMENTS FOR STUDENTS
        $folder = "RequiredDocu/";

        // Function to sanitize filenames
        function sanitizeFilename($filename)
        {
            return preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
        }

        $form137 = $folder . sanitizeFilename(basename($_FILES["form137"]["name"]));
        $temp_form137 = $_FILES["form137"]["tmp_name"];

        $form138 = $folder . sanitizeFilename(basename($_FILES["form138"]["name"]));
        $temp_form138 = $_FILES["form138"]["tmp_name"];

        $PSA = $folder . sanitizeFilename(basename($_FILES["psa"]["name"]));
        $temp_psa = $_FILES["psa"]["tmp_name"];

        $pic1x1 = $folder . sanitizeFilename(basename($_FILES["1x1pic"]["name"]));
        $temp_pic1x1  = $_FILES["1x1pic"]["tmp_name"];


        $std_tbl_query = "INSERT INTO student (Student_ID, Examinee_ID) VALUES (?, ?)";
        $stmt_std_tbl = $conn->prepare($std_tbl_query);
        if (!$stmt_std_tbl) {
            die('Prepare error (student): ' . $conn->error);
        }
        $stmt_std_tbl->bind_param("ii", $std_id_inc, $examinee_id_inc);

        if ($stmt_std_tbl->execute()) {
            $std_id = $conn->insert_id;


            $prnl_tbl_query = "INSERT INTO personal_details (student_id, personal_id, firstname, middlename, lastname, suffix, birthdate, age, fullAddress, placeOfBirth, mothersName, fathersName, mothers_occupation, father_occupation, guardiansName, guardianPhone, relationship) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt_prnl_tbl = $conn->prepare($prnl_tbl_query);
            if (!$stmt_prnl_tbl) {
                die('Prepare error (personal_details): ' . $conn->error);
            }
            $stmt_prnl_tbl->bind_param("iissssssissssssss", $std_id, $personal_id_inc, $firstname, $middlename, $lastname, $suffix, $birthdate_formatted, $age, $fulladdress, $pob, $mother_name, $father_name, $mother_occupation, $father_occupation, $guardiansName, $guardianPhone, $relationship);

            // Format the birthdate
            $birthdate_formatted = date_format(date_create($birthdate), 'Y-m-d');

            if (!$stmt_prnl_tbl->execute()) {
                echo '<script>alert("Error inserting personal details: ' . $stmt_prnl_tbl->error . '");</script>';
            }

            // Insert into academic_details table
            $acd_tbl_query = "INSERT INTO academic_details (student_id, academic_id, seniorHighSchool, strand, GWA) 
                              VALUES (?, ?, ?, ?, ?)";
            $stmt_acd_tbl = $conn->prepare($acd_tbl_query);
            if (!$stmt_acd_tbl) {
                die('Prepare error (academic_details): ' . $conn->error);
            }
            $stmt_acd_tbl->bind_param("iissi", $std_id, $academic_id_inc, $schoolname, $track, $gwa);

            if (!$stmt_acd_tbl->execute()) {
                echo '<script>alert("Error inserting academic details: ' . $stmt_acd_tbl->error . '");</script>';
            }

            // Insert into requirements table
            $rqmn_tbl_query = "INSERT INTO requirements (student_id, requirement_id, form137, form138, PSA, 1x1) 
                               VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_rqmn_tbl = $conn->prepare($rqmn_tbl_query);
            if (!$stmt_rqmn_tbl) {
                die('Prepare error (requirements): ' . $conn->error);
            }
            $stmt_rqmn_tbl->bind_param("iissss", $std_id, $requirement_id_inc, $form137, $form138, $PSA, $pic1x1);

            if (!$stmt_rqmn_tbl->execute()) {
                echo '<script>alert("Error inserting requirements: ' . $stmt_rqmn_tbl->error . '");</script>';
            }

            // Move uploaded files
            if (
                move_uploaded_file($temp_form137, $form137) &&
                move_uploaded_file($temp_form138, $form138) &&
                move_uploaded_file($temp_psa, $PSA) &&
                move_uploaded_file($temp_pic1x1, $pic1x1)
            ) {

                // Fetch Student_ID from student table based on Examinee_ID
                $sql_fetch_student_id = "SELECT Student_ID FROM student WHERE Examinee_ID = ?";
                $stmt_fetch_student_id = $conn->prepare($sql_fetch_student_id);
                if (!$stmt_fetch_student_id) {
                    die('Prepare error (fetch_student_id): ' . $conn->error);
                }
                $stmt_fetch_student_id->bind_param("s", $user_id);
                $stmt_fetch_student_id->execute();
                $stmt_fetch_student_id->bind_result($student_id);
                $stmt_fetch_student_id->fetch();
                $stmt_fetch_student_id->close();

                // Update admin_booking table with the fetched Student_ID
                $sql_update_booking = "INSERT INTO admin_booking (Student_ID, Schedule) VALUES (?, 'Processed')";
                $stmt_update_booking = $conn->prepare($sql_update_booking);
                if (!$stmt_update_booking) {
                    die('Prepare error (update_booking): ' . $conn->error);
                }
                $stmt_update_booking->bind_param("i", $student_id); 
                $stmt_update_booking->execute();

                if ($stmt_update_booking) {

                    echo "<script>";
                    echo "var studentId = '" . $student_id . "';";
                    echo "Swal.fire({
                            title: 'Success!',
                            html: 'You have successfully filled out all required documents. Your Student ID is: <strong>' + studentId + '</strong>.<br>The scheduling process will begin.',
                            icon: 'success',
                            confirmButtonColor: '#448b4f',
                            confirmButtonTextColor: '#ffffff'
                        }).then(function() {
                            window.location.href = 'http://localhost/Group6OnlineExam/StudentDashboard.php';
                        });";
                    echo "</script>";
                    exit;
                } else {
                    echo '<script>alert("Failed to update admin_booking table.");</script>';
                }

                $stmt_update_booking->close();
                $conn->close();
            } else {
                echo "<script>
                Swal.fire({
                  title: 'Incomplete!',
                  text: 'Failed to upload one or more required files.',
                  icon: 'error',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                });
                </script>";
            }
        } else {
            echo "<script>
            Swal.fire({
              title: 'Error!',
              text: 'Error inserting student: " . $stmt_std_tbl->error . "',
              icon: 'error',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            });
            </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
          title: 'Error!',
          text: 'Please fill out all required fields.',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK'
        });
        </script>";
    }
}
?>

</html>




<script>
    const birthDateInput = document.getElementById('birthDate');

    const ageInput = document.getElementById('age');

    birthDateInput.addEventListener('change', function() {
        const birthDate = new Date(this.value);
        const today = new Date();


        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        ageInput.value = age;
    });

    function logoutRedirect() {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to log out?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#448b4f",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, log out."
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php';
            }
        });
    }
</script>