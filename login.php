<?php
$login = false;
$showError = false;
//Using $_SERVER Super Golbal variable to getting Data 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
  //Making Variable to get Data From Database
    $username = $_POST['username'];
    $password = $_POST['password'];
      //Write a query to insert data in database
      // $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
      $sql = "SELECT * FROM user WHERE username='$username'";
      $result = mysqli_query($conn, $sql);
      //Checking if query is wrong then code give me a error in my screen.
      if (!$result) {
          die("Error in SQL query: " . mysqli_error($conn));
      }
      //Getting Information
      $num = mysqli_num_rows($result);
      //Check Data with the help of (if) condition
      if($num == 1){
        //hum aik variable row name sy bannyn gay or uss main sara table ka data fetch krien gay
          while($row = mysqli_fetch_assoc($result)){
            //aggar user apna password correct enter karta hay to then wo login hojayye otherwise Invalid username or Password aik Function hota hay password_verify() jo check kart hay user k Password ko
            if(password_verify($password, $row['password'])){
              $login = true;
              //Start a Session And Also Make a Session 
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['username']= $username;
              header("location: welcome.php");
            }
            else{
              $showError = "Invalid Username or Password.";
            }
          }
      }
      else{
        $showError = "Invalid Username or Password.";
      }

}

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  
  <body>
    <!-- Require Php to get the Navbar -->
    <?php require 'partials/_nav.php'; ?>
    
    <?php
    if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>SuccessFully!</strong> Your are logged in.
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
        <h1 class="text-center">Login to Our Website</h1>
        <form action="/loginsystem/login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <!-- JavaScript Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

  </body>
</html>