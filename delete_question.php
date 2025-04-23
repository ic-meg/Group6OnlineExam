<?php
include "dbcon.php"; 

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST['question_id']) || !isset($_POST['category'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

$questionId = $_POST['question_id'];
$category = $_POST['category'];


$allowedCategories = ['Math', 'Logic', 'Science', 'ReadingComprehension'];
if (!in_array($category, $allowedCategories)) {
    http_response_code(400); 
    echo json_encode(['success' => false, 'message' => 'Invalid category']);
    exit;
}


$tableMap = [
    'Math' => 'admin_math',
    'Logic' => 'admin_logic',
    'Science' => 'admin_science',
    'ReadingComprehension' => 'admin_reading_comprehension',
];


if (!array_key_exists($category, $tableMap)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Category not found']);
    exit;
}

$table = $tableMap[$category];


$stmt = $conn->prepare("DELETE FROM $table WHERE questionID = ?");
$stmt->bind_param('i', $questionId); 


if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Question deleted successfully']);
} else {
    http_response_code(500); 
    echo json_encode(['success' => false, 'message' => 'Failed to delete question']);
    error_log("Error deleting question: ". $stmt->error); 
}

$stmt->close();
$conn->close();
?>
