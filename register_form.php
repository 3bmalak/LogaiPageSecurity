<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   // $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email'  ";
   

   

   $result = mysqli_query($conn, $select);
   

   if(mysqli_num_rows($result) > 0)
   {

      $error[] = 'user already exist!';

   }
   else
   {

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         if(!empty($_POST["password"])) {
         
            if (strlen($_POST["password"]) <= '8'  && !preg_match("#[0-9]+#",$pass) && !preg_match("#[A-Z]+#",$pass)) {
                $passwordErr = "Your Password Must be At Least 8 Characters Including At Least 1 Number, 1 Capital Letter, and 1 Spcial Character ";
            }
           else {
               $pass = hash('sha256',$_POST['password']);
               $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','admin')";
               mysqli_query($conn, $insert);
               header('location:login_form.php');;
            }
        }
       
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
  
      <?php
      if(isset($passwordErr)){

            echo '<h4>'.$passwordErr.'<h4>';

      };
      ?>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>


</body>
</html>