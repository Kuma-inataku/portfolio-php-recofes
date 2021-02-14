<?php 
session_start();
require('../dbconnect.php');

// SESSIONにidやtimeが保存されてた場合
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
  // ログイン時にSESSIONのtimeを現在時刻に上書き(更新)する=SESSION長持ち
  $_SESSION['time'] =time();
  
  // DBのusersテーブルからidを取得し、どのユーザーがログインしているか$_SESSIONで受け取る
  $users = $db->prepare('SELECT * FROM users WHERE id=?');
  $users->execute(array($_SESSION['id']));
  $user = $users->fetch();

  // DBのreviewsテーブルからreviewer_idを取得し、どのユーザーの詳細情報を見入るか$_REQUESTで受け取る
  $reviews = $db->prepare('SELECT r.id, r.fes_name, r.review_image, r.review, u.* FROM reviews r, users u WHERE r.reviewer_id=u.id AND reviewer_id=? ORDER BY r.created DESC');
  $reviews->execute(array($_REQUEST['id']));
  $review=$reviews->fetch();

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
    <!-- ナビバー -->
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <!-- <link rel="stylesheet" type="text/css" href="../css/home.css"> -->
  <!-- 口コミの一部(imageとか) -->
  <link rel="stylesheet" type="text/css" href="../css/ranking.css">
    <!-- 主にプロフ -->
  <link rel="stylesheet" type="text/css" href="../css/mypage.css">
  <!-- ハンバーガードロップダウンニュー -->
  <link rel="stylesheet" type="text/css" href="../css/dropdownmenu.css">
  <script type="text/javascript" src="../js/dropdownmenu.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li class="nav_home">
          <a href="../ranking/index.php" class="nav_title">レコＦＥＳ</a>
        </li>
        <!-- <li class="nav_must">
          <a href="#">他のランキング</a>
        </li> -->
        <!-- <li class="nav_must">
          <a href="../review/review.php">口コミする</a>
        </li> -->
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
  <section class="prof_wrap">
    <div class="prof"> 
      <h2 class="title_mypage"><?php print(htmlspecialchars($review['name'],ENT_QUOTES)); ?>のマイページ</h2>
      <!-- [PHP]DB情報持ってくる -->
      <div class="prof-info">
        <div class="prof_info_img">
          <img src="../user_picture/<?php print(htmlspecialchars($review['image'],ENT_QUOTES)); ?>" alt="プロフィール画像">
        </div>
        <div class="prof_info_content">
          <p class="myname"><?php print(htmlspecialchars($review['name'],ENT_QUOTES)); ?></p>
          <p class="myfes_count">フェスへ行った回数：<?php print(htmlspecialchars($review['fes_count'],ENT_QUOTES)); ?>回</p>
          <p class="my_comment"><?php print(htmlspecialchars($review['profile'],ENT_QUOTES)); ?></p>
        </div>
        <div class="prof_info_update">
          <div class="mysns">
            <a href="<?php print(htmlspecialchars($review['sns_twitter'],ENT_QUOTES)); ?>" alt="Twitter URL" target="_blank">
              <img src="../images/twitter.png" alt="">
            </a>
            <a href="<?php print(htmlspecialchars($review['sns_instagram'],ENT_QUOTES)); ?>" alt="Instagram URL" target="_blank">
              <img src="../images/Instagram.png" alt="">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
    <div>
      <div class="rank-content">
        <h2><?php print(htmlspecialchars($review['name'],ENT_QUOTES)); ?>の口コミ</h2>
        <ul class="this_reviews">
          <?php foreach($reviews as $review): ?>
            <li class="reviews"> 
              <div class="review_flex">
                <div class="review-left">
                  <img class="card-img" src="../review_picture/<?php print(htmlspecialchars($review['review_image'],ENT_QUOTES)); ?>" alt="">
                </div>
                <div class="review-right">
                  <div class="rank-review">
                    <p class="rank_fesname"><?php print(htmlspecialchars($review['fes_name'],ENT_QUOTES)); ?></p>
                    <p class="rank_text"><?php print(htmlspecialchars($review['review'],ENT_QUOTES)); ?></p>
                  </div>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
        </ul>
     </div>
      <footer>
      ©2021 Reco.FES 
      </footer>
</body>
</html>

