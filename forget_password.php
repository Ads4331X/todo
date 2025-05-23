<?php include 'connection.php';
session_start();
$message = '';

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  unset($_SESSION['message']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $result = mysqli_query($conn, "SELECT username , pass , user_id from user");
  $LOGIN_USERNAME = $_POST['LOGIN_Username'];
  $New_PASSWORD = $_POST['LOGIN_password'];
  $result = mysqli_query($conn, "SELECT username from user where username = '$LOGIN_USERNAME'");
  if ($result && mysqli_num_rows($result) > 0) {
    $change_password = "UPDATE user set pass = '$New_PASSWORD' where username = '$LOGIN_USERNAME'";
    mysqli_query($conn, $change_password);
    $_SESSION['message'] =  "<p class = 'changed'>Password Changed Sucessfully</p>";
    header("Location: login.php");
    exit();
  } else {
    $_SESSION['message'] =  "<p class = 'error'>Username Doesn't exist</p>";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forget Password</title>
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

  .error {
    color: red;
  }




  input,
  button {
    padding: 10px;
    border-radius: 10px;
    padding-bottom: 20px;
    font: large;
    font-size: 16px;

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
    transform: scale(0.98);
  }

  label {
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

  .changed {
    color: limegreen;
  }


  #center {
    display: flex;
    justify-content: center;
    text-align: center;
  }

  #info {
    width: 340px;
    height: 400px;
    margin-top: 6%;
    border-radius: 18px;
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.2);
    align-self: center;
  }

  .inside_data {
    padding: 10px;
  }

  hr {
    width: 300px;
    margin: auto;
    margin-top: -1vh;
  }
</style>

<body>
  <div id="center">
    <div id='info'>
      <form method='post'>
        <h3>Reset Your Password</h3>
        <br>
        <hr>
        <div class="inside_data">
          <label>&nbsp;&nbsp;Enter Your Username:</label><br>
          <input
            type='text'
            name='LOGIN_Username'
            id='Username'
            placeholder='Username' required /><br>
          <label>Change Your Password:</label>
          <input
            type='password'
            name='LOGIN_password'
            id='password'
            placeholder='Password' required /><br><br>
          <hr>
          <button type='submit'>Login</button>
          <br><br>
          <?php echo $message;  ?>
        </div>
      </form>
    </div>
  </div>


</body>

</html>

<?php

?>