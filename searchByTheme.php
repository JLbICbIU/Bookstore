<?php
require ('database/dbManager.class.php');
$mysql = new dbManager();
if(isset($_GET["theme"])) {
  $theme = $_GET["theme"];
} else {
  echo "На сайте возникла неожиданная ошибка";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-RU-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://192.168.1.99/bookstore/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Search by theme</title>
</head>

<body>
  <?php require "blocks/header.php" ?>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between align-content-between flex-wrap">
      <?php $mysql->getThemes();?>
    </nav>
  </div>

  <h2>Книги по теме <?php echo $theme ?></h2>

  <div class="row mb-2">
    <?php $mysql->getBooksByTheme($theme); ?>
  </div>

  <?php require "blocks/footer.php" ?>
</body>
</html>
