<?php
session_start();
if(!isset($_SESSION["u_un"]))
{
    header("location:login.php");
}
?>

