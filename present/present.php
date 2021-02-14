<?php
// Noticeメッセージを表示する
ini_set('display_errors', 1); 

require('../dbconnect.php');
session_start();

// SESSIONにidやtimeが保存されてた場合
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
  // ログイン時にSESSIONのtimeを現在時刻に上書き(更新)する=SESSION長持ち
  $_SESSION['time'] =time();
  
  // DBのusersテーブルからidを取得し、どのユーザーがログインしているかSESSIONで受け取る
  $users = $db->prepare('SELECT * FROM users WHERE id=?');
  $users->execute(array($_SESSION['id']));
  $user = $users->fetch();
}
else{
  header('Location: ../login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レコフェス</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/dropdownmenu.css">
    <script type="text/javascript" src="../js/dropdownmenu.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li class="nav_home_log">
            <a href="../ranking/index.php" class="nav_title">レコＦＥＳ</a>
          </li>
          <!-- <li class="nav_must">
            <a href="#">他のランキング</a>
          </li> -->
          <li class="nav_must">
            <a href="../review/review.php">口コミする</a>
          </li>
          <li>
            <a href="../present/present.php"><i class="fas fa-gift fa"></i>特典</a>
            <!-- <div class="nav_present">
              <a href="../present/present.php"><i class="fas fa-gift fa-2x"></i>特典</a>
            </div> -->
          </li>
          <li>
            <p>ようこそ、<?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?>さん</p>
          </li>
          <!-- ドロップダウンリスト -->
          <div class="dropdown">
            <button class="dropdown__btn" id="dropdown__btn">
              <i class="fas fa-bars fa-2x"></i>
            </button>
            <div class="dropdown__body">
              <ul class="dropdown__list">
                <li class="dropdown__item">
                  <a href="../mypage/mypage.php" class="dropdown__item-link">マイページ</a>
                </li>
                <li class="dropdown__item">
                  <a href="../logout.php" class="dropdown__item-link">ログアウト</a>
                </li>
              </ul>
            </div>
          </div>
          <!-- [END]ドロップダウンリスト -->
        </ul>
      </nav>
    </header>
    <div class="wrap">
      <div class="container">
        <h1><i class="fas fa-gift fa"></i>特典</h1>
        <div class="content">
          <p class="pre_text">
            フェス初心者の方向けにログイン限定特典として
            <br>
            <span>絶対に失敗しない！<br>初めてのフェス持ち物チェックリスト</span>
            <br>
            をプレゼントいたします！
          </p>
          <br>
          <p class="pre_text">
            ダウンロードは<a href="twitter1.png" download="サンプル.png">こちら</a>から
          </p>
        </div>
      </div>
    </div>
    <footer>
      ©2021 Reco.FES 
    </footer>
  </body>
</html>