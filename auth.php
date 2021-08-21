<?php

session_start();
include("database.php");
if(isset($_SESSION["userid"])){
    $sql = "SELECT * FROM usuarios WHERE id = ".$_SESSION["userid"];
    $do = mysqli_query($link, $sql);
    $userdata = mysqli_fetch_assoc($do);
}else{
    header("location: login.php");
};

?>