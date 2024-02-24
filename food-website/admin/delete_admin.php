<?php
include('partials/menu.php');

//1. Get the id of Admin to be deleted

$id = $_GET['id'];

//2. Write a query to delete admin id
$sql = "DELETE FROM `tbl_admin` WHERE `id` = '$id'";

//3.Execute the Query
$res = $conn->query($sql);

//4. redirect your page to the manage admin
if($res){
    $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully</div>";
    header("location:manage_admin.php");
}else{
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later</div>";

}


?>