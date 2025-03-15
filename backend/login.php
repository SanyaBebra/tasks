<?php

  require_once "connect.php";

  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Записываем данные
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) { // Проверка на заполненые инпуты

      $stmt = mysqli_prepare($connect, "SELECT `id`, `password` FROM `users` WHERE `email` = ?"); // Подготавливаем запрос

      mysqli_stmt_bind_param($stmt, 's', $email); // Вставляем перемменную в подготовленый запрос
      mysqli_stmt_execute($stmt); // Выполняем запрос
      mysqli_stmt_store_result($stmt); // Записывыем результат

      if (mysqli_stmt_num_rows($stmt) > 0) { // Проверяем есть ли такой емейл

        mysqli_stmt_bind_result($stmt, $user_id, $password_hashed); // Говорим куда положим значения запроса "SELECT `id`, `password` FROM `users` WHERE `email` = ?" id и password
        mysqli_stmt_fetch($stmt); // Выполняем запрос, теперь у нас есть эти переменныe
        
        if (password_verify($password, $password_hashed)) { // Проверка на правильность пароля
          $_SESSION['id'] = $user_id;

          header('Location: ../index.php');
          exit();
        } else {
          $_SESSION['error'] = 'Неверный пароль';

          header('Location: ../forms/signin.php');
          exit();
        }

        mysqli_stmt_close($stmt); // Закрываем сойденение
      } else {
        $_SESSION['error'] = 'Никого не найдено';

        header('Location: ../forms/signin.php');
        exit();
      }
    } else {  
      $_SESSION['error'] = 'Заполните все инпуты';

      header('Location: ../forms/signin.php');
      exit();
    }
  }

  mysqli_close($connect);