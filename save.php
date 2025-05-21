<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];

$task = $_POST['task'];
$id = $_POST['position_id'];
$edit = $_POST['edit'];
$edit_id = $_POST['edit_id'];

if (!empty($task)) {
   $sql = "INSERT INTO todotable (task, position , user_id )
        SELECT '$task', IFNULL(MAX(position), 0) + 1  , $user_id FROM todotable where user_id = $user_id";
   mysqli_query($conn, $sql);
}
if (!empty($edit)) {
   $sql = "UPDATE todotable SET task = '$edit' WHERE id = '$edit_id'";
   mysqli_query($conn, $sql);
}
header(header: "Location: index.php");


mysqli_close($conn);
