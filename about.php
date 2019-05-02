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

      <div class="starter-template">
        <h1>Лабораторная работа №4</h1>
      <p class="lead">Создать сайт на PHP и подключить БД созданную в ходе 1-3 лабораторной работы.</p>

      <p>На сайте должно быть:</br>
      •	Авторизация, выход и добавление пользователя.</br>
      •	Страница с отображением информации о купленных книгах пользователя. </br>
      •	** Другие произвольные страницы.</br>
      •	Выгрузка данных в внешний файл (word ,<a class="p-2 text-blue" href="http://192.168.1.99/bookstore/Webinfopen.php">excel</a> или pdf )</br>
      •	Выгрузка данных в json или <a class="p-2 text-blue" href="http://192.168.1.99/bookstore/WebinfopenXML.php">XML</a>.</br>
      </p>
      </div>

      <?php require "blocks/footer.php" ?>
    </body>
</html>
