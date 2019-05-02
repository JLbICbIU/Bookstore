<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-RU-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://192.168.1.99/bookstore/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Sign in</title>
</head>

<body class="text-center">
  <?php require "blocks/header.php" ?>
  <form class="form-signin" method="post">
    <img class="mb-4" src="http://192.168.1.99/bookstore/src/img/MainLogo.JPG" alt="" width="150" height="150">
    <h1 class="h3 mb-3 font-weight-normal">Войдите чтобы продолжить</h1>

    <?php
    // session_start();
    require ('database/dbManager.class.php');
    $mysql = new dbManager();

    if (isset($_POST['inputEmail']) and isset($_POST['inputPassword'])) {
      $useremail = $_POST['inputEmail'];
      $password = $_POST['inputPassword'];
      $username=$mysql->checkUser($useremail, $password);

      if ($username!="notfound") {
        $_SESSION['username'] = $username;
        header('Location: http://192.168.1.99/bookstore/homepage');
      } else {
        Echo '<p style="color:#ff0000">Проверьте электронную почту или пароль</p>';
      }
    }
    ?>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="inputEmail" class="form-control" placeholder="Введите email" required="" autofocus="">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="inputPassword" class="form-control" placeholder="Введите пароль" required="">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
  </form>
  <p>У вас нет аккаунта? <a href="http://192.168.1.99/bookstore/registration.php">Зарегистрируйтесь </a>прямо здесь.</p>
</body>
</html>
