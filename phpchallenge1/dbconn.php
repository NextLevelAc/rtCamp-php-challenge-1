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

  $mail->Subject = "Subject Text";
  $mail->Body = "<i>Mail body in HTML</i>";
  $mail->AltBody = "This is the plain text version of the email content";

  try {
      $mail->send();
      echo "Message has been sent successfully";
  } catch (Exception $e) {
      echo "Mailer Error: " . $mail->ErrorInfo;
  }

$conn->close();
?>
