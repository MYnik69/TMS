<?php include('config/db.php'); ?>
<?php 
$id= $_GET['editid'];
// echo $id;
 $selectuser = "SELECT *FROM users where id =$id";
 $results = mysqli_query($conn,$selectuser);
$userdetails = mysqli_fetch_assoc($results);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styledash.css" />
  <link rel="stylesheet" href="responsive.css" />
  <title>Dashboard</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php include('inc/header.php'); ?>

  <div class="container">
    <div class="adduser-form">
      <form method="post"  onsubmit="return validation()" enctype="multipart/form-data">
      <h1 style="text-align: center;">Update users</h1>


        <div class="inputflex align">
          <div class="input-group">
            <label for="fname">First name</label>
            <input id="fname" value="<?php echo $userdetails['firstname'] ?>" name="fname" type="text" />
            <span class="errors" id="name"></span>
          </div>

          <div class="input-group">
            <label for="lastname">Last name</label>
            <input id="lastname" value="<?php echo $userdetails['lastname'] ?>"  name="lastname" type="text" />
            <span class="errors" id="slname"></span>
          </div>

          <div class="input-group">
            <label for="username">Username</label>
            <input id="username" value="<?php echo $userdetails['username'] ?>"  name="username" type="text" />
            <span class="errors" id="susername"></span>
          </div>



        </div>

        <div class="inputflex align">
          <div class="input-group">
            <label for="email">Email</label>
            <input id="email" name="email" value="<?php echo $userdetails['email'] ?>"  type="email" />
            <span class="errors" id="semail"></span>
          </div>

          <div class="input-group">
            <label for="password">Change Password</label>
            <input id="password"  value="<?php echo $userdetails['password'] ?>"  name="password"  type="password" />
            <span class="errors" id="spassword"></span>
          </div>

          <div class="input-group">
            <label for="repassword">Retype Password</label>
            <input id="repassword" value="<?php echo $userdetails['password'] ?>"  name="rpassword" type="password" />
            <span class="errors" id="srepassword"></span>
          </div>



        </div>

        <div class="inputflex">
          <div class="input-group">
            <label for="profile-pic">Profile Picture :</label>
            <input id="profile-pic"  value="<?php echo $userdetails['profilepic'] ?>"  name="profile-pic" type="file" accept=".jpg, .png" placeholder="" />
          </div>

          <div>
            <label for="">Register as </label>
            <select name="role" id="">
              <option value="3">staff</option>
              <option value="2">Manager</option>
              <option value="1">admin</option>
            </select>
          </div>


          <div class="input-group">
            <label for="pnumber">Phone Number</label>
            <input id="pnumber" value="<?php echo $userdetails['phonenumber'] ?>"  name="pnumber" type="text" />
            <span class="errors" id="sphonenumber"></span>
          </div>
        </div>

        <div class="input-group">
          <label for="description">Employee Description</label>
          <textarea id="description"   name="description" placeholder="">
          <?php echo $userdetails['description'] ?>"
          </textarea>
        </div>

        <input type="submit" name="submit" value="Update" />
      </form>
    </div>
  </div>

  <script>
    function validation() {
      var fname = document.getElementById("fname").value;
      var lastname = document.getElementById("lastname").value;
      var username = document.getElementById("username").value;
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      var rpassword = document.getElementById("repassword").value;
      var phonenumber = document.getElementById("pnumber").value;

      if (fname === "") {
        document.getElementById("name").innerHTML = "Please fill the username field";
        return false;
      }

      if (!isNaN(fname)) {
        document.getElementById("name").innerHTML = "Only characters are allowed";
        return false;
      }

      if (fname.length <= 2 || fname.length > 20) {
        document.getElementById("name").innerHTML = "Username should be between 2 and 20 characters";
        return false;
      }

      if (lastname === "") {
        document.getElementById("slname").innerHTML = "Please fill the lastname field";
        return false;
      }

      if (username === "") {
        document.getElementById("susername").innerHTML = "Please fill the username field";
        return false;
      }

      if (email === "") {
        document.getElementById("semail").innerHTML = "Please fill the email field";
        return false;
      }

      if (email.indexOf("@") <= 0) {
        document.getElementById("semail").innerHTML = "Invalid @ position";
        return false;
      }

      if (email.charAt(email.length - 4) !== "." && email.charAt(email.length - 3) !== ".") {
        document.getElementById("semail").innerHTML = "Invalid . positions";
        return false;
      }

      if (password === "") {
        document.getElementById("spassword").innerHTML = "Please fill the password field";
        return false;
      }

      if (password.length <= 5 || password.length > 20) {
        document.getElementById("spassword").innerHTML = "Password should be between 6 and 20 characters";
        return false;
      }

      if (rpassword === "") {
        document.getElementById("srepassword").innerHTML = "Please fill the retype password field";
        return false;
      }

      if (password !== rpassword) {
        document.getElementById("srepassword").innerHTML = "Passwords do not match";
        return false;
      }

      if (phonenumber === "") {
        document.getElementById("sphonenumber").innerHTML = "Please fill the phone field";
        return false;
      }

      if (isNaN(phonenumber)) {
        document.getElementById("sphonenumber").innerHTML = "User must write digits";
        return false;
      }

      if (phonenumber.length !== 10) {
        document.getElementById("sphonenumber").innerHTML = "Number must be 10 digits";
        return false;
      }
    }
  </script>
</body>

</html>



<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $errors = [];

  $fname = $_POST['fname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $password = $_POST['password'];
  $rpassword = $_POST['rpassword'];
  $phonenumber = $_POST['pnumber'];
  $description = $_POST['description'];


  //   $querysql = "SELECT * FROM users where (username = '$username') ";
  //   $usernamequery = mysqli_query($conn,$querysql);
  //   if (mysqli_num_rows($usernamequery) > 0) {
  //     // echo "USER NAME ALREADYS EXIST";
  //     $errors['username'] = 'USER NAME ALREADYS EXIST';

  //   }

  // Validate first name
  if (empty($fname)) {
    $errors['fname'] = 'Please fill in the first name field.';
  }

  // Validate last name
  if (empty($lastname)) {
    $errors['lastname'] = 'Please fill in the last name field.';
  }

  // Validate username
  if (empty($username)) {
    $errors['username'] = 'Please fill in the username field.';
  }

  // Validate email
  if (empty($email)) {
    $errors['email'] = 'Please fill in the email field.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format.';
  }

  // Validate password
  if (empty($password)) {
    $errors['password'] = 'Please fill in the password field.';
  } elseif (strlen($password) < 6 || strlen($password) > 20) {
    $errors['password'] = 'Password should be between 6 and 20 characters.';
  }

  // Validate retype password
  if (empty($rpassword)) {
    $errors['rpassword'] = 'Please fill in the retype password field.';
  } elseif ($password !== $rpassword) {
    $errors['rpassword'] = 'Passwords do not match.';
  }

  // Validate phone number
  if (empty($phonenumber)) {
    $errors['pnumber'] = 'Please fill in the phone number field.';
  } elseif (!preg_match('/^[0-9]{10}$/', $phonenumber)) {
    $errors['pnumber'] = 'Phone number should be 10 digits.';
  }

  // Process profile picture upload
  $profilepic = '';
  if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] === 0) {
    $targetDir = 'uploads/';
    $targetFile = $targetDir . basename($_FILES['profile-pic']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate file type
    if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
      $errors['profile-pic'] = 'Only JPG, JPEG, PNG, and GIF files are allowed.';
    } elseif (!move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetFile)) {
      $errors['profile-pic'] = 'Error uploading the profile picture.';
    } else {
      $profilepic = $_FILES['profile-pic']['name'];
    }
  }

  // If there are no validation errors and profile picture was uploaded successfully, proceed with further processing
  if (empty($errors)) {
    
    
    $query = "UPDATE users SET
    firstname ='$fname',
    lastname = '$lastname', 
    username = '$username',
    email = '$email',
    role = '$role ',
    password = '$password',
    phonenumber = '$phonenumber',
    description = '$description'
    where id = $id ";
    if (mysqli_query($conn, $query)) {
      // echo 'Form submitted successfully!';
      // header('location:listuser.php');
      echo "<script>alert('User Update Sucessfull!!!')</script>";
      echo " <script>window.location.href = 'listuser.php'</script>";
    } else {
      echo 'Error: ' . mysqli_error($conn);
    }
  } else {

    foreach ($errors as $error) {
      echo $error . '<br />';
    }
  }
}

// mysqli_close($conn);
?>