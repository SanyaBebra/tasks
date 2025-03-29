<?php

  require_once "connect.php";

  session_start();

  header('Content-Type: application/json');

  if ($_SESSION['id']) {
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $data = json_decode(file_get_contents('php://input'), true);
  
      $task_text = htmlspecialchars($data['task_text']);
      $user_id = $_SESSION['id'];
      $created_at = date("Y-m-d", time());

      if (!empty(trim($task_text))) {
        $stmt = mysqli_prepare($connect, 'INSERT INTO `task` (`id`, `user_id`, `task_text`, `created_at`) VALUES (NULL, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'sss', $user_id, $task_text, $created_at);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
      } else {
        echo 'Заполните поле';
      }

    }

  } else {
    echo 'Нужно зарегистрироватся или войти';
  }

  mysqli_close($connect);