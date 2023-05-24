
<?php

@include 'config.php';


session_start();

 


if (isset($_SESSION["locked"]))
{
    $difference = time() - $_SESSION["locked"];
    if ($difference > 60*10)
    {
        unset($_SESSION["locked"]);
        unset($_SESSION["login_attempts"]);
        $_SESSION['login_attempts']=0;
    }
}

if(isset($_POST['submit'])){

   
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = hash('sha256',mysqli_real_escape_string($conn, $_POST['password']));
  

   

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      
      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }
      elseif($row['user_type'] == 'user'){

         $_SESSION['email']=$email;
         $ra=rand(1000,9999);
         echo "$ra";
         $_SESSION["code"]=$ra;
         $_SESSION['user_name'] = $row['name'];

         //Send Verfication code
         $receiver = $_SESSION['email'];
         $subject = "Varification Mail";
         $body = $_SESSION["code"];
         $sender = "From:sender email address here";
         mail($receiver, $subject, $body, $sender);

         header('location:verify.php');

      }
     
   }
   else{
      $_SESSION['login_attempts'] += 1;
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php 
?>
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <?php
            // In sign-in form submit button
            if ($_SESSION["login_attempts"] > 3)
            {
               $_SESSION["locked"] = time();
               echo "Please wait for 10 minutes";
            }
            else
            {
         
         ?>
                  <input type="submit" name="submit" value="login now" class="form-btn">
         
         <?php
         }
         ?>
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>