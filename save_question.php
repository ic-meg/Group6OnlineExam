<?php

include "dbcon.php";

$data = json_decode(file_get_contents("php://input"), true);

$category = $data['category'];
$questionText = $data['questionText'];
$choices = $data['choices'];
$correctChoiceText = $data['correctChoiceText'];


$table = '';
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
        echo json_encode(['success' => false, 'message' => 'Invalid category']);
        exit;
}


$stmt = $conn->prepare("INSERT INTO $table (questionText, ChoiceA, ChoiceB, ChoiceC, ChoiceD, AnswerKey) VALUES (?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die(json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]));
}


$stmt->bind_param("ssssss", $questionText, $choices[0], $choices[1], $choices[2], $choices[3], $correctChoiceText);


if ($stmt->execute()) {
    $questionId = $conn->insert_id; // Get the auto-generated questionId
    echo json_encode(['success' => true, 'questionId' => $questionId]);
} else {
    echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
}


$stmt->close();
$conn->close();

?>
