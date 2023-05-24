<?php


// $receiver = "mohamedgemy181@gmail.com";
// $subject = "Email Test via PHP using Localhost";
// $body = "Hi, there...This iaaaaaas a test email send from Localhost.";
// $sender = "From:sender email address here";
// if(mail($receiver, $subject, $body, $sender)){
//     echo "Email sent successfully to $receiver";
// }else{
//     echo "Sorry, failed while sending mail!";
// }

?>
<?php

@include 'config.php';


session_start();


// $ra=$_SESSION["code"]
// $email=$_SESSION['email'];

$receiver = "ssssss";
$subject = "Varification Mail";
$body = "$ra";
$sender = "From:sender email address here";
if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully to $receiver";
}else{
    echo "Sorry, failed while sending mail!";
}

if(isset($_POST['verify'])){


$comingCode = $_POST['code'];
echo "$comingCode";
if($ra == "$comingCode")
{
    header('location:register_form.php');

}
else
{
    $errorCode[] = 'Incorrect Code!';
}
//    if(mysqli_num_rows($result) > 0){

//       $row = mysqli_fetch_array($result);

//       if($row['user_type'] == 'admin'){

//          $_SESSION['admin_name'] = $row['name'];
//          header('location:admin_page.php');

//       }elseif($row['user_type'] == 'user'){

//          $_SESSION['user_name'] = $row['name'];
//          header('location:user_page.php');

//       }
     
//    }else{
//       $error[] = 'incorrect email or password!';
//    }

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
