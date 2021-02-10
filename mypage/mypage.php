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

  $reviews=$db->query('SELECT r.id, r.fes_name, r.review_image, r.review FROM reviews r, users u WHERE r.reviewer_id=u.id');

  $ids=$db->query('SELECT reviewer_id FROM reviews');
  $ids->execute([]);
  $id=$ids->fetch();
  //エラーデバックコード
  // var_dump($id);
  // var_dump($db->errorInfo()); 
  // exit();
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
  <link rel="stylesheet" type="text/css" href="../css/dropdownmenu.css">
  <script type="text/javascript" src="../js/dropdownmenu.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li class="nav_home">
        <a href="http://localhost:8888/my_project/ranking/index.php">レコＦＥＳ</a>
        </li>
        <li class="nav_must">
          <a href="#">他のランキング</a>
        </li>
        <li class="nav_must">
        <a href="http://localhost:8888/my_project/review/review.php">口コミする</a>
        </li>
        <li>
          <a href="../present/present.php">特典</a>
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
            <a href="<?php print(htmlspecialchars($user['sns_twitter'],ENT_QUOTES)); ?>" alt="Twitter URL" target="_blank">
              <img src="../images/twitter.png" alt="">
            </a>
            <a href="<?php print(htmlspecialchars($user['sns_instagram'],ENT_QUOTES)); ?>" alt="Instagram URL" target="_blank">
              <img src="../images/Instagram.png" alt="">
            </a>
          </div>
        </div>
        <div class="prof_info_update">
          <button type="submit" onClick="location.href='http://localhost:8888/my_project/mypage/edit.php'">プロフィール編集</button>
        </div>
      </div>
    </div>
  </section>
    <div>
      <div>
        <h2><?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?>の口コミ</h2>
          <?php if($_SESSION['id'] == $id['reviewer_id']) : ?>
        <ul class="this_reviews">
          <!-- <a href="#"> -->
          <?php foreach($reviews as $review): ?>
            <li class="reviews"> 
              <div class="review_flex">
                <div class="review-left">
                  <!-- [PHP]reviewsテーブルのreview_image持ってくる -->
                  <img class="card-img" src="../review_picture/<?php print(htmlspecialchars($review['review_image'],ENT_QUOTES)); ?>" alt="思い出の写真">
                </div>
                <div class="review-right">
                  <div class="card-content">
                    <p class="card-text"><?php print(htmlspecialchars($review['review'],ENT_QUOTES)); ?></p>
                    <p class="card-text"><?php print(htmlspecialchars($review['fes_name'],ENT_QUOTES)); ?></p>
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
              <div class="card-link">
              <a href="../review/detail.php">もっと見る</a>
              <a href="../delete.php?id=<?php print(htmlspecialchars($review['id'])) ?>">
              <a href="../delete.php?id=<?php print(htmlspecialchars($review['id'])) ?>">
                <i class="far fa-trash-alt"></i>
              <a href="../review/edit.php?id=<?php print(htmlspecialchars($review['id'])) ?>">
                <i class="fas fa-pen"></i>
              </a>
              </div>
            </li>
            <?php endforeach; ?>
          <!-- </a> -->
        </ul>
            <?php endif; ?>
      </div>
      <footer>
      ©2021 Reco.FES 
      </footer>
</body>
</html>

