
<?php

@include 'config.php';


session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);

  

   

   $select = " SELECT * FROM user_form WHERE email = '$email' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      
         $row = mysqli_fetch_array($result);
         $hh = $row['name'];
         $error[] = "the user name is : $hh";
      


   }
   else{
      $error[] = 'Not Found';
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
      <h3>Search using email</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="email" required placeholder="Enter the email">
      <input type="submit" name="submit" value="Search" class="form-btn">
   </form>

</div>

</body>
</html>