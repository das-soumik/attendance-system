<?php
require "../config.php";
if (!isset($_SESSION['admin_id'])) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start'];
    $end = $_POST['end'];

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="attendance.csv"');

    $output = fopen("php://output", "w");
    fputcsv($output, ["Student Name", "Enrollment No", "Session", "Faculty", "Timestamp"]);

    $stmt = $pdo->prepare("
        SELECT s.name, s.enrollment_no, se.session_name, f.name AS faculty, a.timestamp
        FROM attendance a
        JOIN students s ON a.student_id = s.student_id
        JOIN sessions se ON a.session_id = se.session_id
        JOIN faculty f ON a.faculty_id = f.faculty_id
        WHERE a.timestamp BETWEEN ? AND ?
    ");
    $stmt->execute([$start." 00:00:00", $end." 23:59:59"]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Export Attendance</title></head>
<body>
<h2>Export Attendance</h2>
<form method="post">
    Start Date: <input type="date" name="start"><br>
    End Date: <input type="date" name="end"><br>
    <input type="submit" value="Export CSV">
</form>
</body>
</html>
