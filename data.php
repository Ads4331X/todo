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

$sql = "SELECT * FROM todotable";
$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list</title>

</head>


<body>

</body>

</html>