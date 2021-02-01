<?php 
session_start();
require('../dbconnect.php');

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
</head>
<body>
<header>
    <nav>
    <ul>
        <li class="nav_home">
           <a href="http://localhost:8888/my_project/ranking/home.php">レコＦＥＳ</a>
        </li>
        <li class="nav_must">
          <a href="#">他のランキング</a>
        </li>
        <li class="nav_must">
          <a href="http://localhost:8888/my_project/review/review.php">口コミする</a>
        </li>
        <li>
          <a href="#">特典</a>
        </li>
        <li>
          <a href="http://localhost:8888/my_project/mypage/mypage.php"><?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?>さん</a>
        </li>
      </ul>
    </nav>
  </header>
  <div class="wrap">
    <div class="container">
      <h1>プロフィール編集</h1>
      <div class="content">
        <form action="" method="post">
          <div class="corner">
            <p class="subtitle">ニックネーム</p>
            <!-- <p class="error">*ニックネームを入力してください</p> -->
            <div>
              <input type="text" name="name" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Twiter)</p>
            <div>
              <input type="text" name="twitter" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Instagram)</p>
            <div>
              <input type="text" name="instagram" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">フェスに行った回数</p>
            <div>
              <input type="password" name="password" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">プロフィール画像</p>
            <div>
              <input type="password" name="password" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">自己紹介</p>
            <div>
            <textarea name="profile" cols="50" rows="10" placeholder=""><?php ?></textarea>
            </div>
          </div>
          <div class="go_login">
            <input type="submit" onClick="location.href='http://localhost:8888/my_project/mypage/mypage.php'" value="登録" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="register">
    既に会員の方は<a href="#">コチラ</a>からログイン
  </div>
  <footer>
    ©2021 Reco.FES 
  </footer>
</body>
</html>