<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SignIn</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<style>
  #data {
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

  html {
    touch-action: manipulation;
  }

  input {
    border: 1px solid gray;
    font-size: 16px;
  }

  button {
    border: none;
    cursor: pointer;
    margin-top: -10px;
    color: white;
    background-color: #00a3ff;
    font-size: 16px;
  }

  button:hover {
    color: wheat;
  }

  button:active {
    color: whitesmoke;
    transform: scale(0.98);
  }

  h3 {
    text-align: center;
    font-weight: bold;
    font-style: italic;
    font-size: xx-large;
  }

  .center {
    display: grid;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin-top: 6%;
  }

  .info {
    width: 300px;
    box-shadow: 1px 2px 8px gray;
    margin-bottom: 20px;
  }

  .to_log_in {
    font-size: small;
    margin-top: 2px;
  }

  .a_tag_div {
    display: flex;
    justify-content: center;
  }

  label {
    margin-top: -10px;
  }

  .error_message {
    color: red;
    text-align: center;
    font-weight: x-small;
  }

  .error_input {
    border: 2px solid red;
    border: 2px solid red !important;
    background-color: #ffe6e6;
    box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);

  }

  .to_go_back {
    display: flex;
    justify-content: start;
    align-items: start;
    padding-left: 10px;
    margin-top: -1%;
    font: xx-small;
    font-size: 12px;

  }
</style>

<body>
  <div class="center">
    <div class="info">
      <form action="signin-data.php" method="post">
        <h3>SIGN IN</h3>
        <div id="data">
          <label style="padding: 5px">&nbsp;&nbsp;Create A Username:</label>
          <input
            type='text'
            name='Username'
            id='Username'
            class='<?php echo $username_error_class; ?>t'
            placeholder='Username'
            required />
          <?php
          if (isset($_SESSION['error_message'])) {
            $error_input = 'error_input';
            echo "<div class='error_message'> {$_SESSION['error_message']} </div>";
            unset($_SESSION['error_message']);
          }
          ?>
          <br />
          <label style="padding: 5px">Enter A Password:</label>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="Password"
            required />
          <br />
          <button type="submit">SIGN IN</button>
          <br />
          <br />

          <div class="a_tag_div">
            <p class="to_log_in">Already Have An Account?</p>
            <a class="to_log_in" href="login.php">LogIn</a>
          </div>

        </div>
        <div class="to_go_back">
          <a href="form.html"><i class="fa-solid fa-arrow-left-long"></i>
          </a> &nbsp;&nbsp;Go Back
        </div>
      </form>
    </div>
  </div>
</body>

</html>