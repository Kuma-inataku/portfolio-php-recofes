<?php
require('dbconnect.php');
session_start();


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レコフェス</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<header>
    <nav>
      <ul>
        <li class="nav_home">
          <a href="http://localhost:8888/my_project/index.php">レコＦＥＳ</a>
        </li>
        <li>
          <a href="http://localhost:8888/my_project/join/index.php">ユーザー登録</a>
        </li>
        <li>
          <a href="http://localhost:8888/my_project/login.php">ログイン</a>
        </li>
        <li>
          <a href="#">ゲストログイン</a>
        </li>
      </ul>
    </nav>
  </header>
  <div class="wrap">
    <div class="container">
      <h1>ログイン</h1>
      <div class="content">

      </div>
    </div>
  </div>
  <div class="register">
    <a href="http://localhost:8888/my_project/join/index.php">新規登録はこちら</a>
  </div>
  <footer>
    ©2021 Reco.FES 
  </footer>
</body>
</html>