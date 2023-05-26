<?php


$db_password = "b3725122c9d3bfef5664619e08e31877";
$password = "marie";
$salt = "cjkfenjfkren"; //This salt is appended to the user´s password
echo "<br>";
echo $password;
echo "<br>";
echo md5($password); //generate a secure hash of the password 
echo "<br>";
echo "<br>";

//if ("e9803a706f81a40884b8aeafafb2cfd3" == md5($password) ) {
//     echo "your PW is correct";
//     echo "<br>";
// }

echo "<br>";
echo $password . $salt;
echo "<br>";
$pw = md5($password . $salt);
echo md5($pw);
echo "<br>";
echo mb_strlen($pw);


echo "<br>";
echo "<br>";
echo password_hash($password, PASSWORD_DEFAULT);
