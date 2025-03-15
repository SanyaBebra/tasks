<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Tasks</title>

  <link rel="stylesheet" href="../css/forms.css">
</head>
<body>
  <form action="../backend/registration.php" method="POST">
    <h3>Регистрация</h3>
    <label>Логин</label>
    <input type="text" placeholder="Login" name="login">
    <label>E-mail</label>
    <input type="email" placeholder="example@gmail.com" name="email">
    <label>Пароль</label>
    <input type="password" placeholder="Password" name="password">
    <label>Повторить пароль</label>
    <input type="password" placeholder="Repeat password" name="password_confirm">
    <button type="submit">Зарегистрироватся</button>
    <p>У вас уже есть аккаунт? - <a href="signin.php">Войти</a></p>

    <?php 

      session_start();

      if (isset($_SESSION['error'])) {
        echo '<div class="error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
      }

    ?>

  </form>
</body>
</html>