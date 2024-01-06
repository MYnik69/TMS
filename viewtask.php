<!-- view task -->
<?php
require "config/db.php";

//fetch query

$query = "SELECT *FROM tasks ORDER BY created_at DESC ";

$result = mysqli_query($conn, $query);

$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="images/picture2.png" type="image/png">
  <link rel="shortcut icon" href="images/picture2.png" type="image/png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styledash.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="swiper avoid/swiper-bundle.min.css" />
  <link rel="stylesheet" href="responsive.css">
  <script src="swiper avoid/swiper-bundle.min.js"></script>
  <title>Dashbord</title>
</head>

<body>

  <?php include "inc/header.php"; ?>

  <div class="container">

    <section class="dashviewtask">

      <div class="sort-buttons">
        <button class="button-small" id="sort-high">High Priority</button>
        <button class="button-small" id="sort-medium">Medium Priority</button>
        <button class="button-small" id="sort-low">Low Priority</button>
        <button class="button-small" id="sort-all">All Tasks</button>
      </div>




      <section class="tasks">
        <!-- ******************************** -->
        <?php foreach ($tasks as $task) : ?>



          <?php if ($task['user_id'] == $_SESSION['id']) : ?>



            <div class="t-card ">
              <div class="task-left-right">
                <div class="card-left">
                  <div class="task-title">


                    <div class="task-heading">
                      <div class="heading-icon">
                        <img src="images/icon/circle-solid-24.png" width="20px" alt="right.png">
                      </div>
                      <div class="heading-text">
                        <h2 class="task-no"><?php echo $task["title"]; ?></h2>
                        <span class="issue-date"><?php echo date('Y-m-d', strtotime($task['created_at'])); ?>,<?php echo date('H:i:s', strtotime($task['created_at'])); ?></span>

                      </div>
                    </div>

                    <div>

                    </div>




                    <div class="task-description">
                      <p><?php echo $task["description"]; ?></p>
                    </div>





                    <div class="task-status">
                      <span class="task-progress"><?php echo $task['status']; ?></span>
                    </div>

                  </div>
                </div>

                <div class="task-right">
                  <div class="task-assigned-employee "><img src="images/icon/user-logo.png" alt="logo" width="30"> <span>
                      <?php echo $task["user_id"]; ?></span> </div>

                  <?php
                  // if ($task['status'] == 'pending') {
                  //   echo ' <div class="task-button">
                  // <!-- <button class="btn-primary">Accept task</button> -->
                  // <form method="post" action="modifytask.php">
                  // <input name="userid" type="hidden" value="' . $task["task_id"] . '">
                  // <input class="btn-primary" type="submit" value="Accept task" id="" name="accept">
                  // </form>
                  // </div>';
                  // } else if ($task['status'] == 'in_progress') {
                  //   echo '  <div class="task-button">
                  // <!-- <button class="btn-primary">Accept task</button> -->
                  // <input class="btn-primary"type="submit" value="Done" id="" name="done">
                  // </div>';
                  // } else {
                  //   echo "TASK COMPLETED";
                  // }
                  ?>

                  <?php if ($task['status'] == 'pending') : ?>
                    <div class="task-button">
                      <!-- <button class="btn-primary">Accept task</button> -->
                      <form method="post" action="modifytask.php">
                        <input name="userid" type="hidden" value="<?= $task["task_id"] ?>">
                        <input class="btn-primary" type="submit" value="Accept task" id="" name="accept">
                      </form>
                    </div>
                  <?php elseif ($task['status'] == 'in_progress') : ?>
                    <div class="task-button">
                      <!-- <button class="btn-primary">Accept task</button> -->
                      <form method="post" action="done.php">
                        <input name="userid" type="hidden" value="<?= $task["task_id"] ?>">
                        <input class="btn-primary" type="submit" value="Done" id="" name="done  ">
                      </form>
                    </div>
                  <?php else : ?>
                    TASK COMPLETED
                  <?php endif; ?>

                  <!-- ************************************** -->






                  <div class="task-priority">
                    <h2 class="task-no" id="priority"><?php echo $task["task_priority"]; ?></h2>
                  </div>

                </div>


              </div>
              <?php if ($task['status'] == 'in_progress' || $task['status'] == 'pending') : ?>
                <div class="bottom-card">
                  <div class="remaining-time" data-start-date="<?php echo $task['created_at']; ?>" data-end-date="<?php echo $task['due_date']; ?>"></div>
                </div>

              <?php else : ?>
                <div class="bottom-card">

                  TASK COMPLETED
                </div>

              <?php endif; ?>


            </div>


          <?php endif ?>

        <?php endforeach; ?>


      </section>


    </section>

    <!-- ************************************************************************************************************************************************************* -->








</body>

<script>
  var currenttime = new Date();
  console.log(currenttime);

  var remainingTimeELements = document.getElementsByClassName("remaining-time");
  var gettaskbutton = document.getElementsByClassName('task-button');

  function updateRemainingTime() {
    var now = new Date();
    // console.log(now);
    for (var i = 0; i < remainingTimeELements.length; i++) {

      var startDate = new Date(remainingTimeELements[i].dataset.startDate);

      var endDate = new Date(remainingTimeELements[i].dataset.endDate);
      var remainingTime = endDate - now;
      console.log(remainingTime);
      if (remainingTime > 0) {


        var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

        remainingTimeELements[i].innerHTML = "Remaining Time: " + days + "d " + hours + "h " + minutes + "m " + seconds + "s";
      } else {
        gettaskbutton[i].style.display = 'none';
        remainingTimeELements[i].innerHTML = "Time's Up!";

      }
    }
  }

  setInterval(updateRemainingTime, 1000);
  updateRemainingTime();



  var taskBlocks = document.getElementsByClassName('t-card');
  for (var i = 0; i < taskBlocks.length; i++) {
    var taskBlock = taskBlocks[i];
    // var priority = taskBlock.getElementById('priority').textContent;
    var priority = taskBlock.querySelector('#priority').textContent;

    switch (priority) {
      case '1':
        taskBlock.classList.add('low-priority');
        break;
      case '2':
        taskBlock.classList.add('medium-priority');
        break;
      case '3':
        taskBlock.classList.add('high-priority');
        break;
      default:
        break;
    }
  }

  // taskBlocks.classList.add('task-blockrt');



  console.log(priority);


  function showAllTasks() {
    for (var i = 0; i < taskBlocks.length; i++) {
      var taskBlock = taskBlocks[i];
      taskBlock.style.display = 'flex';
    }
  }


  function sortTasksByPriority(priority) {
    for (var i = 0; i < taskBlocks.length; i++) {
      var taskBlock = taskBlocks[i];
      var taskPriority = taskBlock.querySelector('#priority').textContent;

      if (taskPriority === priority) {
        taskBlock.style.display = 'flex';
      } else {
        taskBlock.style.display = 'none';
      }
    }
  }

  var sortHighButton = document.getElementById('sort-high');
  sortHighButton.addEventListener('click', function() {
    sortTasksByPriority('3');
  });

  var sortMediumButton = document.getElementById('sort-medium');
  sortMediumButton.addEventListener('click', function() {
    sortTasksByPriority('2');
  });

  var sortLowButton = document.getElementById('sort-low');
  sortLowButton.addEventListener('click', function() {
    sortTasksByPriority('1');
  });

  var sortAllButton = document.getElementById('sort-all');
  sortAllButton.addEventListener('click', function() {
    showAllTasks();
  });

  // document.addEventListener("DOMContentLoaded", function() {
  //   var swiper = new Swiper(".mySwiper", {
  //     direction: "vertical",
  //     slidesPerView: "5",
  //     spaceBetween: 10,
  //     scrollbar: {
  //       el: ".swiper-scrollbar",
  //       draggable: true,
  //     },
  //   });
  // });

  //   function changeButton(button) {
  //   button.innerHTML = "Submit";
  //   button.onclick = function() {
  //     submitForm();
  //     admindashboard();
  //   };
  // }

  // function submitForm() {
  //   alert("Form submitted!");
  //   //submit ko kaam haru garneh
  // }

  // function AdminDashboard() {
  //   // task accept admin dashboard maaa dekhauneh
  // }
</script>

<!-- Swiper JS -->

<!-- <script src="swiper/swiper-bundle.min.js"></script> -->
<!-- <script src="js/jquery-3.7.0.min.js"></script>
<script src="js/index.js"></script>
<script src="ajax/ajax.js"></script> -->

<!-- Initialize Swiper -->


</html>