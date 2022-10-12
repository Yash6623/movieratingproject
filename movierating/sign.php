<?php
@include "config.php";
session_start();
if(isset($_POST["submit"])){
$email=mysqli_real_escape_string($conn,$_POST["usermail"]);
$pass = mysqli_real_escape_string($conn,$_POST['password']);
$cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);
// $pass
// =password_hash($pass,PASSWORD_BCRYPT);
// $cpass=password_hash($cpass,PASSWORD_BCRYPT);
$select = " SELECT * FROM movisign WHERE email = '$email' && password = '$pass'";
$result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist';
   }else{
      if($pass != $cpass){
         $error[] = 'password not mathched!';

      }else{
         $insert = "INSERT INTO movisign (`email`, `password`) VALUES('$email','$pass')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signstyle.css">
    <title>Document</title>
</head>
<body>
<div class="form-container">

<form action="" method="post">
   <h3 class="title">register now</h3>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
   ?>
   <input type="email" name="usermail" placeholder="enter your email" class="box" required>
   <input type="password" name="password" placeholder="enter your password" class="box" required>
   <input type="password" name="cpassword" placeholder="confirm your password" class="box" required>
   <input type="submit" value="register now" class="form-btn" name="submit">
   <!-- <p>already have an account? <a href="login.php">login now!</a></p> -->
   <p>Already have an account? <a href="login.php">Login now!</a></p>
</form>

</div>

</body>
</html>