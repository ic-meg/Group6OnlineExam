

<?php
session_start();
include "dbcon.php";

if (!isset($_SESSION['control_number'])) {
    die("User session not set.");
}

$control_number = $_SESSION['control_number'];

// echo $control_number;


if (!isset($_SESSION['exam_start_time'])) {
    $_SESSION['exam_start_time'] = time(); 
}


if (!isset($_SESSION['remaining_time'])) {
    $_SESSION['remaining_time'] = 3600; 
}


$page_size = 17; 
$page_number = isset($_GET['page']) ? $_GET['page'] : 1; 


$offset = ($page_number - 1) * $page_size;

// $sql_logic = "SELECT questionID, questionText, ChoiceA, ChoiceB, ChoiceC, ChoiceD 
//              FROM admin_logic LIMIT $offset, $page_size";
// $result_logic = $conn->query($sql_logic);

    if (!isset($_SESSION['randomized_questions'])) {
    
        $sql_logic = "SELECT questionID, questionText, ChoiceA, ChoiceB, ChoiceC, ChoiceD FROM admin_logic";
        $result_logic = $conn->query($sql_logic);

        $questions = [];
        while ($row = $result_logic->fetch_assoc()) {
            $questions[] = $row;
        } 
        shuffle($questions);

        $_SESSION['randomized_questions'] = $questions;
    } else {
        $questions = $_SESSION['randomized_questions'];
    }

// if (!$result_logic) {
//     die("Query failed (Logic): " . $conn->error);
// }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Exam</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <!-- Link to a CSS file here that contains the same code as on the CSS tab above -->    
    <script src="https://cdn.autoproctor.co/ap-entry.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">
    <link rel="stylesheet" href="SPEL.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <!-- Link to a CSS file here that contains the same code as on the CSS tab above -->    
    <script src="https://cdn.autoproctor.co/ap-entry.js"></script>
</head>
<style>
     
    /* Styling for .container class */
    .container {
         margin: 0 auto;
         max-width: 1200px;
         padding: 20px;
    }
    
    /* Styling for .grid class */
     .ctas {
         display: grid;
         grid-template-columns: repeat(3, 1fr);
         gap: 10px;
    }
    
    /* Styling for button elements inside .grid */
     .ctas button {
         padding: 10px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
    }
    
    /* Styling for # start button */
     #btn-start {
         background-color: green;
         color: white;
    }
    
    /* Styling for #testEnd button */
     #btn-stop {
         background-color: red;
         color: white;
    }
    
    /* Styling for .flex class */
     .flex {
         display: flex;
         align-items: center;
    }
    
    /* Styling for #ap-test-proctoring-status element */
     #ap-test-proctoring-status {
         margin-bottom: 2px;
         font-size: 3rem;
         font-weight: bold;
         margin-left: 14px;
         animation: pulse 2s infinite;
    }
     @keyframes pulse {
         0% {
             opacity: 1;
        }
         50% {
             opacity: 0.5;
        }
         100% {
             opacity: 1;
        }
    }
    
    /* Styling for #proctor-feedback element */
     #proctor-feedback {
         margin-bottom: 2px;
         background: none;
         border-radius: 9999px;
         transition: all 0.3s;
         color: #ff9800;
         font-weight: bolder;
         font-size: 0.75rem;
         padding: 8px 16px;
         text-transform: uppercase;
         letter-spacing: 0.1em;
    }
    
    /* Styling for #test-attempt-report container */
     #test-attempt-report {
         display: none;
    }
    
    /* Styling for #ap-test-report-overview element */
     #ap-test-report-overview {
         max-width: 72rem;
         margin: 0 auto;
         background-image: linear-gradient( to right, var(--gradient-from), var(--gradient-to) );
         padding: 10px;
         border-radius: 1rem;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    
    /* Styling for .flex element inside #test-attempt-report container */
     #test-attempt-report .flex {
         margin-top: 1rem;
    }
    
    /* Styling for .tab-button class */
     .tab-button {
         padding: 0.5rem 1rem;
         border: none;
         border-radius: 0.25rem;
         cursor: pointer;
         text-transform: uppercase;
         letter-spacing: 0.1em;
    }
    
    /* Styling for #tab-1 button */
    
    /* Styling for #tab-1-content and #tab-2-content elements */
     #tab-1-content, #tab-2-content {
         max-width: 72rem;
         margin: 0 auto;
         background-image: linear-gradient( to left, var(--gradient-from), var(--gradient-to) );
         padding: 10px;
         border-radius: 1rem;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    
    /* Styling for .max-w-5xl class */
     .max-w-5xl {
         max-width: 72rem;
    }
    
    /* Styling for h1 tag */
     .container h1 {
         font-size: 1.5rem;
         margin: 1rem 0;
    }
    
    /* Styling for .text-2xl class */
     .text-2xl {
         font-size: 1.25rem;
    }
    
    /* Styling for .text-3xl class */
     .text-3xl {
         font-size: 1.875rem;
    }
    
    /* Styling for .text-center class */
     .text-center {
         text-align: center;
    }
    
    /* Styling for .my-4 class */
     .my-4 {
         margin: 1rem 0;
    }
    
    /* Styling for .bg-gradient-to-l class */
     .bg-gradient-to-l {
         background-image: linear-gradient( to left, var(--gradient-from), var(--gradient-to) );
    }
    
    /* Styling for .p-10 class */
     .p-10 {
         padding: 2.5rem;
    }
    
    /* Styling for .rounded-2xl class */
     .rounded-2xl {
         border-radius: 2rem;
    }
    
    /* Styling for .shadow-2xl class */
     .shadow-2xl {
         box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
     .my-10 {
         margin-top: 2.5rem;
         margin-bottom: 2.5rem;
    }
    
    /* Styling for .bg-blue-300 class */
     .bg-blue-300 {
         background-color: #2196f3;
    }
    
    /* Styling for .bg-gray-500 class */
     .bg-gray-500 {
         background-color: #6b7280;
    }
    
    /* Styling for .text-gray-700 class */
     .text-gray-700 {
         color: #4b5563;
    }
    
    /* Styling for .text-white class */
     .text-white {
         color: #ffffff;
    }
     
</style>
<body>
    
    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="public/CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none;">CvSU - Imus Campus</h4>
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
                <a href="#" style="border-right: 5px solid white;">
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
                <h4>Exam</h4>
                <div class="header-icons">
                    <img src="public/icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
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
                
                <div class="d-flex align-items-center">
                    <div class="vertical-line"></div>
                    <div class="header-title">
                        <h1>Cavite State University Imus Campus</h1>
                        <p>Online Entrance Exam</p>
                    </div>
                </div>
                <div class="exam-category d-flex justify-content-between align-items-center">
                    <div class="exam-header">
                        <p>Test I. Logic</p>
                    </div>
                    <span id="timer" class="timer">01:00:00</span>
                </div>

                <div class="main-exam-container">
              
                <div id="ap-proctoring-container">
                        <div class="ctas">
                            <button id="btn-start">Start</button>
                            <button id="btn-stop">Stop</button>
                        </div>
                        <div class="note" style="margin-top: 20px; padding: 10px; background-color: #f9f9f9; border-left: 5px solid #007bff; text-align: left; margin-left: -10px;">
                            <p style="margin: 0; font-size: 1rem; color: #333;"><strong>Note:</strong> You must click the "Start" button to begin proctoring. Ensure you start the proctoring process before proceeding with the exam.</p>
                        </div>
                        <div class="flex flex-row">
                            <div id="ap-test-proctoring-status"></div>
                            <div id="proctor-feedback"></div>
                        </div>
                    </div>
                    <div class="container mx-auto mt-8 max-w-5xl" id="ap-report__overview"></div>
                    <div class="container mx-auto mt-8 max-w-5xl" id="ap-report-tab-container"></div> 
                    <div class="exam-instructions">
                        <p>For the question below, please choose the best answer for the given question.</p>
                    </div>
                    <div class="exam-container">
                    

    <form method="post" action="StudentExamLogic.php">

        <input type="hidden" name="category" value="<?php echo htmlspecialchars($current_category); ?>">
        
            <?php

$offset = ($page_number - 1) * $page_size;


$paginated_questions = array_slice($questions, $offset, $page_size);


foreach ($paginated_questions as $index => $row) {
    $question_number = $offset + $index + 1;
    echo '<div class="question-box">
            <div class="question-header">
                <span class="question-number">' . $question_number . '/17</span>
            </div>
            <hr>
            <p class="question-text">' . htmlspecialchars($row['questionText']) . '</p>
            <div class="radio-button">
                <ul class="choices">
                    <li>
                        <input type="radio" required class="radio-button__input" id="radio1-q' . $question_number . '" name="answers[' . $row['questionID'] . ']" value="' . htmlspecialchars($row['ChoiceA']) . '">
                        <label class="radio-button__label" for="radio1-q' . $question_number . '">
                            <span class="radio-button__custom"></span>
                            ' . htmlspecialchars($row['ChoiceA']) . '
                        </label>
                    </li>
                    <li>
                        <input type="radio" required class="radio-button__input" id="radio2-q' . $question_number . '" name="answers[' . $row['questionID'] . ']" value="' . htmlspecialchars($row['ChoiceB']) . '">
                        <label class="radio-button__label" for="radio2-q' . $question_number . '">
                            <span class="radio-button__custom"></span>
                            ' . htmlspecialchars($row['ChoiceB']) . '
                        </label>
                    </li>
                    <li>
                        <input type="radio" required class="radio-button__input" id="radio3-q' . $question_number . '" name="answers[' . $row['questionID'] . ']" value="' . htmlspecialchars($row['ChoiceC']) . '">
                        <label class="radio-button__label" for="radio3-q' . $question_number . '">
                            <span class="radio-button__custom"></span>
                            ' . htmlspecialchars($row['ChoiceC']) . '
                        </label>
                    </li>
                    <li>
                        <input type="radio" required class="radio-button__input" id="radio4-q' . $question_number . '" name="answers[' . $row['questionID'] . ']" value="' . htmlspecialchars($row['ChoiceD']) . '">
                        <label class="radio-button__label" for="radio4-q' . $question_number . '">
                            <span class="radio-button__custom"></span>
                            ' . htmlspecialchars($row['ChoiceD']) . '
                        </label>
                    </li>
                </ul>
            </div>
        </div>';
}

        ?>
        
        <div class="navigation-buttons">
            <?php

            $categories = ['logic', 'math', 'science', 'reading'];
            

            $current_category = isset($_GET['category']) ? $_GET['category'] : $categories[0];
            
          
            $current_category_index = array_search($current_category, $categories);
            
            
            $sql_count = "SELECT COUNT(*) AS total FROM admin_{$current_category}";
            $result_count = $conn->query($sql_count);

            $row_count = $result_count->fetch_assoc();
            $total_questions = $row_count['total'];

            $total_pages = ceil($total_questions / $page_size);
            
            
            if ($current_category_index > 0) {
                $prev_category = $categories[$current_category_index - 1];
           
                $sql_prev_count = "SELECT COUNT(*) AS total FROM admin_{$prev_category}";
                $result_prev_count = $conn->query($sql_prev_count);
                $row_prev_count = $result_prev_count->fetch_assoc();
                $prev_total_questions = $row_prev_count['total'];
                $prev_total_pages = ceil($prev_total_questions / $page_size);
            } else {
                $prev_category = null;
                $prev_total_pages = 1;
            }
            

            if ($page_number < $total_pages) {
                $next_page = $page_number + 1;
                $next_category = $current_category;
            } else {
                $next_page = 1;
                $next_category = isset($categories[$current_category_index + 1]) ? $categories[$current_category_index + 1] : null;
            }
            
          
            if ($page_number > 1) {
                $prev_page = $page_number - 1;
                echo '<button class="back-button" onclick="location.href=\'?category=' . $current_category . '&page=' . $prev_page . '\'" >Back</button>';
            } else if ($prev_category !== null) {
                echo '<button class="back-button" onclick="location.href=\'StudentExam' . ucfirst($prev_category) . '.php?category=' . $prev_category . '&page=' . $prev_total_pages . '\'">Back</button>';
            } else {
                echo '<button class="back-button" onclick="description()" >Back</button>';
            }
            
   
            if ($page_number == 1) {
                echo '<button type="submit" class="next-button" name="submitAnswers">Submit Answers</button>';
                
            } else if ($next_category !== null) {
                $next_page_url = $next_category === $current_category ? '?category=' . $current_category . '&page=' . $next_page : 'StudentExam' . ucfirst($next_category) . '.php?category=' . $next_category . '&page=' . $next_page;
                echo '<button class="next-button" onclick="window.location.href=\'' . $next_page_url . '\'">Next</button>';
            } else {
                echo '<button class="next-button" disabled>Next</button>';
            }
            
            ?>
        </div>
    </form>
</div>


<?php


if (isset($_SESSION['control_number'])) {

    $control_number = $_SESSION['control_number'];

    $stmt = $conn->prepare("SELECT control_number FROM useraccount WHERE control_number = ?");
    $stmt->bind_param("i", $control_number);
    $stmt->execute();
    $result = $stmt->get_result();

 

    if ($result->num_rows > 0) {
 
        $row = $result->fetch_assoc();
        $student_id = $row['control_number'];
        
    
        if (isset($_POST['submitAnswers'])) {
            $answers = isset($_POST['answers']) ? $_POST['answers'] : [];
            $category = isset($_POST['category']) ? $_POST['category'] : '';


            $answers_valid = true;
            foreach ($answers as $questionID => $answer) {
            
                $answer = trim($answer);

                if (empty($answer)) {
                    $answers_valid = false;
                    break;
                }
            }

            // If answers are valid, proceed with insertion
            if ($answers_valid && !empty($answers)) {
                // Prepare SQL statement for insertion
                $stmt_insert = $conn->prepare("INSERT INTO student_answer_logic (control_number, Answer, questionID) VALUES (?, ?, ?)");

                foreach ($answers as $questionID => $answer) {
               
                    $stmt_insert->bind_param("iss", $student_id, $answer, $questionID);
                    unset($_SESSION['randomized_questions']);
                    if (!$stmt_insert->execute()) {
                        die("Insertion failed: " . $stmt_insert->error);
                    }
                }
                
            
      
           
                $stmt_booking = $conn->prepare("SELECT date, time FROM admin_booking WHERE control_number = ?");
                $stmt_booking->bind_param("i", $control_number);
                $stmt_booking->execute();
                $stmt_booking->bind_result($date, $time);
                $stmt_booking->fetch();
                $stmt_booking->close();

      
                $sql_answer_key = "SELECT questionID, AnswerKey FROM admin_logic";
                $result_answer_key = $conn->query($sql_answer_key);

                
                $answer_key = [];
                while ($row_key = $result_answer_key->fetch_assoc()) {
                    $answer_key[$row_key['questionID']] = $row_key['AnswerKey'];
                }

            
                $correct_answers = 0;

                foreach ($answers as $questionID => $student_answer) {
                    if (isset($answer_key[$questionID])) {
                        $correct_answer = $answer_key[$questionID];

                  
                        if ($student_answer === $correct_answer) {
                            $correct_answers++;
                        }
                    }
                }

                
                $total_questions = mysqli_num_rows($result_answer_key);
                $total_score = $correct_answers . '/' . $total_questions;

              
                $logic_id = $total_score; 
                $stmt_score = $conn->prepare("INSERT INTO student_examination_score (control_number, logic_id, date, timeStarted) VALUES (?, ?, ?, ?) ");
                $stmt_score->bind_param("iiss", $student_id, $logic_id, $date, $time );


          
                if (!$stmt_score->execute()) {
                    die("Insertion failed: " . $stmt_score->error);
                }

             
                echo "<script>
                    Swal.fire({
                        title: 'First Category Completed!',
                        text: 'Answers submitted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'StudentExamMath.php';
                    });
                </script>";
            } else {
                
                echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please answer all questions before submitting.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
        }
    } else {
        echo "No student found for examinee_id: $examinee_id";
    }

    
    $stmt->close();
    $conn->close();
} else {
    echo "Session user_id not set.";
}
?>




                    </div>
                    
                                   
            </div>
        </div>
    </div>
    <script>  function description(){
       window.location.href = '../StudentExamDescription.php';
    }
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            var schoolName = document.querySelector('.SchoolName');

            sidebar.classList.toggle('show');
            content.classList.toggle('sidebar-show');

            if (sidebar.classList.contains('show')) {
                schoolName.style.display = 'block';
            } else {
                schoolName.style.display = 'none';
            }
        }

        function startTimer(duration, display) {
            let timer = duration, hours, minutes, seconds;
            setInterval(function () {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ":" + minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                }
            }, 1000);
        }

        function startTimer(duration, display) {
            let timer = duration;
            let hours, minutes, seconds;

            // Update remaining time in session storage
            sessionStorage.setItem('remainingTime', timer);

            let intervalId = setInterval(function () {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ":" + minutes + ":" + seconds;

            
                sessionStorage.setItem('remainingTime', timer);

                if (--timer < 0) {
                    clearInterval(intervalId);
                    timer = 0;
                  
                    alert("Time's up! Automatically submitting your exam.");
                }
            }, 1000);
        }

function getRemainingTime() {
  
    let remainingTime = sessionStorage.getItem('remainingTime');
  
    return remainingTime ? parseInt(remainingTime, 10) : 3600;
}

function updateRemainingTime(remainingTime) {

    sessionStorage.setItem('remainingTime', remainingTime);

 
  
    // updateRemainingTimeOnServer(remainingTime);
}

// Example usage on page load
window.onload = function () {
    let remainingTime = getRemainingTime();
    let display = document.querySelector('#timer');
    startTimer(remainingTime, display);

    // Follow scroll behavior for timer only
    window.addEventListener('scroll', function () {
        var timerContainer = document.querySelector('.exam-category');
        var timerRect = timerContainer.getBoundingClientRect();
        var contentRect = document.getElementById('content').getBoundingClientRect();

        if (contentRect.top <= 0) {
            display.classList.add('fixed-timer');
        } else {
            display.classList.remove('fixed-timer');
        }
    });
};
document.addEventListener("DOMContentLoaded", function() {

    if (typeof(Storage) === "undefined") {
        console.error("sessionStorage is not supported by this browser.");
        return;
    }

    
    var radioButtons = document.querySelectorAll('.radio-button__input');

   
    var examinee_id = <?php echo json_encode($_SESSION['user_id']); ?>;
    var current_category = <?php echo json_encode($current_category); ?>;

   
    radioButtons.forEach(function(button) {
        
        button.addEventListener('change', function() {
            if (button.checked) {
             
                sessionStorage.setItem(button.name, button.id);

                
                var label = document.querySelector('label[for="' + button.id + '"]');
                var labelText = label ? label.textContent.trim() : button.value;

               
                var questionBox = button.closest('.question-box');
                var questionText = questionBox ? questionBox.querySelector('.question-text').textContent.trim() : 'Question';

                
                var questionIDMatch = button.name.match(/\d+/);
                var questionID = questionIDMatch ? questionIDMatch[0] : null;

                if (!questionID) {
                    console.error('Invalid questionID extracted');
                    return;
                }

     
                fetch('store_answers.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        examinee_id: examinee_id,
                        category: current_category,
                        questionID: questionID,
                        answer: button.value
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response from server:', data);
                   
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    
                });
            }
        });

    
        var savedId = sessionStorage.getItem(button.name);
        if (savedId === button.id) {
            
            button.checked = true;
        }
    });
});



</script>
<script>
    // Proctoring options configuration
    const proctoringOptions = {
        trackingOptions: { 
            audio: false,
            numHumans: false,
            tabSwitch: true,
            photosAtRandom: false,
            detectMultipleScreens: false,
            forceFullScreen: false,
            auxiliaryDevice: false,
            recordSession: false
        },
        showHowToVideo: false
    };

    const CLIENT_ID = 'OHuIPLGD'; 
    const CLIENT_SECRET = 'Qlb80sl0WQNE0ha'; 

    // Generate a random test attempt ID
    function getTestAttemptId() {
        return Math.random().toString(36).slice(2, 7);
    }

    function getHashTestAttemptId(testAttemptId) {
        if (!CLIENT_SECRET) return null;
        const secretWordArray = CryptoJS.enc.Utf8.parse(CLIENT_SECRET);
        const messageWordArray = CryptoJS.enc.Utf8.parse(testAttemptId);
        const hash = CryptoJS.HmacSHA256(messageWordArray, secretWordArray);
        return CryptoJS.enc.Base64.stringify(hash);
    }    


    function getCredentials() {
        const testAttemptId = getTestAttemptId();
        const hashedTestAttemptId = getHashTestAttemptId(testAttemptId);
        return {
            clientId: CLIENT_ID,
            testAttemptId: testAttemptId,
            hashedTestAttemptId: hashedTestAttemptId
        };
    }

    // Function to get report options
    const getReportOptions = () => ({
        groupReportsIntoTabs: true,
        userDetails: {
            name: "First Last",
            email: "megangeline08@gmail.com"
        }
    });

 
    async function init() {
        const credentials = getCredentials();
        const apInstance = new AutoProctor(credentials);
        await apInstance.setup(proctoringOptions);

     
        document.getElementById("btn-start").addEventListener("click", () => apInstance.start());

        window.addEventListener("apMonitoringStarted", () => {
            document.getElementById("btn-start").disabled = true;
            document.getElementById("btn-stop").disabled = false;
            document.getElementById("ap-test-proctoring-status").innerHTML = "Proctoring...";
        });

 
        document.getElementById("btn-stop").addEventListener("click", () => apInstance.stop());

        window.addEventListener("apMonitoringStopped", async () => {
            const reportOptions = getReportOptions();
            apInstance.showReport(reportOptions);

            document.getElementById("ap-proctoring-container").style.visibility = "hidden";
            document.getElementById("ap-test-proctoring-status").innerHTML = "Proctoring stopped";
        });

       
        document.getElementById("submit-button").addEventListener("click", (e) => {
            e.preventDefault(); 

            const reportData = {
                name: "First Last",
                email: "user@gmail.com",
                proctoringStatus: "Completed",
                testAttemptId: credentials.testAttemptId,
                timestamp: new Date().toLocaleString()
            };

      
            fetch('server.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(reportData)
            })
            .then(response => response.json())
            .then(data => {
                console.log("Data sent to the server:", data);
                
                document.getElementById("submitAnswers").submit();
            })
            .catch(error => {
                console.error("Error sending data to the server:", error);
            });
        });
    }

  
    window.addEventListener("load", init);
</script>

</body>
</html>
