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
if(!empty($_POST)){
  if($_POST['review'] !== ''){
    $review = $db->prepare('INSERT INTO reviews SET reviewer_id=?, fes_name=?, review_image=?, review=?, created=NOW()');
    $review->execute(array(
      $user['id'],
      $_POST['fes_name'],
      $_POST['review_image'],
      $_POST['review']
    ));
    // var_dump($user); // ここを追加
    // die(); // ここを追加

    header('Location: ../ranking/home.php');
    exit();  
  }
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
            レコＦＥＳ
        </li>
        <li class="nav_must">
          <a href="#">他のランキング</a>
        </li>
        <li class="nav_must">
          <a href="about">口コミする</a>
        </li>
        <li>
          <a href="skills">特典</a>
        </li>
        <li>
          <a href="skills"><?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?>さん</a>
        </li>
      </ul>
    </nav>
</header>
  <div class="wrap">
    <div class="container">
      <h1>口コミする</h1>
      <div class="content">
        <form action="" method="post">
          <div class="corner">
            <p class="subtitle">オススメフェス<span class="must">必須</span></p>
            <select name="fes_name">
              <option value="選択してください">選択してください</option>
              <option value="ロッキンジャパン">ロッキンジャパン</option>
              <option value="ラブシャ">ラブシャ</option>
              <option value="カウントダウンジャパン">カウントダウンジャパン</option>
            </select>
          </div>
          <div class="corner">
            <p class="subtitle">思い出の一枚</p>
            <input type="file" name="review_image" size="35" maxlength="255" value="" />
          </div>
          <div class="corner">
            <p class="subtitle">オススメの理由</p>
            <div>
            <textarea name="review" cols="50" rows="10" placeholder="オススメの理由を書いてください！"></textarea>
            </div>
          </div>
          <div class="go_login">
            <input type="submit" value="確認画面へ" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>
    ©2021 Reco.FES 
  </footer>
</body>
</html>