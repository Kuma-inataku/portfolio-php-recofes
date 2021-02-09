<?php 
session_start();
require('../dbconnect.php');

// SESSIONにidやtimeが保存されてた場合
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
  // ログイン時にSESSIONのtimeを現在時刻に上書き(更新)する=SESSION長持ち
  $_SESSION['time'] =time();
  
}
else{
  header('Location: ../login.php');
  exit();
}

if(empty($_REQUEST['id'])){
header('Location: index.php');
exit;
}

// DBのusersテーブルからidを取得し、どのユーザーがログインしているかSESSIONで受け取る
$users = $db->prepare('SELECT * FROM users WHERE id=?');
$users->execute(array($_SESSION['id']));
$user = $users->fetch();

// 表示するfesのid特定
  $id = $_REQUEST['id'];
  $festivals = $db->prepare('SELECT * FROM fes WHERE fes_id=?');
  $festivals->execute([$id]);
  $fes= $festivals->fetch();
  
  $reviews = $db->prepare('SELECT * FROM reviews WHERE fes_id=?');
  $reviews->execute([$id]);
  // $review= $reviews->fetch();

  $members = $db->prepare('SELECT u.name, u.sns_twitter, u.sns_instagram, u.fes_count, u.image,r.* FROM users u, reviews r WHERE u.id=r.reviewer_id AND fes_id=?');
  $members->execute([$id]);
  $member=$members->fetch();
  


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
  <link rel="stylesheet" type="text/css" href="../css/dropdownmenu.css">
  <script type="text/javascript" src="../js/dropdownmenu.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>
<body>
  <header>
    <nav>
      <ul>
      <li class="nav_home">
           <a href="../ranking/index.php">レコＦＥＳ</a>
        </li>
        <li class="nav_must">
          <a href="#">他のランキング</a>
        </li>
        <li class="nav_must">
          <a href="../review/review.php">口コミする</a>
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
  <section class="rank_wrap">
    <div class="rank"> 
      <!-- <img class="rank-img" src="<?php ?>" alt=""> -->
      <h2><?php print(htmlspecialchars($fes['fes_name'],ENT_QUOTES)); ?></h2>
      <div class="rank-info">
        <div class="rank_info_img">
          <img src="../fes_picture/<?php print(htmlspecialchars($fes['fes_picture'],ENT_QUOTES)); ?>" alt="フェスの写真">
        </div>
        <div class="rank_info_content">
          <table>
            <tr>
              <th>開催場所</th>
              <td><?php print(htmlspecialchars($fes['fes_location'],ENT_QUOTES)); ?></td>
            </tr>
            <tr>
              <th>開催時期</th>
              <td><?php print(htmlspecialchars($fes['fes_time'],ENT_QUOTES)); ?>月</td>
            </tr>
            <tr>
              <th>公式サイト</th>
              <td><a href="<?php print(htmlspecialchars($fes['fes_url'],ENT_QUOTES)); ?>" target="_blank"><?php print(htmlspecialchars($fes['fes_url'],ENT_QUOTES)); ?></a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </section>
    <div>
      <div>
        <h2><?php print(htmlspecialchars($fes['fes_name'],ENT_QUOTES)); ?>の口コミ</h2>
        <?php foreach($reviews as $review): ?>
        <ul class="this_reviews">
          <!-- <a href="#"> -->
            <li class="reviews"> 
              <!-- [PHP]投稿内容持ってくる -->
              <div class="review_flex">
                <div class="review-left">
                  <img class="card-img" src="../review_picture/<?php print(htmlspecialchars($review['review_image'],ENT_QUOTES)); ?>" alt="">
                </div>
                <div class="review-right">
                  <div class="card-content">
                    <p class="card-text"><?php print(htmlspecialchars($review['review'],ENT_QUOTES)); ?></p>
                  </div>
                  <div class="review_right_bottom">
                    <div class="reviewer_img">
                      <img src="../user_picture/<?php print(htmlspecialchars($member['image'],ENT_QUOTES)); ?>" alt="">
                    </div>
                    <div class="reviewer_profile">
                      <p class="reviewer_name"><?php print(htmlspecialchars($member['name'],ENT_QUOTES)); ?></p>
                      <br>
                      フェス回数：<?php print(htmlspecialchars($member['fes_count'],ENT_QUOTES)); ?>回
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
        <?php endforeach; ?>
      </div>
      <footer>
      ©2021 Reco.FES 
      </footer>
</body>
</html>

