<?php include('partials/menu.php');   ?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="POST">
        <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Current Password</label>
    <input type="hidden" name="id" value="<?php echo $id;  ?>">
    <input type="password" name="password" placeholder="Current Password" class="form-control" id="exampleInputPassword1">
  </div>
        <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">New Password</label>
    <input type="password" name="new_password" placeholder="Enter Your New Password" class="form-control" id="exampleInputPassword1">
  </div>
        <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" name="c_password" placeholder="Confirm Your New Password" class="form-control" id="exampleInputPassword1">
  </div>
 
  <button type="submit" name="submit" class="btn btn-success">Change Password</button>
</form>
    </div>
</div>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    //1. Get the data from the form
    $id = $_POST['id'];
    $current_pass = $_POST['password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['c_password'];

    //2. Check whether the user with current id and current password exists or not
    $sql ="SELECT * FROM `tbl_admin` WHERE `id`='$id' AND `password`='$current_pass'";

    //Execute the query
    $res = $conn->query($sql);
    if($res==true){
        $count = mysqli_num_rows($res);
    }
    if($count==1){
        //echo "user is exist";
         //3. check whether the user's new password and confirm password match or not
        if($new_pass==$confirm_pass){
            // update Password";
            $sql2 = "UPDATE `tbl_admin` SET password ='$new_pass' WHERE id ='$id' ";
            //execute the query
            $res2 = $conn->query($sql2);
            //4.change password if all above is true 
            if($res==true){
                $_SESSION['pw-changed'] = "<div class='success'>Password Changed Successfully.</div>";
                header("location: manage_admin.php");
            }
            else{
                $_SESSION['pw-not-changed'] = "<div class='error'>Password did not changed.</div>";
                header("location: manage_admin.php");
            }
        }
        else{
            $_SESSION['pw-not-match'] = "<div class='error'>Password did not matched.</div>";
        header("location: manage_admin.php");
        }

    }
    else{
        //User does not exist
        $_SESSION['user-not-found'] = "<div class='error'>User not Found.</div>";
        header("location: manage_admin.php");
    }
   
    
}
?>
<?php include('partials/footer.php');   ?>