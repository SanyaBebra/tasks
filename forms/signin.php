<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="../css/forms.css">
</head>
<body>
  <form action="../backend/login.php" method="POST">
      <h3>Вход</h3>
      <label>E-mail</label>
      <input type="email" placeholder="example@gmail.com" name="email">
      <label>Пароль</label>
      <input type="password" placeholder="Password" name="password">
      <button type="submit">Войти</button>
      <p>Нету аккаунта? - <a href="signup.php">Зарегестрироватся</a></p>
      
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