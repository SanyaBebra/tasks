<?php 
require_once "backend/connect.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="./css/main.css">
</head>
<body>
  <div class="wrapper">
    <header class="header">
      <div class="header__container">
        <div class="header__navbar">
          <div class="header__logo">
            <a href="index.php"><img class="header__image" src="./images/logo.jpg" alt="logo"></a>
            <span class="header__logo-text">Task Manager</span>
          </div>
          <div class="header__btns">
            <a class="header__btn" href="./forms/signup.php">Sign Up</a>
            <a class="header__btn" href="./forms/signin.php">Sign In</a>
          </div>
          <div class="header__profile">
            <img class="header__profile-logo" src="images/profile.jpg" alt="profile">
          </div>
        </div>
      </div>
    </header>



    <main class="main">
      <div class="container">

        <form class="main__input" action="backend/addTask.php" method="POST">
          <input type="text" name="task_text" placeholder="Введите задачу">
        </form>

        <div class="main__wrapper">
          <!-- Block Task -->
        </div>
      </div>
    </main>




    <footer class="footer">
      <div class="container">
        <div class="footer__wrapper">
          Проект для портфолио. Технологии которые использовались: HTML, CSS, JavaScript, PHP, MySQL, REST API
        </div>
      </div>
    </footer>
  </div>

  <script src="js/main.js"></script>
</body>
</html>