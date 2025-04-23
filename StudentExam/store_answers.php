<?php
session_start();
include "dbcon.php";


if (!isset($_SESSION['user_id'])) {
    die(json_encode(['success' => false, 'message' => 'User session not set.']));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    echo json_encode($_POST);
    exit;

 
    if (isset($_POST['category']) && isset($_POST['answers'])) {
        $examinee_id = $_SESSION['user_id'];
        $category = $_POST['category']; 
        $answers = $_POST['answers'];  

        $query_student_id = "SELECT Student_ID FROM student WHERE examinee_id = ?";
        $stmt_student_id = $conn->prepare($query_student_id);

        if ($stmt_student_id === false) {
            die(json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]));
        }

        $stmt_student_id->bind_param("i", $examinee_id);
        $stmt_student_id->execute();
        $stmt_student_id->bind_result($student_id);
        $stmt_student_id->fetch();
        $stmt_student_id->close();

        if (empty($student_id)) {
            die(json_encode(['success' => false, 'message' => 'Student ID not found for examinee ID.']));
        }

        switch ($category) {
            case 'reading':
                $table_name = 'student_answer_reading_comprehension';
                break;
            case 'logic':
                $table_name = 'student_answer_logic';
                break;
            case 'math':
                $table_name = 'student_answer_math';
                break;
            case 'science':
                $table_name = 'student_answer_science';
                break;
            default:
                die(json_encode(['success' => false, 'message' => 'Invalid category']));
        }

        foreach ($answers as $questionID => $selectedAnswer) {
  
            $sql_insert = "INSERT INTO $table_name (student_id, questionID, Answer)
                           VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);

            if ($stmt_insert === false) {
                die(json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]));
            }

            $stmt_insert->bind_param("iis", $student_id, $questionID, $selectedAnswer);
            if ($stmt_insert->execute()) {
               
            } else {
                die(json_encode(['success' => false, 'message' => 'Error inserting answers: ' . $conn->error]));
            }

            $stmt_insert->close();
        }

        echo json_encode(['success' => true, 'message' => 'Answers inserted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Category or answers not set.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
