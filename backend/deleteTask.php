<?php

  require_once 'connect.php';

  header('Content-Type: application/json');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['taskId'];

    $stmt = mysqli_prepare($connect, "DELETE FROM task WHERE `task`.`id` = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['error' => 'Не удалилось']);
    }

    mysqli_stmt_close($stmt);
  }

  mysqli_close($connect);