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
  <link rel="stylesheet" type="text/css" href="../css/mypage.css">
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
  <section class="prof_wrap">
    <div class="prof"> 
      <h2 class="title_mypage">マイページ</h2>
      <!-- [PHP]DB情報持ってくる -->
      <div class="prof-info">
        <div class="prof_info_img">
          <img src="../user_picture/<?php print(htmlspecialchars($user['image'],ENT_QUOTES)); ?>" alt="プロフィール画像">
        </div>
        <div class="prof_info_content">
          <p class="myname"><?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?></p>
          <p class="myfes_count">フェスへ行った回数：<?php print(htmlspecialchars($user['fes_count'],ENT_QUOTES)); ?>回</p>
          <p class="my_comment"><?php print(htmlspecialchars($user['profile'],ENT_QUOTES)); ?></p>
          <div class="mysns">
            <a href="<?php print(htmlspecialchars($user['sns_twitter'],ENT_QUOTES)); ?>" alt="Twitter URL">
              <img src="../images/twitter.png" alt="">
            </a>
            <a href="sns_instagram" alt="Instagram URL">
              <img src="../images/Instagram.png" alt="">
            </a>
          </div>
        </div>
        <div class="prof_info_update">
          <button type="submit" onClick="location.href='http://localhost:8888/my_project/mypage/update.php'">プロフィール編集</button>
        </div>
      </div>
    </div>
  </section>
    <div>
      <div>
        <h2><?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?>の口コミ</h2>
        <ul class="this_reviews">
          <!-- <a href="#"> -->
            <li class="reviews"> 
              <div class="review_flex">
                <div class="review-left">
                  <!-- [PHP]reviewsテーブルのreview_image持ってくる -->
                  <img class="card-img" src="../images/top_image3.jpg<?php ?>" alt="">
                </div>
                <div class="review-right">
                  <div class="card-content">
                    <p class="card-text"><?php ?>サイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストササイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テストサイコーだった！WANIMAいいね！テスト</p>
                  </div>
                  <div class="review_right_bottom">
                    <div class="reviewer_img">
                      <img src="../user_picture/<?php print(htmlspecialchars($user['image'],ENT_QUOTES)); ?>" alt="">
                    </div>
                    <div class="reviewer_profile">
                      <p class="reviewer_name"><?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?></p>
                      <br>
                      フェス回数：<?php print(htmlspecialchars($user['fes_count'],ENT_QUOTES)); ?>回
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

