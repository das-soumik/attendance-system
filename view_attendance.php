<?php
header("Content-Type: application/json");
require "config.php";

$faculty_id = $_GET['faculty_id'] ?? '';
$session_id = $_GET['session_id'] ?? '';

$stmt = $pdo->prepare("
    SELECT s.name AS student_name, s.enrollment_no, a.timestamp
    FROM attendance a
    JOIN students s ON a.student_id = s.student_id
    WHERE a.faculty_id = ? AND a.session_id = ?
");
$stmt->execute([$faculty_id, $session_id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["status" => "success", "data" => $rows]);
?>
