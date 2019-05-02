<?php
require ('database/dbManager.class.php');
$mysql = new dbManager();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-RU-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://192.168.1.99/bookstore/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Bookstore Homepage</title>
</head>

<body>
  <?php require "blocks/header.php" ?>

  <div class="container">
    <h1 class="display-3">Привет, <?php echo $username;?>!</h1>
    <p>Это ваш личный кабинет. Тут вы можете посмотреть купленные вами книги.</p>
  </div>

  <div class="row mb-2">
    <?php $mysql->getUsersBooks($username); ?>
  </div>

  <?php require "blocks/footer.php" ?>
</body>
</html>
