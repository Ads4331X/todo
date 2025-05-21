<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'todolist';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('could not connect' . mysqli_connect_error());
}
