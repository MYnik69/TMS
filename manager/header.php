<?php
session_start();


?>



<?php

if (isset($_SESSION['username'])) {
  $use = $_SESSION['username'];
} else {
  echo "<script> location.href='login.php'; </script>";
}
if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  echo "<script> location.href='login.php'; </script>";
}

?>
<header class="headerr">
  <label>USER: <?php echo  $_SESSION['username'] ?></label>
</header>

<nav>
  <ul>
    <li>
      <a href="#" class="logo">
        <img src="../images/Picture2.png" alt="" />
        <span class="ADMIN">Manager</span>
      </a>
    </li>

    <li>
      <a href="dashboard.php" onclick="Opensection('main-dashboard')">
        <img class="dashlogo" src="../images/icon/dashboard.png" alt="" />
        <span class="nav-item">DASHBOARD</span>
      </a>
    </li>
    <!-- creating TASKS -->
    <li>
      <a href="createtask.php" onclick="createTask()">
        <img class="dashlogo" src="../images/icon/update.png" alt="" />
        <span class="nav-item">CREATE TASKS</span>
      </a>
    </li>

    <!-- view TASKS -->
    <li>
      <a href="viewtask.php" onclick="viewTask()">
        <img class="dashlogo" src="images/icon/update.png" alt="" />
        <span class="nav-item">view TASKS</span>
      </a>
    </li>

    <li>
      <a href="adduser.php" onclick="">
        <img class="dashlogo" src="images/icon/update.png" alt="" />
        <span class="nav-item">ADD-Users</span>
      </a>
    </li>
    <li>
      <a href="listuser.php" onclick="">
        <img class="dashlogo" src="images/icon/update.png" alt="" />
        <span class="nav-item">list-Users</span>
      </a>
    </li>
    <li>
      <a href="#" class="logout">
        <form method="POST">
          <input type="submit" value="logout" name="logout"><label></label>
        </form>

        </span>
      </a>
    </li>
  </ul>
</nav>