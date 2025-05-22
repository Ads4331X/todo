<?php
include 'connection.php';

$username = $_POST['Username'];
$password = $_POST['password'];

$check_sql = "SELECT username FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $check_sql);
if (!empty($username) & !empty($password)) {
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['error_message'] = "Username already exists";
        header("Location: signin.php");
        exit();
    }}

    if (!empty($username) & !empty($password)) {
        $sql = "INSERT INTO user (username,	pass ) values ( '$username' , '$password' )";
        mysqli_query($conn, $sql);
        header("Location: login.php");
        exit();
    }
} else {
    echo 'enter all the details';

    header("Location: signin.php");
    exit();
}
