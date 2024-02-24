<?php
include('partials/menu.php');

//check whether the id or image_name is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    
    //Get the value and delete
    $id = $_GET['id'];
    $image = $_GET['image_name'];

    //Remove the physical image file is available
    if($image != ""){
        //Image is available so remove it
        $path = "../images/category/".$image;

        //Remove the Image
        $remove = unlink($path);

        //if failed to remove image then add an error and stop the process
        if($remove==false){
            //Set the Session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
            //REdirect to manage categories page
            header("location: manage_categories.php");
            //stop the process
            die();
        }
    }
    //delete data from database
    //SQL Query to delete data from the database
    $sql = "DELETE FROM `tbl_category` WHERE `id`= '$id'";
    
    //Execute the query
    $res = $conn->query($sql);
    
    //Check whether the data is delete or not from the database
    if($res==true){
        //Set success message and redirect
        $_SESSION['delete']= "<div class='success'>Category Deleted Successfully</div>";

        //redirect to manage category
        header("location: manage_categories.php"); 
    }

    else{
        //Set failed message and redirect
        $_SESSION['delete']= "<div class='error'>Failed to delete category</div>";

        //redirect to manage category
        header("location: manage_categories.php"); 
    }



}
else{
    header("location: manage_categories.php");
}

?>