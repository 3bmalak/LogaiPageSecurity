<?php

@include 'config.php';

session_start();
if(isset($_POST['verify'])){
    if($_POST["code"] == $_SESSION["code"])
    {
        header('location:user_page.php');
    }
    else
    {
        $errorCode[] = 'Incorrect Code!';
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

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Verification Code</h3>
      <?php
      if(isset($errorCode)){
         foreach($errorCode as $errorCode){
            echo '<span class="error-msg">'.$errorCode.'</span>';
         };
      };
      ?>
      <input type="verify" name="code" required placeholder="Enter the code">
      <input type="submit" name="verify" value="VERIFY" class="form-btn">
   </form>

</div>

</body>
</html>
