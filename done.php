
<?php

include('config/db.php');
$update_id = $_POST["userid"];
echo $update_id;
// echo $userid;
$querys = "UPDATE tasks SET
  status = 'completed'
  WHERE task_id= $update_id";
echo $querys;

if (mysqli_query($conn, $querys)) {
    header("location:viewtask.php");
} else {
    echo 'error' . mysqli_error($conn);
}
s