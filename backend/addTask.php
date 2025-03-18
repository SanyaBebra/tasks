<?php

  require_once "connect.php";

  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_text = htmlspecialchars($_POST['task_text']);
    $user_id = $_SESSION['id'];
    $created_at = date("Y-m-d", time());

    if (!empty($task_text)) {
      $stmt = mysqli_prepare($connect, 'INSERT INTO `task` (`id`, `user_id`, `task_text`, `created_at`) VALUES (NULL, ?, ?, ?)');
      mysqli_stmt_bind_param($stmt, 'sss', $user_id, $task_text, $created_at);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      header('Location: ../index.php');
      exit();
    }
  }

  mysqli_close($connect);