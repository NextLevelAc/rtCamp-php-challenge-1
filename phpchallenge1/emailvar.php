<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$fname=$email=$pass=$confirmpass="";
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
  echo "Connected successfully<br><br>";
  }
?>
<?php
if (isset($_POST["submit"])){
$fname=mysqli_real_escape_string($conn, $_POST['fname']);
$email=mysqli_real_escape_string($conn, $_POST['email']);
$pass=mysqli_real_escape_string($conn, $_POST['pass']);
$confirmpass=mysqli_real_escape_string($conn, $_POST['confirmpass']);
$fname = test_input($_POST["fname"]);
$email = test_input($_POST["email"]);
$pass = test_input($_POST["pass"]);
$confirmpass = test_input($_POST["confirmpass"]);
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
$token= bin2hex(random_bytes(15));
$duplicate="SELECT * FROM `users` WHERE email='$email'";
$check=mysqli_query($conn, $duplicate);
$emailcount=mysqli_num_rows($check);
if(empty($email) && empty($fname) && empty($pass) && empty($confirmpass)){
  echo "Input fields can't be empty";
  return false;
}
elseif (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
  // code...
  echo "Name should be in proper format";
}
elseif ($pass!=$confirmpass) {
  // code...
  echo "Passwords are't matching";
}
  elseif ($emailcount>0) {
    // code...
    echo "Email is already in use";
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // code...
    echo "Email should be in proper format";
  }
else{
  $hash=password_hash($pass, PASSWORD_BCRYPT);
  $confirmhash=password_hash($confirmpass, PASSWORD_BCRYPT);
  $sql = "INSERT INTO users (fname, email, pass, confirmpass, token, status) VALUES ('$fname', '$email', '$hash', '$confirmhash', '$token', 'inactive')";
  if ($conn->query($sql) === TRUE) {
  require_once "vendor/autoload.php";
  $mail = new PHPMailer(true);
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = 'tls';
  $mail->Username   = 'acpacy21@gmail.com';                     //SMTP username
    $mail->Password   = 'V9Qx@pyas';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;
    $mail->setFrom('acpacy21@gmail.com', 'Ashish');
      $mail->addAddress($email);


  //Provide file path and name of the attachments
  $mail->isHTML(true);

  $mail->Subject = "Email verification link";
  $mail->Body = "<i>hi, $fname Click on the link to verify you email address http://localhost/phpchallenge1/confirmact.php?token=$token</i>";
  $mail->AltBody = "This is the plain text version of the email content";

  try {
      $mail->send();
      header("Location:login.php");
      $_SESSION['msg']="Check your email to verify your account";
      echo "Message has been sent successfully";
  } catch (Exception $e) {
      echo "Mailer Error: " . $mail->ErrorInfo;
  }

}
}



$conn->close();
?>
