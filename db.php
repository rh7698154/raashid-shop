<?php
// XAMPP default settings. Change these if your MySQL setup uses a password.
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'raashid_shop';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    http_response_code(500);
    exit('Database connection failed. Check db.php settings and import database.sql.');
}
$conn->set_charset('utf8mb4');
?>
