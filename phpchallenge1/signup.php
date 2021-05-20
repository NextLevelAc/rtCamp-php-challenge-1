<!DOCTYPE html>
<?php session_start(); ?>
<?php include 'emailvar.php'; ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}
input[type=password] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
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
</style>
</head>
<body>

<div class="container">
<h3>Email spam app</h3>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="text" name="fname" placeholder="Your full name">
    <input type="text" name="email" placeholder="Your email..">
    <input type="password" name="pass" placeholder="Password">
    <input type="password" name="confirmpass" placeholder="Confirm Password">
    <a href="login.php">login page link</a><br><br>
    <input type="submit" name="submit" value="Confirm">

  </form>
</div>
</body>
</html>
