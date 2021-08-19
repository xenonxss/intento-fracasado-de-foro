<?php
function generateRandomString($length = 10)
{
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
}
$servername = "localhost";
$database = "foroxss";
$username = "root";
$password = "";
// Create connection
$link = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$link) {
      die("Connection failed: " . mysqli_connect_error());
}
