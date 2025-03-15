<?php 

  require_once "connect.php";

  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные
    $login = htmlspecialchars(trim($_POST['login']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (!empty($login) && !empty($email) && !empty($password) && !empty($password_confirm)) { // Проверяем "заполнены ли все поля"

      if ($password === $password_confirm) { // Проверка на совпадение пароля

        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Хэшируем пароль

        $stmt = mysqli_prepare($connect, "SELECT `id` FROM `users` WHERE `email` = ?"); // Подготавливаем запрос
        mysqli_stmt_bind_param($stmt, 's', $email); // Подставляем значение вместо '?'
        mysqli_stmt_execute($stmt); // Выполняем запрос
        mysqli_stmt_store_result($stmt); // Записуем результат что уже есть такой пользователь

        if (mysqli_stmt_num_rows($stmt) > 0) {// Проверяем есть ли такой пользователь
          $_SESSION['error'] = 'Пользователь уже зарегестрирован, попробуйте войти';
          mysqli_stmt_close($stmt);
          header('Location: ../forms/signup.php');
          exit();
        }

        mysqli_stmt_close($stmt); // Закрываем сойденение с запросом
        
        $stmt = mysqli_prepare($connect, "INSERT INTO `users` (`login`, `email`, `password`) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sss', $login, $email, $hashed_password);

        if (mysqli_stmt_execute($stmt)) { // Выполняем запрос, и сразу проверяем выполнился ли он корректно
          header('Location: ../index.php');
          exit(); 
        } else {
          $_SESSION['error'] = 'Ошибка при регистрации'; 
        }
        
        mysqli_stmt_close($stmt); // Закрываем сойденение
      } else {
        $_SESSION['error'] = 'Пароли не совпадают';
        header('Location: ../forms/signup.php');
        exit();
      }

    } else {
      $_SESSION['error'] = 'Заполните все поля!';
      header('Location: ../forms/signup.php');
      exit();
    }
  } 

  mysqli_close($connect);