<?php
require "../config.php";
if (!isset($_SESSION['admin_id'])) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password_hash = hash('sha256', $_POST['password']);

    $stmt = $pdo->prepare("INSERT INTO faculty (name, username, password_hash) VALUES (?, ?, ?)");
    $stmt->execute([$name, $username, $password_hash]);
    $msg = "Faculty added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Faculty</title></head>
<body>
<h2>Add Faculty</h2>
<?php if (!empty($msg)) echo "<p style='color:green'>$msg</p>"; ?>
<form method="post">
    Name: <input type="text" name="name"><br>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Add Faculty">
</form>
</body>
</html>
