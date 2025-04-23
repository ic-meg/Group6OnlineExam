<?php 
session_start();
include "dbcon.php";


$sql_useremail = "SELECT email FROM imported_control_numbers WHERE control_number = ?";
$stmt_useremail = $conn->prepare($sql_useremail);

if ($stmt_useremail === false) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}
$control_number = $_SESSION['control_number'];
if (!isset($_SESSION['control_number'])) {
    die("User session not set.");
}

$stmt_useremail->bind_param('s', $control_number);
$stmt_useremail->execute();
$result_useremail = $stmt_useremail->get_result();

if ($result_useremail === false) {
    echo "Error executing query: " . $stmt_useremail->error;
    exit;
}

if ($row = $result_useremail->fetch_assoc()) {
    $_SESSION['user_email'] = $row['email'];
} else {
    echo 'No email found for the given control number.';
}

if (!isset($_SESSION['user_email'])) {
    echo '';
}


// echo $control_number;



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_useraccount = "SELECT * FROM useraccount WHERE control_number = ?";
$stmt_useraccount = $conn->prepare($sql_useraccount);

if (!$stmt_useraccount) {
    die("Prepare failed (useraccount query): (" . $conn->errno . ") " . $conn->error);
}

$stmt_useraccount->bind_param("s", $control_number);
$stmt_useraccount->execute();
$result_useraccount = $stmt_useraccount->get_result();

if (!$result_useraccount) {
    die("Execute failed (useraccount query): (" . $stmt_useraccount->errno . ") " . $stmt_useraccount->error);
}


$schedule_status = '';
$schedule_date = '';
$schedule_time = '';
$formatted_time = '';

$row_useraccount = $result_useraccount->fetch_assoc();


if($result_useraccount->num_rows > 0) {
    $control_number = $row_useraccount['control_number']; 

    
    $sql_schedule = "SELECT Schedule, date, time FROM admin_booking WHERE control_number = ?";
    $stmt_schedule = $conn->prepare($sql_schedule);

    if (!$stmt_schedule) {
        die("Prepare failed (schedule query): (" . $conn->errno . ") " . $conn->error);
    }

    $stmt_schedule->bind_param("s", $control_number);
    $stmt_schedule->execute();
    $result_schedule = $stmt_schedule->get_result();

    if (!$result_schedule) {
        die("Execute failed (schedule query): (" . $stmt_schedule->errno . ") " . $stmt_schedule->error);
    }

    
    if ($result_schedule->num_rows > 0) {
        $row_schedule = $result_schedule->fetch_assoc();
        $schedule_status = $row_schedule['Schedule'];
        $schedule_date = $row_schedule['date'];
        $schedule_time = $row_schedule['time'];

        date_default_timezone_set('Asia/Manila');

        $formatted_time = date('g:i A', strtotime($schedule_time));
        
   
        $current_datetime = new DateTime(); 
        $scheduled_datetime = new DateTime($schedule_date . ' ' . $schedule_time); 

        

        if ($current_datetime > $scheduled_datetime) {
            
            $missed_message = "Sorry, you missed your scheduled exam on " . date('F j, Y', strtotime($schedule_date)) . ' at ' . htmlspecialchars($formatted_time) . '. Please contact the administration for further instructions.';
        } else {
            $missed_message = ""; 
        }
     
     
        $stmt_schedule->close();
        $result_schedule->close();
    } else {
        
    }
 
    $stmt_useraccount->close();
    $result_useraccount->close();
} else {
    // Handle no user found
    $stmt_useraccount->close();
}



$sql2 = "SELECT * FROM student_examination_score WHERE control_number = ?";
$stmt2 = $conn->prepare($sql2);
if (!$stmt2) {
    die("Prepare failed: " . $conn->error);
}
$stmt2->bind_param("s", $control_number);
$stmt2->execute();
$result2 = $stmt2->get_result();
if (!$result2) {
    die("Execute failed: " . $stmt2->error);
}

$row2 = $result2->fetch_assoc();
$status = isset($row2['status']) ? $row2['status'] : 'No data available';

$stmt2->close();



$sql_count_passed = "SELECT COUNT(*) as tbl_count FROM student_examination_score where status = 'PASSED'";
                    
$c_p_result = $conn->query($sql_count_passed);

$c_p_row = $c_p_result->fetch_assoc();



$sql_count_failed = "SELECT COUNT(*) as tbl_count FROM student_examination_score where status = 'FAILED'";
                    
$c_f_result = $conn->query($sql_count_failed);

$c_f_row = $c_f_result->fetch_assoc();


    // Retrieve examination score status
    $sql_exam_status = "SELECT status FROM student_examination_score WHERE control_number = ?";
    $stmt_exam_status = $conn->prepare($sql_exam_status);
    if (!$stmt_exam_status) {
        die("Prepare failed (exam status query): (" . $conn->errno . ") " . $conn->error);
    }
    $stmt_exam_status->bind_param("s", $control_number);
    $stmt_exam_status->execute();
    $result_exam_status = $stmt_exam_status->get_result();
    if (!$result_exam_status) {
        die("Execute failed (exam status query): (" . $stmt_exam_status->errno . ") " . $stmt_exam_status->error);
    }

    if ($result_exam_status->num_rows > 0) {
        $row_exam_status = $result_exam_status->fetch_assoc();
        $exam_status = $row_exam_status['status'];

        if ($exam_status == 'PASSED' || $exam_status == 'FAILED') {
            $sql_update_schedule_done = "UPDATE admin_booking SET Schedule = 'Completed' WHERE control_number = ?";
            $stmt_update_schedule_done = $conn->prepare($sql_update_schedule_done);
            if (!$stmt_update_schedule_done) {
                die("Prepare failed (update schedule to done query): (" . $conn->errno . ") " . $conn->error);
            }
            $stmt_update_schedule_done->bind_param("i",$control_number);
            $stmt_update_schedule_done->execute();
        }
    }

    $stmt_exam_status->close();
                
?>
