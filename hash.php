
<?php
$gfg = "GeeksforGeeks";
$iterations = 142;
  
// Generate a random IV using 
// openssl_random_pseudo_bytes()
// random_bytes() or another 
// suitable source of randomness.
$salt = "sasasadasdasd";
  // echo "ssssssssss    $salt";
// Using hash_pbkdf2 function
$hash = hash_pbkdf2("sha256",
    $gfg, $salt, $iterations, 30);
  
// Display result
echo $hash;
?>
