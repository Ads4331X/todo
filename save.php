<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'todolist';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
   die('could not connect' . mysqli_connect_error());
}

$task = $_POST['task'];

if (!empty($task)) {
   $sql = "INSERT into todotable(task) VALUES ('$task');";
   mysqli_query($conn, $sql);
}
header(header: "Location: index.php");


mysqli_close($conn);
