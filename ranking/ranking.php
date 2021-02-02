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

  $rankings = $db->query('SELECT * FROM fes LIMIT 0,15');
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
  <title>レコFES</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <link rel="stylesheet" type="text/css" href="../css/ranking.css">
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
        <li>
          <a href="http://localhost:8888/my_project/logout.php">ログアウト</a>
        </li>
      </ul>
    </nav>
  </header>
  <section class="rank_wrap">
    <div class="rank"> 
      <!-- [PHP]投稿内容持ってくる -->
      <div class="rank-content">
        <h2>オススメフェスランキング</h2>
        <ol>
        <?php foreach($rankings as $ranking):?>
          <li data-rank="1">
            <span><?php print(htmlspecialchars($ranking['fes_id'],ENT_QUOTES)); ?>位</span>
            <a href="http://localhost:8888/my_project/ranking/detail.php"><?php print(htmlspecialchars($ranking['fes_name'],ENT_QUOTES)); ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <?php endforeach; ?>
          <!-- <li data-rank="2">
            <span>2位</span>
            <a href="#">SWEET LOVE SHOWER<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li data-rank="3">
            <span>3位</span>
            <a href="#">RIZING SUN<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>4位</span>
            <a href="#">COUNT DOWN JAPAN<?php ?></a>
            <p>(<?php ?>票)</p>
          </li> -->
        </ol>
      </div>
    </div>
  </section>
  <footer>
  ©2021 Reco.FES 
  </footer>
</body>
</html>

