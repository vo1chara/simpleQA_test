<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="ru" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/ignat/css/main.css" />
  <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="ignat/layouts/favicon.ico" type="image/x-icon">
  <title>Тесты</title>
</head>

<body>
  <ul class="nav">
    <?php if (isset($_SESSION['login'])) : ?>
      <li class="nav-item">
        <a class="nav-link active" href="/simpleQA/tasks/">Писать тест</a>
      </li>
    <?php endif; ?>
    <?php if (!isset($_SESSION['login'])) : ?>
      <li class="nav-item">
        <a class="nav-link" href="/simpleQA/users/registration">Регистрация</a>
      </li>
    <?php endif; ?>
    <li class="nav-item">
      <?php if (isset($_SESSION['login'])) : ?>
        <div class="nav-link"><a href="/simpleQA/users/logOut"><?= $_SESSION['login']; ?>
            Выйти</a></div>
      <?php else : ?>
        <div class="nav-link"><a href="/simpleQA/users/login">Вход</a></div>
      <?php endif; ?>
    </li>
    <?php if (isset($_SESSION['role']) && $_SESSION['role']) : ?>
      <li class="nav-item">
        <a class="nav-link" href="/simpleQA/tasks/all">Все тесты пользователей, для админа</a>
      </li>
    <?php endif; ?>
    <?php if (isset($_SESSION['role']) && $_SESSION['role']) : ?>
      <li class="nav-item">
        <a class="nav-link" href="/simpleQA/tasks/add">Работа над тестами</a>
      </li>
    <?php endif; ?>
  </ul>
  <div class="container">
    <?php include($contentPage); ?>
  </div>

</body>

</html>