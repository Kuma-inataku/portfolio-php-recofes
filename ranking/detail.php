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
      </ul>
    </nav>
  </header>
  <section class="rank_wrap">
    <div class="rank"> 
      <!-- [PHP]投稿内容持ってくる -->
      <!-- <img class="rank-img" src="<?php ?>" alt=""> -->
      <h2>YONFES<?php ?></h2>
      <div class="rank-info">
        <div class="rank_info_img">
          <img src="../images/top_image3.jpg<?php ?>" alt="">
        </div>
        <div class="rank_info_content">
          <table>
            <tr>
              <th>開催場所</th>
              <td><?php ?></td>
            </tr>
            <tr>
              <th>開催時期</th>
              <td><?php ?></td>
            </tr>
            <tr>
              <th>公式サイト</th>
              <td><?php ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </section>
    <div>
      <div>
        <h2><?php ?>の口コミ</h2>
        <ul class="this_reviews">
          <!-- <a href="#"> -->
            <li class="reviews"> 
              <!-- [PHP]投稿内容持ってくる -->
              <div class="review_flex">
                <div class="review-left">
                  <img class="card-img" src="../images/top_image3.jpg<?php ?>" alt="">
                </div>
                <div class="review-right">
                  <div class="card-content">
                    <p class="card-text">サイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストササイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テスト</p>
                  </div>
                  <div class="review_right_bottom">
                    <div class="reviewer_img">
                      <img src="../images/top_image3.jpg<?php ?>" alt="">
                    </div>
                    <div class="reviewer_profile">
                      <p class="reviewer_name">山田太郎<?php ?></p>
                      <br>
                      フェス回数：<?php ?>回
                    </div>
                    <div class="goodbtn">
                      <button type="submit">いいね！</button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          <!-- </a> -->
        </ul>
      </div>
      <footer>
      ©2021 Reco.FES 
      </footer>
</body>
</html>

