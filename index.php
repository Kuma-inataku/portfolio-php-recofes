<?php
require('dbconnect.php');

$reviews = $db->query('SELECT u.name, u.image, u.fes_count, u.sns_twitter, u.sns_instagram, r.* FROM users u, reviews r WHERE u.id=r.reviewer_id ORDER BY r.created DESC LIMIT 0,3');
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レコFES</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link rel="stylesheet" type="text/css" href="css/ranking.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li class="nav_home">
          <a href="index.php">レコＦＥＳ</a> 
        </li>
        <li>
          <a href="join/index.php">ユーザー登録</a>
        </li>
        <li>
          <a href="login.php">ログイン</a>
        </li>
        <li>
          <a href="login_guest.php">ゲストログイン</a>
        </li>
      </ul>
    </nav>
  </header>
    <section class="bg-img">
      <!-- キャッチコピー -->
      <div class="title">
        <div class="t-content">
          
        </div>
      </div>
      <!-- キャッチコピー(終わり) -->
    </section>
    <div>
      <h2>「レコFES」でできること</h2>
      <div class="about">
        <div class="ab_left">
          <img src="images/top_image3.jpg" alt="">
        </div>
        <ul class="ab_right">
          <li>
            <p>オススメのフェスを知ることができる！</p> 
            <p>テストテストテストテストテスト</p>
          </li>
          <li>
            <p>フェス好きの仲間とつながれる！</p> 
            <p>テストテストテストテストテスト</p>
          </li>
          <li>
            <p>ログイン限定特典あり！</p> 
            <p>テストテストテストテストテスト</p>
          </li>
        </ul>
        </div>
      </div>
      <div>
        <h2>直近の口コミ</h2>
        <ul class="recent_reviews">
          <!-- <a href="#"> -->
          <?php foreach($reviews as $review): ?>
          <!-- <a href="#"> -->
            <li class="card"> 
              <!-- <section> -->
              <img class="card-img" src="fes_picture/<?php print(htmlspecialchars($review['review_image'],ENT_QUOTES)); ?>" alt="思い出の一枚">
              <div class="card-content">
                <p class="card-text"><?php print(htmlspecialchars($review['review'],ENT_QUOTES)); ?></p>
                <br>
                <p><?php print(htmlspecialchars($review['name'],ENT_QUOTES)); ?></p>
                <br>
                <p><?php print(htmlspecialchars($review['created'],ENT_QUOTES)); ?></p>
                <br>
                <p>フェス経験回数：<?php print(htmlspecialchars($review['fes_count'],ENT_QUOTES)); ?>回</p>
                <br>
                <a href="<?php print(htmlspecialchars($review['sns_instagram'],ENT_QUOTES)); ?>">
                  <img src="images/twitter.png" alt="">
                </a>
                <a href="<?php print(htmlspecialchars($review['sns_twitter'],ENT_QUOTES)); ?>">
                  <img src="images/instagram.png" alt="">
                </a>
              </div>
              <div class="card-link">
                  <a href="login.php">もっと見る</a>
              </div>
            <!-- </section> -->
            </li>
          <?php endforeach; ?>
          <!-- </a> -->
        </ul>
      </div>
      <footer>
      ©2021 Reco.FES 
      </footer>
</body>
</html>

