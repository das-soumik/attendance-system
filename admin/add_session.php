<?php
require "../config.php";
if (!isset($_SESSION['admin_id'])) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $session_name = $_POST['session_name'];
    $date = $_POST['date'];

    $stmt = $pdo->prepare("INSERT INTO sessions (session_name, date) VALUES (?, ?)");
    $stmt->execute([$session_name, $date]);
    $msg = "Session added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Session</title></head>
<body>
<h2>Add Session</h2>
<?php if (!empty($msg)) echo "<p style='color:green'>$msg</p>"; ?>
<form method="post">
    Session Name: <input type="text" name="session_name"><br>
    Date: <input type="date" name="date"><br>
    <input type="submit" value="Add Session">
</form>
</body>
</html>
