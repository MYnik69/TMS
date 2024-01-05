<?php
include('config/db.php');
session_start();
$invalidpassword = '';
$invaliduser     = '';
if (!isset($_SESSION['username'])) {


  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);





    if ($user) {
      if ($password == $user['password']) {
        //getting user role
        $role = $user['role'];
        $id  = $user['id'];
        if ($role == 1) {

          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $_SESSION['role'] = $role;
          $_SESSION['id'] = $id;

          header("Location:dashboard.php");
        } else if ($role == 2) {
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $_SESSION['role'] = $role;
          $_SESSION['id'] = $id;

          header("Location:dashboard.php");




          // echo "manager";
        } else {
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $_SESSION['role'] = $role;
          $_SESSION['id'] = $id;

          header("Location:dashboard.php");
        }
      } else {

        // echo 'password doesnot match';
        $invalidpassword = 'invalid password';
      }

      // echo $wrong_passowrd;
    } else {
      // echo "user doesnot match";
      $invaliduser     = 'invalid user';
    }
  }
} else {
  header("Location:dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="images/picture2.png" type="image/png">
  <link rel="shortcut icon" href="images/picture2.png" type="image/png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Login | PAGE</title>
</head>

<body>


  <div class="align">
    <nav class="navbar">
      <ul class="nav-list">
        <div class="logo">
          <img src="images/picture2.png" alt="" />
        </div>
      </ul>

      <div class="right-part-nav">
        <!-- <button class="btn">Sign up</button> -->
        <a class="" href="https://659778de2b119771ceef4711--elegant-taiyaki-62d5df.netlify.app/"><button class="btn">About us</button></a>

      </div>
    </nav>

    <section class="first">
      <div class="main">
        <div class="main-left">
          <img src="images/ofc.png" alt="" />
        </div>

        <div class="main-right">


          <form method="POST" class="login-form">
            <h1>LOGIN</h1>
            <div class="input-group">
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" required placeholder="Username" />
              <!-- Error message for invalid username -->
              <span class="error"><?php echo $invaliduser; ?></span>

            </div>
            <div class="input-group">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" required placeholder="Password" />
              <!-- Error message for invalid password -->
              <span class="error"><?php echo  $invalidpassword; ?></span>
            </div>
            <div class="input-group">
              <input type="submit" name="submit" class="submit" value="login">
            </div>
          </form>

        </div>
      </div>
    </section>
  </div>
</body>

</html>