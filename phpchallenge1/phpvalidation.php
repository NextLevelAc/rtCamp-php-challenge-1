<?php

// define variables and set to empty values
$fname = $fnameErr = $email = $emailErr = $pass = $passErr = $confirmpass = $confirmpassErr = "";


if (isset($_POST["submit"])){
    if (empty($_POST["fname"]))
    {
        $fnameErr = "First name is required";
      }
      else
      {
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname))
         {
          $fnameErr = "Only letters and white space allowed";
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

    if (empty($_POST["pass"]))
    {
        $passErr="pass is required";
    }
    else
    {
        $pass = test_input($_POST["pass"]);
    }
    if (empty($_POST["confirmpass"]))
    {
        $confirmpassErr="please confirm your password";
    }
    else
    {
        $confirmpass = test_input($_POST["confirmpass"]);
        if($pass != $confirmpass){
            $confirmpassErr = "password does not match";
        }
    }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
include 'dbconn.php';
echo "<h2>Your Input:</h2>";
echo $fname;
echo "<br>";
echo $email;
echo "<br>";

?>
