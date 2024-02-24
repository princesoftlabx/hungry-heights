<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Categories</h1>
        <br/><br/>
        <!-- Button to add admin -->
        <a href="add_categories.php" class="btn-primary">Add Category</a>
        <br/><br/><br/>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
            unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                 unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
             ?>
            <table class = "tbl-full">
                <tr>
                    <th>S.NO.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                //Query to get all categories from the database
                $sql = "SELECT * FROM `tbl_category`";

                //execute the query
                $res = $conn->query($sql);

                //count the rows 
                $count = mysqli_num_rows($res);
                
                //create serial number variable and assign value as 1
                $sn = 1;

                if($count>0){
                    //We have data in database
                    //get the data and display
                    while($row = $res->fetch_assoc()){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active']; 
                        ?>
                         <tr>
                    <td><?php echo $sn++;   ?></td>
                    <td><?php echo $title;   ?></td>

                    <td>
                        <?php 
                        //Check whether the image name is available or not
                        if($image!=""){
                            //display the image 
                        ?>
                        <img src="../images/category/<?php echo $image ?>" width="100px">
                        <?php
                        }
                        else{
                            //display the message
                            echo "<div class='error'>Image not found</div>";
                        }
                         ?>
                    </td>

                    <td><?php echo $featured;   ?></td>
                    <td><?php echo $active;   ?></td>
                    <td>
                        <a href="update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                        <a href="delete_category.php?id=<?php echo $id; ?> & image_name=<?php echo $image; ?>" class="btn-danger">Delete Category</a>
                    </td>
                </tr>


<?php
                    }
                }
                else{
                    //We don't have data
                    //We will display the message inside table
                

?>
<tr>
    <td colspan ="6"><div class="error">No category added</div></td>
</tr>
<?php
                }
?>

            </table>

        <div class="clearfix"></div>

        </div>
    </div>
    <!-- Main Content Section Ends -->

   <?php include('partials/footer.php');  ?>