<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>
<style>
    #info {
        display: grid;
        justify-content: center;
        font: bold;
        font-size: larger;
        font-style: italic;
    }

    input,
    button {
        padding: 10px;
        border-radius: 10px;
    }

    input {
        border: 1px solid red;
    }

    button {
        border: 1px solid white;
        cursor: pointer;
    }

    label {
        padding: 5px;
    }

    h3 {
        text-align: center;
        font-weight: bold;
        font-style: italic;
        font-size: xx-large;
        margin-top: 40px;
    }

    a {
        display: flex;
        justify-content: center;
        text-align: center;
        text-decoration: none;
    }

    .logined,
    .Error,
    .empty {
        display: flex;
        justify-content: center;
        font-style: italic;
        font: bolder;
    }

    .logined {
        color: limegreen;
    }

    .Error .empty {
        color: red;
    }
</style>

<body>
    <form method="post">
        <h3>LOG IN</h3>
        <div id="info">
            <label>&nbsp;&nbsp;Username:</label>
            <input
                type="text"
                name="LOGIN_Username"
                id="Username"
                placeholder="Username" />
            <label>Password:</label>
            <input
                type="password"
                name="LOGIN_password"
                id="password"
                placeholder="Password" />
            <a href="signin.html">Create an account</a>
            <button type="submit">Submit</button>
        </div>
    </form>

</body>

</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = mysqli_query($conn, "SELECT username , pass , user_id from user");
    $LOGIN_USERNAME = $_POST['LOGIN_Username'];
    $LOGIN_PASSWORD = $_POST['LOGIN_password'];
    if ($result->num_rows > 0) {
        if (!empty($LOGIN_USERNAME) & !empty($LOGIN_PASSWORD)) {
            while ($row = $result->fetch_assoc()) {
                if ($row['username'] === $LOGIN_USERNAME && $row['pass'] === $LOGIN_PASSWORD) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $LOGIN_USERNAME;
                    echo "<br><div class='logined'>LOGIN-ED SUCCESSFULLY </div>";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<br><div class='Error'>Enter the correct info</div>";
                }
            }
        } else {
            echo "<br><div class='empty'>Please fill the info</div>";
        }
    }
}




?>