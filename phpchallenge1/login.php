<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>

<?php session_start();?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}
* {box-sizing: border-box;}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  position: absolute;
  top: 50%;
  left:50%;
  transform: translate(-50%, -50%);
  width:400px;
  background: white;
}
h3{
  text-align: center;
  padding:0 0 20px 0;
  border-bottom: 1px solid silver;
}
span.pass {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.pass {
     display: block;
     float: none;
  }
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
  echo "Connected successfully<br><br>";
  }

  if(isset($_POST['submit'])){  //did user clicked the submit button of login page
    $email=$_POST['email'];    //if yes then fetch from user his email.
    $pass=$_POST['pass'];  //also fetch the password from user in login page.
    $email_search="select * from users where email='$email'"; //if email already exist
    $sql=mysqli_query($conn,$email_search); //query fired
    $email_count=mysqli_num_rows($sql);  //if email exist in db
    if($email_count){
      $email_pass=mysqli_fetch_assoc($sql);//get user encrypted pass from db with the help of same email.
    $db_pass=$email_pass['pass']; // both password(encryted and plain text) from database fetched.
    $_SESSION['fname']=$email_pass['fname'];
    $pass_decode=password_verify($pass, $db_pass); //verifying user input pass and the db encrypted pass for login.
      if($pass_decode){
      echo "login successful";
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
      $mail->addAttachment('xkcdimage1.png');
      //Provide file path and name of the attachments
      $mail->isHTML(true);
      $mail->Subject = "XKCD comics";
      $mail->Body ="xkcd image https://xkcd.com/2465/";
      $mail->AltBody = "This is the plain text version of the email content";
      $mail->AddCustomHeader('List-Unsubscribe', "<mailto:acpacy21@gmail.com?subject=Unsubscribe>,<http://localhost/phpchallenge1/logout.php/>");


      try {
          $mail->send();
          echo "Message has been sent successfully";
      } catch (Exception $e) {
          echo "Mailer Error: " . $mail->ErrorInfo;
      }
    }
    ?>
    <script>
    location.replace("home.php");
    </script>
    <?php
    }else{
      echo "password incorrect";
    }
  }else{
    echo "Invalid email";
  }

  $conn->close();
 ?>
<h3>Login Form</h3>
<div>
  <p class="bg-success tet-white px-4"> <?php if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
  }else{
    echo $_SESSION['msg']= "logged out successfully";
  } ?></p>
</div>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">


  <div class="container">
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="pass"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>
    <a href="signup.php">signup page link</a><br><br>
    <button type="submit" name="submit">Subscribe</button>

  </div>

</form>

</body>
</html>
