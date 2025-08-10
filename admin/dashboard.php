<?php
require "../config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h2>Welcome, <?php echo $_SESSION['admin_name']; ?></h2>
<ul>
    <li><a href="add_faculty.php">Add Faculty</a></li>
    <li><a href="add_student.php">Add Student</a></li>
    <li><a href="add_session.php">Add Session</a></li>
    <li><a href="export_attendance.php">Export Attendance</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
</body>
</html>
