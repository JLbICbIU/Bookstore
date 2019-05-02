<?php
  session_start();
  if (isset($_SESSION['username'])) {
    $username=$_SESSION['username'];
    $signin = 1;
  } else {
    $signin = 0;
  }
 ?>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Книжный магазин</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="http://localhost/bookstore/homepage.php">Главная</a>
    <a class="p-2 text-dark" href="http://localhost/bookstore/about.php">Информация</a>
    <?php if ($signin==1): ?>
      <a class="p-2 text-dark" href="http://localhost/bookstore/useraccount.php">Личный кабинет пользователя <?php echo $username;?></a>
    <?php endif; ?>
  </nav>
  <?php if ($signin==0): ?>
    <a class="btn btn-outline-primary" href="http://localhost/bookstore/signin.php">Войти</a>
  <?php else: ?>
    <a class="p-2 text-dark" href="http://localhost/bookstore/about.php"><?php ?></a>
    <a class="btn btn-outline-primary" href="http://localhost/bookstore/signout.php">Выйти</a>
  <?php endif; ?>
</div>
<div class="container">
