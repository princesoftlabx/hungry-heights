<?php  include('partials/menu.php');  ?>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>

    <br><br>

    <?php 
        //check whether the id is set or not
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //Create SQL query to fetch all data
            $sql = "SELECT * FROM `tbl_category` WHERE `id`='$id'";

            //Lets execute the query
            $res = $conn->query($sql);

            //count the rows whether check the id is valid or not
            $count = mysqli_num_rows($res);

            if($count == 1){
                $row = $res->fetch_assoc();
                $title = $row['title'];
                $currentImg = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else{
                $_SESSION['no-category-found']= "<div class='error'>Category not found</div>";
                header("location: manage_categories.php");
            }
        }
        else{
            header("location: manage_categories.php");
        }
        ?>

    <form action="" method="POST" enctype="multipart/form-data">
      <!--this is used to upload files or images -->
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Title</label>
        <input type="text" name="title" value="<?php echo $title;  ?>" placeholder="Category of Food"
          class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Current Image:</label>
        <?php
        if($currentImg != ""){
            //Display the image
            ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="../images/category/<?php echo $currentImg; ?>"
          width="100px">
        <?php
        }
        else{
            echo "<div class='error'>Image Not added</div>";
        }

?>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">New Image</label>
        <input type="file" name="image" value="<?php echo $title;  ?>" class="form-control" id="exampleInputEmail1"
          aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Featured</label>
        <br>
        <input <?php if($featured == "Yes"){ echo "checked"; } ?> type="radio" name="featured"
          id="exampleInputPassword1" value="Yes">Yes

        <input <?php if($featured == "No"){ echo "checked"; } ?> type="radio" name="featured" id="exampleInputPassword1"
          value="No">No
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Active</label>
        <br>
        <input <?php if($active == "Yes"){ echo "checked"; } ?> type="radio" name="active" id="exampleInputPassword1"
          value="Yes">Yes

        <input <?php if($active == "No"){ echo "checked"; } ?> type="radio" name="active" id="exampleInputPassword1"
          value="No">No
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <input type="hidden" name="currentImg" value="<?php echo $currentImg;  ?>">
      <input type="hidden" name="id" value="<?php echo $id;  ?>">
      <button type="submit" name="submit" class="btn btn-primary">Update Category</button>
    </form>

    <?php
if(isset($_POST['submit'])){
    //Get all the value from our form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $image = $_POST['currentImg'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //Update new image is selected
    //check whether image is selected or not
    if(isset($_FILES['image']['name'])){
      //Get the image details
      $image_name = $_FILES['image']['name'];

      //check whether image is available or not
      if($image_name != ""){
        //Image is available
        //A. upload the new image
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
               header("location: manage_categories.php");
             die();
           }
          //reMove the current image if image is available
          if($image != ""){
          $remove_path = "../images/category/".$image;
          $remove = unlink($remove_path);

          //check whether the image is remove or not
          //if image is removed then display message and stop the process
          if($remove==false){
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the image</div>";
            header("location: manage_categories.php");
            die();  //stop the process
          }
        }
      }
      else{
        $image_name = $image;
      }
    }
    else{
      $image_name = $image;
    }
    
    //Update the database
    $sql2 = "UPDATE `tbl_category` SET `title`='$title', `image_name`='$image_name', `featured`='$featured', `active`='$active' WHERE `id`='$id'";

    //Executue the query
    $res2 = $conn->query($sql2);

    //redirect to manage category with message
    //check whether executed or not
    if($res2==true){
      $_SESSION['update'] = "<div class='success'>Category updated Successfully</div>";
      header("location: manage_categories.php");
    }
    else{
      $_SESSION['update'] = "<div class='error'>Failed to update Category</div>";
      header("location: manage_categories.php");
    }
}



?>
  </div>
</div>








<?php  include('partials/footer.php');  ?>