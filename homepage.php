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

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between align-content-between flex-wrap">
      <?php $mysql->getThemes();?>
    </nav>
  </div>

  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <?php $mysql->getBookOfTheMonth();  ?>
      <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Узнать больше...</a></p>
    </div>
  </div>

  <div class="row">
    <?php for ($i=1; $i < 10; $i++): ?>
      <div class="col-lg-4">
          <img class="mb-4 justify-content-center" width="200px" height="200px" src="http://192.168.1.99/bookstore/src/img/book404.jpg"></img>
        <?php $mysql->getBookStock($i); ?>
        <p><a class="btn btn-secondary" href="#" role="button">Подробнее...</a></p>
      </div><!-- /.col-lg-4 -->
    <?php endfor ?>
  </div>

  <?php require "blocks/footer.php" ?>
</body>
</html>
