<?php
session_start();
include "dbcon.php";
// $email = $_SESSION['user_email'];
// echo $email;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_schd'])) {
    $control_number = $_POST['btn_schd'];
    $_SESSION['control_number'] = $control_number;

   
    $check_sql = "SELECT * FROM useraccount WHERE control_number = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $control_number);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        
    } else {
        
        echo "<script>
            alert('Student does not exist.');
            window.location.href = 'AdminManageExaminee.php';
        </script>";
        exit();
    }
    $check_stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBtn'])) {
    $selected_date = $_POST['selected_date'];
    $selected_time = $_POST['selected_time'];
    $control_number = $_SESSION['control_number'];

    $selected_date = date('Y-m-d', strtotime($selected_date)); 

    
    $check_sql = "SELECT * FROM admin_booking WHERE control_number = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $control_number);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $schedule_row = $check_result->fetch_assoc();
        $current_date = $schedule_row['date'];
        $current_time = $schedule_row['time'];

        if ($selected_date == $current_date && $selected_time == $current_time) {
        
            echo "<script>
                alert('The new schedule is the same as the current schedule.');
                window.location.href = 'AdminManageExaminee.php';
            </script>";
            exit();
        } else {
            $update_sql = "UPDATE admin_booking SET date = ?, time = ?, Schedule = 'Scheduled' WHERE control_number = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $selected_date, $selected_time, $control_number);
        
            if ($update_stmt->execute()) {
  
                include 'emailsched.php';

                $EmailAddress = $_SESSION['user_email'];
                $firstname = $_SESSION['username']; 
                $formatted_date = date("l, F j, Y", strtotime($selected_date)); 
                $formatted_time = date("g:i A", strtotime($selected_time)); 
    
                sendemail_notify($EmailAddress, $formatted_date, $formatted_time, 'update');

            
                echo "<script>
                    alert('Booking updated successfully.');
                    window.location.href = 'AdminManageExaminee.php';
                </script>";
                exit(); 
            } else {
                echo "Error: " . htmlspecialchars($update_stmt->error); 
            }
        
            $update_stmt->close();
        }
        
    } else {
      
        $insert_sql = "INSERT INTO admin_booking (control_number, date, time, Schedule) VALUES (?, ?, ?, 'Scheduled')";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iss", $control_number, $selected_date, $selected_time);

        if ($insert_stmt->execute()) {
            include 'emailsched.php';
        
                $EmailAddress = $_SESSION['user_email'];
                $firstname = $_SESSION['username']; 
                $formatted_date = date("l, F j, Y", strtotime($selected_date)); 
                $formatted_time = date("g:i A", strtotime($selected_time)); 
        
                sendemail_notify($EmailAddress, $formatted_date, $formatted_time, 'create');

            echo "<script>
                alert('Booking created successfully.');
                window.location.href = 'AdminManageExaminee.php';
            </script>";
            exit(); 
        } else {
            echo "Error: " . htmlspecialchars($insert_stmt->error); 
        }

        $insert_stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Entrance Exam | Schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="calendar.css">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
   
    <script src="Redirect.js"></script>
   
    <link rel="stylesheet" href="AdminSchedule.css">
    
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
    
</head>
<style>
                * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start; 
            margin: 0 auto; 
            max-width: 1200px; 
        }

        .calendar {
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            width: 100%;
            max-width: 500px;
            padding: 1rem;
            background: #fff;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);
        }

        .calendar header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .calendar nav {
            display: flex;
            align-items: center;
        }

        .calendar ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            text-align: center;
        }

        .calendar ul li {
            width: calc(100% / 7);
            margin-top: 25px;
            position: relative;
            z-index: 2;
        }

        #prev,
        #next {
            width: 20px;
            height: 20px;
            position: relative;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        #prev::before,
        #next::before {
            content: "";
            width: 50%;
            height: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            border-style: solid;
            border-width: 0.25em 0.25em 0 0;
            border-color: #ccc;
        }

        #next::before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        #prev::before {
            transform: translate(-50%, -50%) rotate(-135deg);
        }

        #prev.disabled::before,
        #next.disabled::before {
            border-color: #ddd;
            cursor: not-allowed;
        }

        #prev:hover::before,
        #next:hover::before {
            border-color: #000;
        }

        .days {
            font-weight: 600;
        }

        .dates li.today {
            color: #fff;
        }

        .dates li.today::before {
            content: "";
            width: 2rem;
            height: 2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #000;
            border-radius: 50%;
            z-index: -1;
        }

        .dates li.inactive {
            color: #ccc;
        }

        .dates li.disabled {
            color: #ccc;
            pointer-events: none;
            cursor: not-allowed;
        }

        .dates li.selected {
            position: relative;
            color: white;
        }

        .dates li.selected::before {
            content: "";
            width: 2rem;
            height: 2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #01343E;
            border-radius: 50%;
            z-index: -1;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
                justify-content: flex-start; 
            }

            .calendar {
                margin-left: 0px; 
                margin-top: 2rem; 
            }
        }
    .custom-button {
        width: 128px;
        position: relative;
        box-shadow: 0 4px 4px 3px rgba(0, 0, 0, 0.25);
        border-radius: var(--br-10xs);
        margin-right: 20px; 
        margin-bottom: 10px; 
        font-family: var(--font-montserrat);
        height: 57px;
         z-index: 0;
        border: none;
        font-size: 18px;
        outline: none; 
        
    }
    .custom-button:hover {
        background-color: #13443E; 
        box-shadow: 0 4px 4px 3px rgba(0, 0, 0, 0.25); 
        color: white;
    }
    .custom-button:focus,
    .custom-button:active {
        outline: none; 
    }
    .time-Frame{
        margin-left: 300px;
    }
    @media only screen and (max-width: 768px){
        .time-Frame{
            margin: auto;
        }
    }
    /* Laptop
    @media only screen and (min-width: 1280px){
        .calendar{
            margin-left: 700px;
        }
    } */
     /* Monitor */
    @media only screen and (min-width: 1440px) {
        .calendar {
            margin-left: 450px;
        }
    }
    ol.SelectDate li{
        font-family: var(--font-montserrat); 
        font-weight: 400; 
        font-size: larger;
        
       
    }
    ol.SelectDate span{
        font-family: var(--font-montserrat); 
        font-weight: 400; 
        font-size: larger;

    }
    ol.SelectDate {
        margin-left: 30px; margin: 30px;
    }
    #recommended-time-section {
        display: none;
    }
    
.bg-dark-green {
  background-color: #13443E;
}
.sidebar a:hover {
    background-color: rgba(255, 255, 255, .075);
    border-right: 5px solid white; 
}



    </style>

<body>
    <div class="d-flex" >
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus" >
                <img src="CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none;font-size: px;">CvSU - Imus Campus</h4>
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
                <a href="AdminManageExaminee.php"style="border-right: 5px solid white;">
                    <img src="./public/icon25.svg" alt="Result Icon" class="menu-icon" >
                    <span class="menu-label" >Manage Examinee</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1" >
            <div class="header d-flex justify-content-between align-items-center" style="height: 7vh;">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4 style="margin-bottom: -6px;">Schedule</h4>
                <div class="header-icons">
                    
                    <img src="icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <!-- Include your custom redirect.js -->
                 
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
                    <div class="admin-portal-schedule-appoin">
                    <ol type="1" class="SelectDate" >
                        <li >Select date and time</li>
                        <hr>
                        <span>Select a date from the calendar. Only dates with appointment availability can be selected.</span>
                   
                        <div class="">
                        <div class="">
                            <div class="calendar mr-5" style="cursor: pointer;">
                            <header>
                                <h3></h3>
                                <nav>
                                <button id="prev"></button>
                                <button id="next"></button>
                                </nav>
                            </header>
                            <section>
                                <ul class="days">
                                <li>Sun</li>
                                <li>Mon</li>
                                <li>Tue</li>
                                <li>Wed</li>
                                <li>Thu</li>
                                <li>Fri</li>
                                <li>Sat</li>
                                </ul>
                                <ul class="dates"></ul>
                            </section>
                            </div>
                        </div>
                    </div>
                    <br>
                   
                    
                    <div class="selected-date mr-5">
                      <li style="font-family: var(--font-montserrat); font-weight: 400; font-size: larger;">Select time (Morning or Afternoon)</li>
                      <hr>
                    
                    <div class="time-Frame">
                      <div class="calendar-info" style="margin-left: 100px; padding: 10px; ">
                        <p style="font-family: var(--font-montserrat); font-weight: bold; font-size: 25px">Morning</p>
                        
                        <button type="button" class="custom-button" onclick="selectTimeMorning(this)">8:00</button>
                        <button type="button" class="custom-button" onclick="selectTimeMorning(this)">8:30</button>
                        <button type="button" class="custom-button" onclick="selectTimeMorning(this)">9:00</button>
                        <button type="button" class="custom-button" onclick="selectTimeMorning(this)">9:30</button>
                      </div>
                      <div class="calendar-info" style="margin-left: 100px; padding: 10px; margin-top: -10px; ">
                        <button type="button" class="custom-button" onclick="selectTimeMorning(this)">10:00</button>
                        <button type="button" class="custom-button" onclick="selectTimeMorning(this)">10:30</button>
                        <button type="button" class="custom-button" onclick="selectTimeMorning(this)">11:00</button>
                        <button type="button" class="custom-button" onclick="selectTimeMorning(this)">11:30</button>
                      </div>
                      <div class="calendar-info" style="margin-left: 100px; padding: 10px; margin-top: -10px; ">
                        <button type="button" class="custom-button" onclick="selectTime(this)">12:00</button>
                        <button type="button" class="custom-button" onclick="selectTime(this)">12:30</button>
                      </div>
                      <div class="calendar-info" style="margin-left: 100px; padding: 10px; ">
                        <p style="font-family: var(--font-montserrat); font-weight: bold; font-size: 25px">Afternoon</p>
                        
                        <button type="button" class="custom-button" onclick="selectTimeAfternoon(this)">13:00</button>
                        <button type="button" class="custom-button" onclick="selectTimeAfternoon(this)">13:30</button>
                        <button type="button" class="custom-button" onclick="selectTimeAfternoon(this)">14:00</button>
                        <button type="button" class="custom-button" onclick="selectTimeAfternoon(this)">14:30</button>
                      </div>
                      <div class="calendar-info" style="margin-left: 100px; padding: 10px; margin-top: -10px; ">
                        <button type="button" class="custom-button" onclick="selectTimeAfternoon(this)">15:00</button>
                        <button type="button" class="custom-button" onclick="selectTimeAfternoon(this)">15:30</button>
                        <button type="button" class="custom-button" onclick="selectTimeAfternoon(this)">16:00</button>
                        <button type="button" class="custom-button" onclick="selectTimeAfternoon(this)">16:30</button>
                      </div>
                    </div>
                      <div class="selected-time mt-4">
                        
                        </div>
                    </div>
                    <li>Appointment start time</li>
                    
                    <hr>
                    <div id="recommended-time-section">
                        <span style="display: flex;">
                            Recommended time: 
                        </span>
                        <img src="icons8-circle-100.png" alt="" style="margin-bottom: -85px; margin-left: -10px;">

                        <p style="margin-bottom: -20px;">
                            <span id="selected-date" style="margin-left: 100px;">
                            </span>
                        </p>
                        <p>
                            <span id="selected-date"></span>
                        </p>
                        <span style="margin-left: 100px;">
                            <span id="selected-time-display"></span> 
                            <span id="time-range-display" ></span>
                        </span><br>
              

                 
                    <form id="bookingForm" method="post" action="">
                        <input type="hidden" name="selected_date" id="selected-date-input">
                        <input type="hidden" name="selected_time" id="selected-time-input">
                        <br><button type="submit" name="submitBtn" class="btn btn-success"style="margin-left: 100px; height:40px; border: radius 20px; font-family: var(--font-montserrat); font-size: 15px; background-color:#13443e  ">Book this appointment</button>
                        <hr>
                    </form>
                    </div>
   

                </ol>
                    </div>
                    
                </div>
                
            </div>
        </div>



<script>
    const header = document.querySelector(".calendar h3");
    const dates = document.querySelector(".dates");
    const prevButton = document.querySelector("#prev");
    const nextButton = document.querySelector("#next");
    const selectedDateInput = document.querySelector("#selected-date");
    const selectedTimeDisplay = document.querySelector("#selected-time-display");
    const recommendedDateDisplay = document.querySelector("#recommended-date-display");
    const recommendedTimeDisplay = document.querySelector("#recommended-time-display");

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    let date = new Date();
    let month = date.getMonth();
    let year = date.getFullYear();
    let selectedDate = null;
    let selectedTime = "";

    function formatDate(date) {
        return date.toLocaleDateString('en-US', {
            weekday: 'short',
            month: 'short',
            day: '2-digit',
            year: 'numeric'
        });
    }

    function formatTime(start, end) {
        const options = {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true,
            timeZone: 'Asia/Manila',
            timeZoneName: 'short'
        };
        return `${start.toLocaleTimeString('en-US', options)} - ${end.toLocaleTimeString('en-US', options)}`;
    }

    function renderCalendar() {
        const start = new Date(year, month, 1).getDay();
        const endDate = new Date(year, month + 1, 0).getDate();
        const end = new Date(year, month, endDate).getDay();
        const endDatePrev = new Date(year, month, 0).getDate();

        let datesHtml = "";

        for (let i = start; i > 0; i--) {
            datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
        }

        for (let i = 1; i <= endDate; i++) {
            let className = '';
            const currentDate = new Date(year, month, i);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (currentDate < today) {
                className = ' class="disabled"';
            } else if (currentDate.getDay() === 0 || currentDate.getDay() === 6) {
                className = ' class="disabled"';
            } else if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                className = ' class="today"';
            }

            datesHtml += `<li${className}>${i}</li>`;
        }

        for (let i = end; i < 6; i++) {
            datesHtml += `<li class="inactive">${i - end + 1}</li>`;
        }

        dates.innerHTML = datesHtml;
        header.textContent = `${months[month]} ${year}`;

        document.querySelectorAll(".dates li:not(.inactive)").forEach((dateEl) => {
            dateEl.addEventListener("click", (e) => {
                if (e.currentTarget.classList.contains("disabled")) {
                    return; 
                }

                
                document.querySelectorAll('.dates li').forEach(d => d.classList.remove('selected'));

                
                e.currentTarget.classList.add('selected');

                
                selectedDate = new Date(year, month, parseInt(e.target.textContent));
                selectedDateInput.textContent = ` ${formatDate(selectedDate)}`;

            
                recommendedDateDisplay.textContent = `Date: ${formatDate(selectedDate)}`;
                updateRecommendedTimeDisplay();
            });
        });

  
        prevButton.classList.toggle('disabled', month === 0 && year === new Date().getFullYear());
        
        nextButton.classList.toggle('disabled', month === 11 && year === new Date().getFullYear());
    }

    prevButton.addEventListener("click", () => {
        if (prevButton.classList.contains('disabled')) return;

        if (month === 0) {
            year--;
            month = 11;
        } else {
            month--;
        }

        date = new Date(year, month, new Date().getDate());
        renderCalendar();
    });

    nextButton.addEventListener("click", () => {
        if (nextButton.classList.contains('disabled')) return;

        if (month === 11) {
            year++;
            month = 0;
        } else {
            month++;
        }

        date = new Date(year, month, new Date().getDate());
        renderCalendar();
    });

    function updateRecommendedTimeDisplay() {
        if (selectedDate && selectedTime) {
            const startTime = new Date(`${selectedDate.toDateString()} ${selectedTime}`);
            const endTime = new Date(startTime.getTime() + 60 * 60 * 1000); // Assuming a 1-hour appointment

            recommendedTimeDisplay.textContent = `Recommended time: ${formatTime(startTime, endTime)}`;
        }
    }

    function selectTime(button) {
        selectedTime = button.textContent;
        updateRecommendedTimeDisplay();
    }

    document.querySelectorAll('.custom-button').forEach(button => {
        button.addEventListener('click', () => selectTime(button));
    });

    renderCalendar();
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
            function selectTimeMorning(button) {
            selectTime(button, 'AM');
        }

        function selectTimeAfternoon(button) {
            selectTime(button, 'PM');
        }

        function selectTime(button, period) {
            var buttons = document.querySelectorAll('.calendar-info button');
            
            buttons.forEach(function(btn) {
                btn.classList.remove('btn-primary');
                btn.style.backgroundColor = ''; 
            });
            
            button.classList.add('btn-primary');
            button.style.backgroundColor = '#13443E'; 
            
            var selectedTime = button.textContent;
            document.getElementById('selected-time-display').textContent = selectedTime;

            var timeParts = selectedTime.split(':');
            var hours = parseInt(timeParts[0]);
            var minutes = timeParts[1];

            var endTime = hours + 1;
            if (endTime >= 24) {
                endTime = 0; 
            }

            var endTimeFormatted = ('0' + endTime).slice(-2) + ':' + minutes; 

            document.getElementById('time-range-display').textContent = ' - ' + endTimeFormatted + ' Asia/Manila-PST';
            updateHiddenInputs(selectedTime); 
            checkRecommendedTimeSectionVisibility();
        }


        function selectDate(date) {

    var formattedDate = date.split(', ')[1]; 

    document.getElementById('selected-date').textContent = formattedDate;
    updateHiddenInputs();
    checkRecommendedTimeSectionVisibility();
}

function updateHiddenInputs(selectedTime) {
    var selectedDate = document.getElementById('selected-date').textContent;

    document.getElementById('selected-date-input').value = selectedDate;

    if (selectedTime) {
        document.getElementById('selected-time-input').value = selectedTime;
    } else {
        document.getElementById('selected-time-input').value = '';
    }
}

        function checkRecommendedTimeSectionVisibility() {
            var selectedDate = document.getElementById('selected-date').textContent;
            var selectedTime = document.getElementById('selected-time-display').textContent;

            if (selectedDate !== '' && selectedDate !== 'None' && selectedTime !== '') {
                document.getElementById('recommended-time-section').style.display = 'block';
            } else {
                document.getElementById('recommended-time-section').style.display = 'none';
            }
        }

        function onDateSelected(date) {
            selectDate(date);
        }

function onTimeSelected(button) {
    var period = button.parentNode.querySelector('p').textContent; 
    selectTime(button, period);
}



document.getElementById('submitBtn').addEventListener('click', function() {

    var selectedDate = document.getElementById('selected-date-input').value;
    var selectedTime = document.getElementById('selected-time-input').value;

    if (selectedDate && selectedTime) {
        document.getElementById('bookingForm').submit();
    } else {
        alert('Please select both date and time.');
    }
});


            
        </script>
    </body>
    </html>