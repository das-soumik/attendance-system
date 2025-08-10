<?php
header("Content-Type: application/json");
require "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM faculty WHERE username = ?");
$stmt->execute([$username]);
$faculty = $stmt->fetch(PDO::FETCH_ASSOC);

if ($faculty && hash('sha256', $password) === $faculty['password_hash']) {
    echo json_encode(["status" => "success", "faculty_id" => $faculty['faculty_id'], "name" => $faculty['name']]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid login"]);
}
?>
