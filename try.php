<?php 
// Initialize variables 
$name = ''; 
$email = ''; 
 
// Check if the form is submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Collect and sanitize form data 
    $name = htmlspecialchars($_POST['name']); 
    $email = htmlspecialchars($_POST['email']); 
} 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Form Submission Example</title> 
</head> 
<body> 
 
<h2>Submit Your Information</h2> 
<form method="POST" action=""> 
    <label for="name">Name:</label> 
    <input type="text" id="name" name="name" required> 
    <br><br> 
    <label for="email">Email:</label> 
    <input type="email" id="email" name="email" required> 
    <br><br> 
    <input type="submit" value="Submit"> 
</form> 
 
<?php 
// Display submitted data if available 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    echo "<h3>Submitted Data:</h3>"; 
    echo "<p>Name: " . $name . "</p>"; 
    echo "<p>Email: " . $email . "</p>"; 
} 
?> 
 
</body> 
</html> 