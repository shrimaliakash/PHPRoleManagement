<?php
$host = 'localhost';
$db = 'akash_test';
$user = 'root';
$password = '123456';

$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
return $conn;
?>
