<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-RU-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://192.168.1.99/bookstore/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Registartion</title>
</head>

<body class="text-center">
  <?php require "blocks/header.php" ?>
  <form class="form-signin" method="post">
    <img class="mb-4" src="http://192.168.1.99/bookstore/src/img/MainLogo.JPG" alt="" width="150" height="150">
    <h1 class="h3 mb-3 font-weight-normal">Регистрация пользователя</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="inputEmail" class="form-control" placeholder="Введите email" required="" autofocus="">
    <label for="inputLogin" class="sr-only">Login</label>
    <input type="text" name="inputLogin" class="form-control" placeholder="Введите никнейм" required="">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="inputPassword" class="form-control" placeholder="Введите пароль" required="">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
  </form>
  <p>У вас уже есть аккаунт? <a href="http://192.168.1.99/bookstore/signin.php">Войти</a>.</p>
</body>
</html>

<?php
// session_start();
require ('database/dbManager.class.php');
$mysql = new dbManager();

if (isset($_POST['inputLogin']) and isset($_POST['inputEmail']) and isset($_POST['inputPassword'])) {
  $useremail = $_POST['inputEmail'];
  $username = $_POST['inputLogin'];
  $password = $_POST['inputPassword'];
  $query=$mysql->addUser($useremail, $username, $password);

  if ($query) {
    echo "<p>Пользователь с ником ".$username." успешно зарегистрирован.</p>";
  } else {
    echo "<p>Произошла ошибка. Проверьте введенные данные.</p>";
  }
}
?>
