<?php include('partials/menu.php'); ?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Categories</h1>
        <br><br>
        <?php
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }


?>

        <!-- Add category form Starts -->
        <form action="" method="POST" enctype="multipart/form-data"> <!--this is used to upload files or images -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" name="title" placeholder="Category of Food" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Select Image</label>
    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Featured</label>
    <br>
    <input type="radio" name="featured" id="exampleInputPassword1" value="Yes">Yes
    <input type="radio" name="featured" id="exampleInputPassword1" value="No">No
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Active</label>
    <br>
    <input type="radio" name="active" id="exampleInputPassword1" value="Yes">Yes
    <input type="radio" name="active" id="exampleInputPassword1" value="No">No
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
        <!-- Add category form Ends -->
        <?php

        if(isset($_POST['submit'])){
            // 1.Get the value from the form
            $title = $_POST['title'];
// for radio, We need to check whether the button is selected or not
            if(isset($_POST['featured'])){
            //get the value from the form
            $featured = $_POST['featured'];
            }
            else{
                //set the default value
                $featured = "No";
            }
            if(isset($_POST['active'])){
                //get the value from the form
            $active = $_POST['active'];
            }
            else{
                //set the default value
                $active = "No";
            }
            // //Check whether the image is selected or not and set the value for image name accordingly
            // print_r($_FILES['image']);
            // die();//Break the code here
            if(isset($_FILES['image']['name'])){
                // upload the image
                //to upload the image we need image path and destination path
                $image_name = $_FILES['image']['name'];

                //Upload the image only if image is selected
                if($image_name != ""){

                //Auto rename our image
                //Get the extension of our image (jpg, png, gif, etc) e.g "food1.jpg"
                $ext = end(explode('.', $image_name));
                
                //Rename the image
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //e.g. Food_Category_87.jpg
                
                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;

                //Finally Upload the image

                $upload = move_uploaded_file($source_path, $destination_path);
                //whether check the image uploaded or not
                //and if the image is not uploaded then we will stop the process and redirect with error message
                if(!$upload){
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                    //redirect to the add category page
                    header("location: add_categories.php");
                    die();
                }
            }
            }
            else{
                //Don't upload image and set the value name as blank
                $image_name = "";
            }
            //2. Create SQL Query to insert data in data base
            $sql = "INSERT INTO `tbl_category` (`title`, `featured`, `image_name`, `active`) VALUES ('$title', '$featured','$image_name', '$active')";
            // 3.execute the query
            $res = $conn->query($sql);
            if($res==1){
                $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                header("location: manage_categories.php");
            }
            else{
                $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
                header("location: add_categories.php");
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>



