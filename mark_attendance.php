<?php
header("Content-Type: application/json");
require "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$enrollment_no = $data['enrollment_no'] ?? '';
$session_id = $data['session_id'] ?? '';
$faculty_id = $data['faculty_id'] ?? '';

if (!$enrollment_no || !$session_id || !$faculty_id) {
    echo json_encode(["status" => "error", "message" => "Missing parameters"]);
    exit;
}

$stmt = $pdo->prepare("SELECT student_id FROM students WHERE enrollment_no = ?");
$stmt->execute([$enrollment_no]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    echo json_encode(["status" => "error", "message" => "No student found"]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO attendance (student_id, session_id, faculty_id) VALUES (?, ?, ?)");
    $stmt->execute([$student['student_id'], $session_id, $faculty_id]);
    echo json_encode(["status" => "success", "message" => "Attendance marked"]);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Duplicate entry
        echo json_encode(["status" => "error", "message" => "Attendance already recorded"]);
    } else {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>
