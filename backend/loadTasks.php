<?php 
  require_once 'connect.php';

  session_start();

  $stmt = mysqli_prepare($connect, "SELECT `id`, `task_text` FROM `task` WHERE `user_id`= ?");
  mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  $tasks = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $tasks[] = $row;
  } 

  echo json_encode($tasks);

  mysqli_stmt_close($stmt);
  mysqli_close($connect);