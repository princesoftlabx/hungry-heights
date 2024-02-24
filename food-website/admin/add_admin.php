<?php include('partials/menu.php'); ?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<div class="main-content">

    <div class="wrapper">
        <h1>Add admin</h1>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
        <form action="" method="POST">
        <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Full Name</label>
    <input type="text" name="full_name" class="form-control" placeholder="Enter Your Full Name" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">User Name</label>
    <input type="text" name="username" class="form-control" placeholder="Enter Your User name" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" placeholder="Enter Your Password" class="form-control" id="exampleInputPassword1">
  </div>

  
  <button type="submit" class="btn btn-success">Add Admin</button>
</form>
    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php
// Process the value from form to the database
// Check the $_SERVER["REQUEST METHOD"] IS POST OR NOT
$msg = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];   // md5 is used to encrypt your password
    //SQL Query to save the data into data base
    $check = mysqli_num_rows($conn->query("SELECT * FROM `tbl_admin` WHERE `username` = '$username'"));
    if($check>0){
    echo '<div class="alert alert-danger" role="alert">
    this '.$username.' is already exists!
  </div>';
}else{
    $sql = "INSERT INTO `tbl_admin`(full_name, username, password) VALUES ('$full_name', '$username', '$password')";
    $res = $conn->query($sql);
    if($res==true){
        $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
        header("Location: manage_admin.php");
    }
}
}
?>