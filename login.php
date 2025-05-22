<?php include 'connection.php';
session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        touch-action: manipulation;
    }




    input,
    button {
        padding: 10px;
        border-radius: 10px;
        padding-bottom: 20px;
        font: large;
    }

    #Username {
        border: 1px solid gray;
        text-align: left;
        font-size: large;
        padding: 10px;
        margin: 15px;
    }

    #password {
        border: 1px solid gray;
        text-align: left;
        font-size: large;
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 4px;

    }




    button {
        background-color: #007BFF;
        border-radius: 10px;
        cursor: pointer;
        color: white;
        text-align: center;
        font-size: large;
        padding: 10px;
        width: 100px;
        margin-top: 12px;
        border: none;
    }

    button:hover {
        color: wheat;
    }

    button:active {
        color: whitesmoke;
    }

    label {
        padding: 2rem;
        text-align: center;
        font-size: x-large;

    }

    h3 {
        text-align: center;
        font-weight: bold;
        font-style: italic;
        font-size: xx-large;
        margin-top: 40px;
    }

    a {
        text-decoration: none;
        font-size: small;

    }

    .a_tag {
        display: grid;
        width: 280px;
        justify-content: right;

    }

    .logined,
    .Error,
    .empty {
        display: flex;
        justify-content: center;
        font-style: italic;
        font: bolder;
        margin: -60px;
    }

    .logined {
        color: limegreen;
    }

    .Error,
    .empty {
        color: red;
    }

    #center {
        display: flex;
        justify-content: center;
        text-align: center;
    }

    #info {
        width: 340px;
        height: 450px;
        margin-top: 6%;
        border-radius: 18px;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.2);
        align-self: center;
    }

    .inside_data {
        padding: 10px;
    }
</style>


<body>
    <div id="center">
        <div id='info'>
            <form method='post'>
                <h3>LOG IN</h3>
                <div class="inside_data">
                    <br>
                    <label>&nbsp;&nbsp;Username:</label><br>
                    <input
                        type='text'
                        name='LOGIN_Username'
                        id='Username'
                        placeholder='Username' required /><br>
                    <label>Password:</label>
                    <input
                        type='password'
                        name='LOGIN_password'
                        id='password'
                        placeholder='Password' required />
                    <div class="a_tag"><a href='signin.html'>Create an account</a></div>
                    <button type='submit'>Login</button>
                    <br><br>
                </div>
            </form>
        </div>
    </div>


</body>

</html>
<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = mysqli_query($conn, "SELECT username , pass , user_id from user");
    $LOGIN_USERNAME = $_POST['LOGIN_Username'];
    $LOGIN_PASSWORD = $_POST['LOGIN_password'];
    $info = 'Please fill the info';
    $login_sucessful = false;

    if ($LOGIN_PASSWORD == '' & $LOGIN_USERNAME == '') {
        echo "<div class='empty_info empty'>Please Enter Your Username and Password </div>";
        $info = '';
    } else if ($LOGIN_PASSWORD == '') {
        echo "<div class='empty_password empty'>Please Enter Your Password </div>";
        $info = '';
    } else if ($LOGIN_USERNAME == '') {
        echo "<div class = 'empty empty_username'>Please Enter Your Username</div>";
        $info = '';
    } else {
        if ($result->num_rows > 0) {
            if (!empty($LOGIN_USERNAME) & !empty($LOGIN_PASSWORD)) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['username'] === $LOGIN_USERNAME && $row['pass'] === $LOGIN_PASSWORD) {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['username'] = $LOGIN_USERNAME;
                        echo "<div class='logined'>LOGIN-ED SUCCESSFULLY </div>";
                        $login_sucessful = true;
                        header("Location: index.php");
                        exit();
                    }
                }
            }
        }
        if (!$login_sucessful) {
            echo "<div class='Error'>Enter the correct info</div>";
        }
    }
}


?>