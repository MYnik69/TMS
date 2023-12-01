<?php
session_start();
// if(isset($_SESSION['uname'])){



// }else{
//   echo "<script> location.href='login.php'; </script>";

// }

?>



<?php
// session_start();//alerady in header.php
if (isset($_SESSION['username'])) {


  // echo "<script> alert('value is set: $use') </script>";

} else {
  echo "<script> location.href='login.php'; </script>";
}
if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  echo "<script> location.href='login.php'; </script>";
}

?>
<header class="flex">
  <div class="labell">
    <label style="color:black;">USER: <?php echo  $_SESSION['username'] ?></label>
  </div>
  <div class="logout">
    <div><img src="images/icon/logout.png" width="30px" style="margin-top: 10px;" alt=""></div>
    <form method="POST">
      <button class="nav-item logout" type="logout" value="logout" name="logout">Logout</button>
    </form>
  </div>

</header>


<nav>
  <ul>
    <li>
      <div class="branddd">
        <a href="#" class="logo">
          <img src="images/Picture2.png" alt="" />
          <?php
          if ($_SESSION['role'] == 1) : ?>
            <span class="ADMIN">ADMIN</span>
          <?php elseif ($_SESSION['role'] == 2) : ?>
            <span class="MANAGER" style="font-size: 26px;">MANAGER</span>
          <?php elseif ($_SESSION['role'] == 3) : ?>
            <span class="STAFF">STAFF</span>

          <?php endif ?>

        </a>
      </div>
    </li>
    <!-- **********************************Admin******************************************************** -->

    <?php if ($_SESSION['role'] == 1) : ?>
      <li>
        <a href="dashboard.php">
          <div class="link-list">
            <div> <img class="dashlogo" src="images/icon/dashboard.png" alt="" /></div>
            <div> <span>Dashboard</span></div>

          </div>
        </a>
      </li>
      <!-- creating TASKS -->
      <li>
        <a href="createtask.php" onclick="createTask()">
          <div class="link-list">
            <div> <img class="dashlogo" src="images/icon/create.png" alt="" /></div>
            <div> <span class="nav-item">CREATE TASKS</span></div>
          </div>
        </a>
      </li>

      <!-- view TASKS -->
      <li>
        <a href="viewtaskadmin.php">
          <div class="link-list">
            <div>
              <img class="dashlogo" src="images/icon/prioritize1.png" alt="" />
            </div>
            <div>
              <span class="nav-item">view TASKS</span>
            </div>
          </div>
        </a>
      </li>

      <li>
        <a href="adduser.php" onclick="">
          <div class="link-list">
            <div> <img class="dashlogo" src="images/icon/adduser.png" alt="" /></div>
            <div> <span>ADD-Users</span></div>
          </div>
        </a>
      </li>

      <li>
        <a href="listuser.php" onclick="">
          <div class="link-list">
            <div>
              <img class="dashlogo" src="images/icon/shortlist.png" alt="" />
            </div>
            <div>
              <span class="nav-item">list-Users</span>
            </div>
          </div>
        </a>
      </li>

      <li>
        <a href="notice.php" onclick="">
          <div class="link-list">
            <div>
              <img class="dashlogo" src="images/icon/leave.png" alt="" />
            </div>
            <div>
              <span class="nav-item">Notes</span>
            </div>
          </div>
        </a>
      </li>


      <li>
        <a href="sendnotice.php" onclick="">
          <div class="link-list">
            <div>
              <img class="dashlogo" src="images/icon/note.png" alt="" />
            </div>
            <div>

              <span class="nav-item">Send Notes</span>
            </div>
          </div>
        </a>
      </li>


      <!-- ***********************************************Manager************************************************** -->
    <?php elseif ($_SESSION['role'] == 2) : ?>


      <li>
        <a href="dashboard.php">
          <div class="link-list">
            <div> <img class="dashlogo" src="images/icon/dashboard.png" alt="" /></div>
            <div> <span>Dashboard</span></div>

          </div>
        </a>
      </li>




      <li>
        <a href="viewtaskadmin.php">
          <div class="link-list">
            <div>
              <img class="dashlogo" src="images/icon/prioritize1.png" alt="" />
            </div>
            <div>
              <span class="nav-item">view TASKS</span>
            </div>
          </div>
        </a>
      </li>

      <li>
        <a href="createtask.php" onclick="createTask()">
          <div class="link-list">
            <div> <img class="dashlogo" src="images/icon/create.png" alt="" /></div>
            <div> <span class="nav-item">CREATE TASKS</span></div>
          </div>
        </a>
      </li>


      <li>
        <a href="listuser.php" onclick="">
          <div class="link-list">
            <div>
              <img class="dashlogo" src="images/icon/shortlist.png" alt="" />
            </div>
            <div>
              <span class="nav-item">list-Users</span>
            </div>
          </div>
        </a>
      </li>

      <li>
        <a href="notice.php" onclick="">
          <div class="link-list">
            <div>
              <img class="dashlogo" src="images/icon/leave.png" alt="" />
            </div>
            <div>
              <span class="nav-item">Notes</span>
            </div>
          </div>
        </a>
      </li>


      <li>
        <a href="sendnotice.php" onclick="">
          <div class="link-list">
            <div>
              <img class="dashlogo" src="images/icon/note.png" alt="" />
            </div>
            <div>

              <span class="nav-item">Send Notes</span>
            </div>
          </div>
        </a>
      </li>

      <!-- *****************************Staff******************************************************** -->
    <?php elseif ($_SESSION['role'] == 3) : ?>
      <li>
        <a href="dashboard.php">
          <img class="dashlogo" src="images/icon/dashboard.png" alt="" />
          <span class="nav-item">DASHBOARD</span>
        </a>
      </li>
      <li>
        <a href="viewtask.php">
          <img class="dashlogo" src="images/icon/prioritize1.png" alt="" />
          <span class="nav-item">view TASKS</span>
        </a>
      </li>
      <li>
        <a href="notice.php" onclick="">
          <img class="dashlogo" src="images/icon/leave.png" alt="" />
          <span class="nav-item">Notice</span>
        </a>
      </li>

      <div class="hide">
        <label>Role: <?php echo  $_SESSION['role'] ?></label>
        <label style="color: brown;">userid: <?php echo  $_SESSION['id'] ?></label>
      </div>

    <?php endif ?>



  </ul>







</nav>