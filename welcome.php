<?php
session_start();
include 'partials/dbconnect.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){
  header("location: login.php");
}

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - <?php echo $_SESSION['username']; ?></title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  
  <body>
    <!-- Require Php to get the Navbar -->
    <?php require 'partials/_nav.php' ?>

    <div class="container">
    <div class="alert alert-success my-3" role="alert">
      <h4 class="alert-heading">Welcome - <?php echo $_SESSION['username']; ?></h4>
      <p>Hey, How are you doing? You are Logged in as <?php echo $_SESSION['username']; ?>
      <hr>
      <p class="mb-0">Whenever you need to, be sure Logged out 
        <a href="/loginsystem/logout.php" class="btn btn-outline-danger">Logout</a>
      </p>
    </div>
    </div>
    <?php

      $query = "SELECT * FROM user";
      $run = mysqli_query($conn, $query);
      if($run){
        while($row=mysqli_fetch_assoc($run)){
          // echo $row['username'];
          ?>

        <div class="container mt-5">
          <h1 class="text-center"><ins>Users</ins></h1>
        <table class="table table-bordered text-center" style="border: 3px solid #aaa;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td><?php echo $row['username']; ?></td>
                  <td>Password are Encrypted</td>
                </tr>
              </tbody>
            </table>
            
          <?php
        }
      }

    ?>
        </div>

    <!-- JavaScript Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

  </body>
</html>