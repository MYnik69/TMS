<?php
include('config/db.php');

$queryTasks = "SELECT COUNT(*) AS totalTasks FROM tasks";
$resultTasks = mysqli_query($conn, $queryTasks);
$rowTasks = mysqli_fetch_assoc($resultTasks);
$totalTasks = $rowTasks['totalTasks'];

$queryincompletetask = "SELECT COUNT(*) As incompletetask FROM tasks WHERE status = 'pending' OR status = 'in_progress'";
$resultincompletetask = mysqli_query($conn, $queryincompletetask);
$rowincompletetask = mysqli_fetch_array($resultincompletetask);
$totalincompletetask = $rowincompletetask['incompletetask'];


$querycompletetask = "SELECT COUNT(*) AS completedtask FROM tasks WHERE status = 'completed'";
$resultcompletetask = mysqli_query($conn, $querycompletetask);
$rowcompletetask = mysqli_fetch_array($resultcompletetask);
$totalcompletetask = $rowcompletetask['completedtask'];




$queryStaffs = "SELECT COUNT(*) AS totalStaffs FROM users WHERE role = 3";
$resultStaffs = mysqli_query($conn, $queryStaffs);
$rowStaffs = mysqli_fetch_assoc($resultStaffs);
$totalStaffs = $rowStaffs['totalStaffs'];

$queryNotices = "SELECT COUNT(*) AS totalNotices FROM notices";
$resultNotices = mysqli_query($conn, $queryNotices);
$rowNotices = mysqli_fetch_assoc($resultNotices);
$totalNotices = $rowNotices['totalNotices'];

$queryUsers = "SELECT COUNT(*) AS totalUsers FROM users";
$resultUsers = mysqli_query($conn, $queryUsers);
$rowUsers = mysqli_fetch_assoc($resultUsers);
$totalUsers = $rowUsers['totalUsers'];


$query = "SELECT * FROM users";

$result = mysqli_query($conn, $query);

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

  <meta charset="UTF-8" />
  <link rel="icon" href="images/picture2.png" type="image/png">
  <link rel="shortcut icon" href="images/picture2.png" type="image/png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styledash.css" />
  <link rel="stylesheet" href="responsive.css" />
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="swiper/swiper-bundle.min.css" />

  <style>
    .swiper-wrapper {
      margin-left: 15px !important;
    }
  </style>

  <title>Dashbord</title>
</head>

<body>
  <?php
  include('inc/header.php');
  ?>

  <div class="container">
    <div class="swiper mySwiper1">
      <div class="slide-container swiper-wrapper">
        <?php foreach ($users as $user) : ?>
          <div class="card swiper-slide">
            <div class="employee">
              <img class="e-logo" src="uploads/<?php echo $user["profilepic"]; ?>" alt="Employee Image" style=" object-position: center;" />
              <div class="e-text">
                <h2 class="employee-name">
                  <?php echo $user["firstname"] . " " . $user["lastname"]; ?>
                </h2>
                <h3 class="employee-post">
                  <?php
                  $role = $user["role"];
                  switch ($role) {
                    case 1:
                      echo "Admin";
                      break;
                    case 2:
                      echo "Manager";
                      break;
                    case 3:
                      echo "Staff";
                      break;
                    default:
                      echo "Unknown";
                      break;
                  }
                  ?>
                </h3>
              </div>
            </div>
            <div class="e-description">
              <p>
                <?php echo $user["description"]; ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- ***************************************************************************************************************** -->

    <!-- FOr admin and managers -->
    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) : ?>

      <div class="bottom-dash">

        <div class="dash-left">
          <div class="total">

            <div class="total-card">
              <div class="total-logo">
                <img src="images/icon/check-list.png" width="90px" alt="" />
              </div>
              <div class="task-bottom">
                <div class="total-title">
                  <h5>Totall Tasks</h5>
                </div>

                <div class="total-tasks">
                  <h1><?php echo $totalTasks; ?></h1>
                </div>
              </div>
            </div>


          </div>
          <div class="total">
            <div class="total-card">
              <div class="total-logo">
                <img src="images/icon/engineers.png" width="90px" alt="" />
              </div>
              <div class="task-bottom">
                <div class="total-title">
                  <h5>Total Staffs</h5>
                </div>

                <div class="total-tasks">
                  <h1><?php echo $totalStaffs; ?></h1>
                </div>
              </div>
            </div>
          </div>

          <div class="total">

            <div class="total-card">
              <div class="total-logo">
                <img src="images/icon/announcement.png" width="90px" alt="" />
              </div>
              <div class="task-bottom">
                <div class="total-title">
                  <h5>Notices</h5>
                </div>

                <div class="total-tasks">
                  <h1><?php echo $totalNotices; ?></h1>
                </div>
              </div>
            </div>
          </div>

          <div class="total">

            <div class="total-card">
              <div class="total-logo">
                <img src="images/icon/shortlist.png" width="90px" alt="" />
              </div>
              <div class="task-bottom">
                <div class="total-title">
                  <h5>Total Users</h5>
                </div>

                <div class="total-tasks">
                  <h1><?php echo $totalUsers; ?></h1>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="dash-right">
          <div class="graph">
            <div>
              <canvas id="myChart" style="width: 500px; height: 370px"></canvas>
            </div>

            <div>
              <h3 style="text-align: center; margin-top: 20px">
                Task Status
              </h3>
            </div>

            <script>
              const xValues = ["Pending-tasks", "Completed-tasks"];
              const yValues = [<?php echo $totalincompletetask; ?>, <?php echo $totalcompletetask; ?>];
              const barColors = ["#b91d47", "#00aba9"];

              new Chart("myChart", {
                type: "pie",
                data: {
                  labels: xValues,
                  datasets: [{
                    backgroundColor: barColors,
                    data: yValues,
                  }, ],
                },
                options: {
                  legend: {
                    position: "top",
                    align: "end",
                  },
                },
              });
            </script>
          </div>
        </div>
      </div>
      <div class="dashbottom">
        <div class="logo-slides">

          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />
          <img src="images/khalti.png" width="400px" alt="" />


        </div>


      </div>

    <?php else : ?>
      <!-- for staff here  -->
      <?php
      // $queryTasks = "SELECT COUNT(*) AS totalTasks FROM tasks";
      // $resultTasks = mysqli_query($conn, $queryTasks);
      // $rowTasks = mysqli_fetch_assoc($resultTasks);
      // $totalTasks = $rowTasks['totalTasks'];

      $user_id = $_SESSION['id'];
      $queryuserstotaltask = "SELECT COUNT(*) AS usertotaltask from tasks WHERE user_id  = $user_id";
      $resultuserstasks = mysqli_query($conn, $queryuserstotaltask);
      $rowuserstasks = mysqli_fetch_array($resultuserstasks);
      $totalusertasks = $rowuserstasks['usertotaltask'];

      // $queryuserincompletetask = "SELECT COUNT(*) As incompletetask FROM tasks WHERE status = 'pending' OR status = 'in_progress'";
      $queryuserincompletetask = "SELECT COUNT(*) AS incompletetask FROM tasks WHERE (status = 'pending' OR status = 'in_progress') AND user_id = $user_id";
      $resultuserincompletetask = mysqli_query($conn, $queryuserincompletetask);
      $rowuserincompletetask = mysqli_fetch_array($resultuserincompletetask);
      $totaluserincompletetask = $rowuserincompletetask['incompletetask'];
      // echo $rowincompletetask;

      $queryusercompletetask = "SELECT COUNT(*) AS completedtask FROM tasks WHERE status = 'completed' AND user_id = $user_id";
      $resultusercompletetask = mysqli_query($conn, $queryusercompletetask);
      $rowusercompletetask = mysqli_fetch_array($resultusercompletetask);
      $totalusercompletetask = $rowusercompletetask['completedtask'];
      // echo $rowincompletetask;

      ?>

      <div class="bottom-dash">

        <div class="dash-left">
          <div class="total">

            <div class="total-card">
              <div class="total-logo">
                <img src="images/icon/check-list.png" width="90px" alt="" />
              </div>
              <div class="task-bottom">
                <div class="total-title">
                  <h5>Total Tasks</h5>
                </div>

                <div class="total-tasks">

                  <h1><?php echo $totalusertasks; ?></h1>
                </div>
              </div>
            </div>


          </div>
          <div class="total">
            <div class="total-card">
              <div class="total-logo">
                <img src="images/icon/engineers.png" width="90px" alt="" />
              </div>
              <div class="task-bottom">
                <div class="total-title">
                  <h5>Remanning task</h5>
                </div>

                <div class="total-tasks">
                  <h1><?php echo $totaluserincompletetask; ?></h1>
                </div>
              </div>
            </div>
          </div>

          <div class="total">

            <div class="total-card">
              <div class="total-logo">
                <img src="images/icon/announcement.png" width="90px" alt="" />
              </div>
              <div class="task-bottom">
                <div class="total-title">
                  <h5>Notices</h5>
                </div>

                <div class="total-tasks">
                  <h1><?php echo $totalNotices; ?></h1>
                </div>
              </div>
            </div>
          </div>

          <div class="total">

            <div class="total-card">
              <div class="total-logo">
                <img src="images/icon/shortlist.png" width="90px" alt="" />
              </div>
              <div class="task-bottom">
                <div class="total-title">
                  <h5>Completed Tasks</h5>
                </div>

                <div class="total-tasks">
                  <h1><?php echo $totalusercompletetask; ?></h1>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="dash-right">
          <div class="graph">
            <div>
              <canvas id="myChart" style="width: 500px; height: 370px"></canvas>
            </div>

            <div>
              <h3 style="text-align: center; margin-top: 20px">
                Task Status
              </h3>
            </div>

            <script>
              const xValues = ["Pending-tasks", "Completed-tasks"];
              const yValues = [<?php echo $totaluserincompletetask; ?>, <?php echo $totalusercompletetask; ?>];
              const barColors = ["#b91d47", "#00aba9"];

              new Chart("myChart", {
                type: "pie",
                data: {
                  labels: xValues,
                  datasets: [{
                    backgroundColor: barColors,
                    data: yValues,
                  }, ],
                },
                options: {
                  legend: {
                    position: "top",
                    align: "end",
                  },
                },
              });
            </script>
          </div>
        </div>

      </div>

    <?php endif ?>
  </div>

  <!-- Swiper JS -->
  <script src="swiper/swiper-bundle.min.js"></script>
  <script>
    var swiper1 = new Swiper(".mySwiper1", {
      slidesPerView: getSlidesPerView(),
      spaceBetween: 30,
      loop: true, // Enable continuous loop
      centeredSlides: true, // Enable centered slides during loop
      loopAdditionalSlides: 3, // Number of additional slides for continuous looping
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      autoplay: {
        delay: 2000, // Delay between slides in milliseconds (2 seconds)
        disableOnInteraction: false, // Enable navigation buttons and pagination while autoplaying
      },
    });


    function getSlidesPerView() {
      if (window.innerWidth <= 800) {
        return 1;
      } else if (window.innerWidth <= 1112) {
        return 2;
      } else {
        return 3;
      }
    }

    window.addEventListener("resize", function() {
      swiper1.params.slidesPerView = getSlidesPerView();
      swiper1.update();
    });
  </script>
</body>

</html>