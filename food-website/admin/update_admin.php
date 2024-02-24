<?php  include('partials/menu.php');  ?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
    //1.Get the Id to Update a Admin
    $id = $_GET['id'];
    //2.Write a query to update a admin
    $sql = "SELECT * FROM `tbl_admin` WHERE `id` = '$id'";
    //3.Execute the Query
    $res = $conn->query($sql);

    //Check whether the query is executed or not
    If($res){
        //check whether the data is available or not
        $count = mysqli_num_rows($res);
    }
    if($count==1){
        // echo "admin available";
        $row = $res->fetch_assoc();
    }


?>

        <form action="update_admin.php" method="POST">
        <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Full Name</label>
    <input type="hidden" name="id" value="<?php echo $row['id'];   ?>">
    <input type="text" name="full_name" value="<?php echo $row['full_name'];  ?>" class="form-control" placeholder="Enter Your Full Name" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">User Name</label>
    <input type="text" name="username" value="<?php echo $row['username'];  ?>" class="form-control" placeholder="Enter Your User name" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
 
  <button type="submit" class="btn btn-success">Update Admin</button>
</form>
    </div>
</div>


<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
//Get all the values from the form to update
$id = $_POST['id'];
$full_name = $_POST['full_name'];
$username = $_POST['username'];

$sql = "UPDATE `tbl_admin` SET `full_name`='$full_name', `username`='$username' WHERE `id`='$id'";
$res = $conn->query($sql);
if($res){
    $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
    header("location: manage_admin.php");
}

}

?>


<?php  include('partials/footer.php');    ?>