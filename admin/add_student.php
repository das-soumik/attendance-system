<?php
require "../config.php";
if (!isset($_SESSION['admin_id'])) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enrollment_no = $_POST['enrollment_no'];
    $name = $_POST['name'];

    $stmt = $pdo->prepare("INSERT INTO students (enrollment_no, name) VALUES (?, ?)");
    $stmt->execute([$enrollment_no, $name]);
    $msg = "Student added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Student</title></head>
<body>
<h2>Add Student</h2>
<?php if (!empty($msg)) echo "<p style='color:green'>$msg</p>"; ?>
<form method="post">
    Enrollment No: <input type="text" name="enrollment_no"><br>
    Name: <input type="text" name="name"><br>
    <input type="submit" value="Add Student">
</form>
</body>
</html>
