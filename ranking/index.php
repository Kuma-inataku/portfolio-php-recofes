
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
  
  // fes_nameを表示及び、fes_name1個に対してのidの数をCOUNTした結果(数字)を取得するために$rankingsを定義
  $rankings = $db->query('SELECT fes_id, fes_name, COUNT(id) AS review_cnt FROM reviews GROUP BY fes_id, fes_name ORDER BY review_cnt DESC');

}else{
  header('Location: ../login.php');
  exit();
}
$reviews = $db->query('SELECT u.name, u.image, u.fes_count, u.sns_twitter, u.sns_instagram, r.* FROM users u, reviews r WHERE u.id=r.reviewer_id ORDER BY r.created DESC LIMIT 0,3');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レコフェス</title>
  <!-- ナビバー -->
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <!-- 直近の口コミ -->
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <!-- ランキング表 -->
  <link rel="stylesheet" type="text/css" href="../css/ranking.css">
  <!-- ハンバーガーセレクトダウンニュー -->
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
  <main>
  <section class="rank_wrap">
    <div class="rank"> 
      <div class="rank-content">
        <h2>オススメフェスランキング</h2>
        <ol>
          <?php foreach($rankings as $index => $ranking):?>
            <li data-rank="1">
              <span><?php print(htmlspecialchars($index+1,ENT_QUOTES)); ?>位</span>
              <a href="detail.php?id=<?php print(htmlspecialchars($ranking['fes_id'],ENT_QUOTES)); ?>">
              <?php print(htmlspecialchars($ranking['fes_name'],ENT_QUOTES)); ?></a>
              <p>(<?php print(htmlspecialchars($ranking['review_cnt'],ENT_QUOTES)); ?>票)</p>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </div>
  </section>
  <!-- <div class="review_wrap"> -->
    <!-- <h2>口コミをしてまだ知らないフェス仲間とつながろう！</h2> -->
  <div class="review_btn">
    <button type="submit" onClick="location.href='../review/review.php'">口コミする</button>
  </div>
  <!-- </div> -->
  <div class="reviews_wrap">
    <h2>直近の口コミ</h2>
    <ul class="recent_reviews">
    <?php foreach($reviews as $review): ?>
        <li class="card"> 
          <p class="card-title"><?php print(htmlspecialchars($review['fes_name'],ENT_QUOTES)); ?></p>
          <img class="card-img" src="../review_picture/<?php print(htmlspecialchars($review['review_image'],ENT_QUOTES));?>" alt="思い出の一枚">
          <div class="card-content">
            <div class="card-review">
              <img class="card-user-img" src="../user_picture/<?php print(htmlspecialchars($review['image'],ENT_QUOTES));?>" alt="口コミした人">
              <div class="card-user-text">
                <p class="card-text"><?php print(htmlspecialchars($review['review'],ENT_QUOTES)); ?></p>
              </div>
            </div>
            <div class="card-user-sns">
              <a href="<?php print(htmlspecialchars($review['sns_twitter'],ENT_QUOTES)); ?>">
                <img src="../images/twitter.png" alt="" target="_blank">
              </a>
              <a href="<?php print(htmlspecialchars($review['sns_instagram'],ENT_QUOTES)); ?>">
                <img src="../images/Instagram.png" alt="" target="_blank">
              </a>
            </div>
            <!-- <div class="card-user-status">
              <p class="card-user-name"><?php print(htmlspecialchars($review['name'],ENT_QUOTES)); ?></p>
              <p class="card-user-count">フェス経験回数：<?php print(htmlspecialchars($review['fes_count'],ENT_QUOTES)); ?>回</p>
            </div> -->
          </div>
          <div class="card-link">
              <a href="../mypage/user_mypage.php?id=<?php print(htmlspecialchars($review['reviewer_id'])) ?>">もっと見る</a>
              <?php if($_SESSION['id'] == $review['reviewer_id']) : ?>
              <a href="../delete.php?id=<?php print(htmlspecialchars($review['id'])) ?>">
                <i class="far fa-trash-alt"></i>
              </a>
              <a href="../review/edit.php?id=<?php print(htmlspecialchars($review['id'])) ?>">
                <i class="fas fa-pen"></i>
              </a>
              <?php endif; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  </main>
  <footer>
  ©2021 Reco.FES 
  </footer>
</body>
</html>

