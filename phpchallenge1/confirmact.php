<?php
session_start();
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

  if (isset($_GET['token'])){
    $token= $_GET['token'];
    $updatequery= "update users set status='active' where token='$token'";
    $sql= mysqli_query($conn, $updatequery);
    if($sql){
      if(isset($_SESSION['msg'])){
        $_SESSION['msg']="account verified";
        header('location:login.php');
      }
      else{
        $_SESSION['msg']="Logged out";
        header('location:login.php');
      }
    }else{
      $_SESSION['msg']="not verified";
      header('location:signup.php');
    }
  }
?>
