<?php include('admin/partials/db.php'); 



// Process the value from form to the database
// Check the $_SERVER["REQUEST METHOD"] IS POST OR NOT
$msg = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $full_name = $_POST['uname'];
    $username = $_POST['email'];
    $password = $_POST['pass'];   // md5 is used to encrypt your password
    //SQL Query to save the data into data base
    $check = mysqli_num_rows($conn->query("SELECT * FROM `tbl_user` WHERE `uname` = '$full_name'"));
    if($check>0){
    echo '<div class="alert alert-danger" role="alert">
    this '.$full_name.' is already exists!
  </div>';
}
else{
    $sql = "INSERT INTO `tbl_user`(uname, email, pass) VALUES ('$full_name', '$username', '$password')";
    $res = $conn->query($sql);
    if($res==true){
        $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
        header("Location: login.php");
    }
}
}



if(isset($_POST['submit'])){
    //1. GET the data from the login form
   $email = $_POST['email'];
   $password = $_POST['pass'];
   //2. SQL query to check the username or password exists or not
   $sql = "SELECT * FROM `tbl_user` WHERE email='$email' AND pass='$password'";
//    execute the query
$res= $conn->query($sql);
//counts rows whether to check the row is exist or not
$count = mysqli_num_rows($res);
if($count==1){
    $_SESSION['loggedin'] = "<div class='success'>Loggedin Successfully</div>";
    $_SESSION['email'] = $email;//To check whether user is logged in or not
    header("location:index.php");
}else{
    $_SESSION['loggedin'] = "<div class='error'>User and password did not matched</div>";
    header("location:login.php");
}
}
  
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Dual Login / Signup Form</title>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width" />
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css"
      />
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      />
      <link rel="stylesheet" href="./loginStyle.css" />
   </head>
   <body>
      <div class="ocean">
         <div class="wave"></div>
         <div class="wave"></div>
      </div>
      <!-- Log In Form Section -->
      <section>
         <div class="container" id="container">
            <div class="form-container sign-up-container">
               <form action="#" method="POST">
                  <h1>Sign Up</h1>
                  <div class="social-container">
                     <a href="#" target="_blank" class="social"
                        ><i class="fab fa-github"></i
                     ></a>
                     <a href="#" target="_blank" class="social"
                        ><i class="fab fa-codepen"></i
                     ></a>
                     <a href="#" target="_blank" class="social"
                        ><i class="fab fa-google"></i
                     ></a>
                  </div>
                  <span>Or use your Email for registration</span>
                  <label>
                     <input type="text" placeholder="Name" name="uname" />
                  </label>
                  <label>
                     <input type="email" placeholder="Email" name="email" />
                  </label>
                  <label>
                     <input type="password" placeholder="Password" name="pass" />
                  </label>
                  <button type="submit" style="margin-top: 9px">Sign Up</button>
               </form>
            </div>
            <div class="form-container sign-in-container">
               <form action="#" method="POST">
                  <h1>Sign in</h1>
                  <div class="social-container">
                     <a href="#" target="_blank" class="social"
                        ><i class="fab fa-github"></i
                     ></a>
                     <a href="#" target="_blank" class="social"
                        ><i class="fab fa-codepen"></i
                     ></a>
                     <a href="#" target="_blank" class="social"
                        ><i class="fab fa-google"></i
                     ></a>
                  </div>
                  <span> Or sign in using E-Mail Address</span>
                  <label>
                     <input type="email" placeholder="Email" name="email" />
                  </label>
                  <label>
                     <input type="password" placeholder="Password" name="pass" />
                  </label>
                  <!-- <a href="#">Forgot your password?</a> -->
                  <button name="submit"  type="submit">Sign In</button>
               </form>
            </div>
            <div class="overlay-container">
               <div class="overlay">
                  <div class="overlay-panel overlay-left">
                     <h1>Log in</h1>
                     <p>Sign in here if you already have an account</p>
                     <button class="ghost mt-5" id="signIn">Sign In</button>
                  </div>
                  <div class="overlay-panel overlay-right">
                     <h1>Create, Account!</h1>
                     <p>Sign up if you still don't have an account ...</p>
                     <button class="ghost" id="signUp">Sign Up</button>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
      <script src="./loginscript.js
      "></script>
   </body>
</html>
