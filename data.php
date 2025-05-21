<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'todolist';

$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM todotable ORDER BY position ASC";
$result = $conn->query($sql);
