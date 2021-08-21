<?php

include_once("database.php");
session_start();
if(isset($_SESSION["userid"])){
    $sql = "SELECT * FROM users WHERE id = ".$_SESSION["userid"];
    $do = mysqli_query($link, $sql);
    $userdata = mysqli_fetch_assoc($do);
}else{
    header("location: login.php");
};

?>