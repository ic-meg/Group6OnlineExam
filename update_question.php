<?php
include "dbcon.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    error_log("Raw POST data: " . $rawData);
    error_log("Parsed POST data: " . print_r($data, true));

    if (!isset($data['category'], $data['questionId'], $data['questionText'], $data['choices'], $data['correctChoiceIndex'])) {
        http_response_code(400); 
        echo json_encode(['success' => false, 'message' => 'Missing or invalid parameters']);
        exit;
    }

    $category = $data['category'];
    $questionId = $data['questionId'];
    $questionText = $data['questionText'];
    $choices = $data['choices'];
    $correctChoiceIndex = $data['correctChoiceIndex'];

   
    switch ($category) {
        case 'Math':
            $table = 'admin_math';
            break;
        case 'Logic':
            $table = 'admin_logic';
            break;
        case 'Science':
            $table = 'admin_science';
            break;
        case 'ReadingComprehension':
            $table = 'admin_reading_comprehension';
            break;
        default:
            http_response_code(400); // Bad request
            echo json_encode(['success' => false, 'message' => 'Invalid category']);
            exit;
    }

   
    $stmt = $conn->prepare("UPDATE $table SET questionText = ?, ChoiceA = ?, ChoiceB = ?, ChoiceC = ?, ChoiceD = ?, AnswerKey = ? WHERE questionId = ?");
    if (!$stmt) {
        http_response_code(500); 
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
        exit;
    }

    $stmt->bind_param("ssssssi", $questionText, $choices[0], $choices[1], $choices[2], $choices[3], $choices[$correctChoiceIndex], $questionId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Question updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update question']);
    }

    $stmt->close();
    exit;
}

?>
