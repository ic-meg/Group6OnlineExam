<?php

include "dbcon.php";


if (!isset($_GET['category'])) {
    echo json_encode(['success' => false, 'message' => 'Category parameter is missing']);
    exit;
}

$category = $_GET['category'];


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


$stmt = $conn->prepare("SELECT questionID, questionText, ChoiceA, ChoiceB, ChoiceC, ChoiceD, AnswerKey FROM $table");
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    $question = [
        'questionID' => $row['questionID'],
        'category' => $category,
        'questionText' => $row['questionText'],
        'choices' => [$row['ChoiceA'], $row['ChoiceB'], $row['ChoiceC'], $row['ChoiceD']],
        'correctChoiceText' => $row['AnswerKey']
    ];
    $questions[] = $question;
}

$stmt->close();

echo json_encode($questions);

?>
