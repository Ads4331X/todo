
<?php
include 'connection.php';

$username = $_POST['Username'];
$password = $_POST['password'];

if (!empty($username) & !empty($password)) {
    $sql = "INSERT INTO user (username,	pass ) values ( '$username' , '$password' )";
    mysqli_query($conn, $sql);
    header(header: "Location: login.php");
    exit();
} else {
    echo 'enter all the details';
    header(header: "Location: signin.html");
}
