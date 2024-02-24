<?php
//Authorization or Access control
//1. Check whether the user is logged in or not
if(!isset($_SESSION['user'])){ //if user session is not set
//so te user is not logged in s
//redirect to the logged in 
// unset($_SESSION['user']);
$_SESSION['no-loggedin-user'] = "<div class='error text-center'>Please loggedin to access admin panel</div>";
header("location: login.php");
}
?>