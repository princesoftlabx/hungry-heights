<?php include('partials/db.php');    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/admin.css">
    <title>Login - Food Order System</title>
</head>
<body>
    <div class="login w-50 p-3 test">
        <h1 class="text-center border-bottom border-dark">Admin-Login</h1>
        <br><br>
        <?php  
        
        if(isset($_SESSION['no-loggedin-user'])){
          echo $_SESSION['no-loggedin-user'];
          unset($_SESSION['no-loggedin-user']);
        }

?>

        <form action="" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">UserName</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your username with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
        
        <p class="text-center">Created By - <a href="www.princesharma.com">Prince Sharma</a></p>
    </div>
    <?php
if(isset($_POST['submit'])){
    //1. GET the data from the login form
   $username = $_POST['username'];
   $password = $_POST['password'];
   //2. SQL query to check the username or password exists or not
   $sql = "SELECT * FROM `tbl_admin` WHERE username='$username' AND password='$password'";
//    execute the query
$res= $conn->query($sql);
//counts rows whether to check the row is exist or not
$count = mysqli_num_rows($res);
if($count==1){
    $_SESSION['loggedin'] = "<div class='success'>Loggedin Successfully</div>";
    $_SESSION['user'] = $username;//To check whether user is logged in or not
    header("location:manage_admin.php");
}else{
    $_SESSION['loggedin'] = "<div class='error'>User and password did not matched</div>";
    header("location:login.php");
}
}

?>
</body>
</html>