<?php
$showAlert = false;
$showError = false;
//Using $_SERVER Super Golbal variable to getting Data 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
  //Making Variable to get Data From Database
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // $exists = false;

    //Check Whether this username exists
    $existSql = "SELECT * FROM `user` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    //For Existing username
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
      // $exists = true;
      $showError = "Username Already Exits Please Choose Different Username.";
    }
    else{
        //$exists = false;
      if(($password == $cpassword)){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        //Write a query to insert data in database
        $sql = "INSERT INTO `user`(`username`, `password`, `date`) VALUES ('$username','$hash', current_timestamp())";
        //Run Query
        $result = mysqli_query($conn, $sql);
        if($result){
          $showAlert = true;
        }
      }
      else{
        $showError = "Passwords do not Match.";
      }
    }
}

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  
  <body>
    <!-- Require Php to get the Navbar -->
    <?php require 'partials/_nav.php'; ?>
    
    <?php
    if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>SuccessFully!</strong> Your account is now created and you can login.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              </button>
          </div>';
        }
    ?>
    <?php
    if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $showError . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              </button>
          </div>';
        }
    ?>
    <div class="container my-4">
        <h1 class="text-center">Signup to Our Website</h1>
        <form action="/loginsystem/signup.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" maxlength="11" aria-describedby="emailHelp" placeholder="Enter Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"  placeholder="Enter Password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter Confirm Password">
                <div id="emailHelp" class="form-text">Make sure to Confirm the Same Password</div>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    <!-- JavaScript Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

  </body>
</html>