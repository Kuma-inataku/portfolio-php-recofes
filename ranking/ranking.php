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
          <li data-rank="1">
            <span>1位</span>
            <a href="http://localhost:8888/my_project/ranking/detail.php">Rock'in Japan<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li data-rank="2">
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
          </li>
          <li>
            <span>5位</span>
            <a href="#">HAJIKETEMAZARE<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>6位</span>
            <a href="#">イナズマロック<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>6位</span>
            <a href="#">カミングKOBE<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>7位</span>
            <a href="#">ツタフェス<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>8位</span>
            <a href="#">FUJI ROCK<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>9位</span>
            <a href="#">JAIGA<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>10位</span>
            <a href="#">YONFES<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>11位</span>
            <a href="#">YONFES<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>12位</span>
            <a href="#">YONFES<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>13位</span>
            <a href="#">YONFES<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>14位</span>
            <a href="#">YONFES<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>15位</span>
            <a href="#">YONFES<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
        </ol>
      </div>
    </div>
    </section>

      <!-- ranking.cssでデザイン -->
      <!-- ランキング -->
      <div class="title">
        <div class="t-content">
          
        </div>
      </div>
      <!-- ランキング(終わり) -->
      <!-- ranking.cssでデザイン -->
    </section>


      <footer>
      ©2021 Reco.FES 
      </footer>
</body>
</html>

