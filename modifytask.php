
<?php

include('config/db.php');
if (isset($_POST['accept'])) {
  $update_id = $_POST["userid"];
  echo $update_id;
  // echo $userid;
  $querys = "UPDATE tasks SET
  status = 'in_progress'
  WHERE task_id= $update_id";
  echo $querys;

  if (mysqli_query($conn, $querys)) {
    header("location:viewtask.php");
  } else {
    echo 'error' . mysqli_error($conn);
  }
}



// echo "this";
