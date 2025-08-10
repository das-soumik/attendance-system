<?php
$host = "qrattendence-qrattent.e.aivencloud.com";
$port = "17413";
$dbname = "attendance_db";
$username = "avnadmin";
$password = "AVNS_4vpHBtDyc_aaWSh8gdJ";
$ca_cert = __DIR__ . "/ca.pem"; // Download from Aiven console

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::MYSQL_ATTR_SSL_CA => $ca_cert,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    die(json_encode(["status" => "error", "message" => $e->getMessage()]));
}
?>
