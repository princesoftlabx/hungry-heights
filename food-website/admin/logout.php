<?php
//1. Destroy the session and redirect to login page
session_start();
session_destroy();
session_unset();

//2.redirect to login page
header("location:login.php");




?>