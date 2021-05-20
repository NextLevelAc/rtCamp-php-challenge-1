<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

<?php

$servername="localhost";
$username="root";
$pass="";
$dbname="registrations";


// Create connection
$conn = mysqli_connect($servername, $username, $pass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  else{
  echo "Connected successfully";
  }
$firstname=mysqli_real_escape_string($conn, $_REQUEST['firstname']);
$email=mysqli_real_escape_string($conn, $_REQUEST['email']);
$pass=mysqli_real_escape_string($conn, $_REQUEST['pass']);

$sql = "INSERT INTO users
(firstname, email, pass)
VALUES
('$firstname', '$email','$pass')";



if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

    <?php

$emailErr=$email=$firstnameErr=$firstname=$passErr=$pass="";
    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
        if (empty($_POST["firstname"]))
        {
            $firstnameErr = "firstName is required";
          }
          else
          {
            $firstname = test_input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname))
             {
              $firstnameErr = "Only letters and white space allowed";
            }
          }
        if (empty($_POST["email"]))
         {
            $emailErr = "Email is required";
          }
          else
          {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
             {
              $emailErr = "Invalid email format";
            }
          }
        }
        if ( empty($_POST["pass"]))
        {
            $passErr="pass is required";
        }
        else
        {
            $pass = test_input($_POST["pass"]);
        }

          function test_input($data)
          {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

          ?>
            <h2>Register yourself to get email at every 5 min</h2>


          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

          firstName: <input type="text" name="firstname" value="<?php echo $firstname;?>">

        <span class="error">* <?php echo $firstnameErr;?></span>

        <br><br>

          E-mail: <input type="text" name="email" value="<?php echo $email;?>">

            <span class="error">* <?php echo $emailErr;?></span>

            <br><br>

            pass: <input type="password" name="pass" value="<?php echo $pass;?>">

            <span class="error">* <?php echo $passErr;?></span>

            <br><br>

            <input type="submit" name="submit" value="Submit">

        </form>

<?php
 echo $firstname;
 echo "<br>";
 echo $email;
 echo "<br>";
?>


</body>

</html>
