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
    <!-- ナビバー -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- ABOUT, 直近の口コミ -->
  <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li class="nav_home">
          <a href="index.php" class="nav_title">レコＦＥＳ</a> 
        </li>
        <li>
          <a href="join/index.php">ユーザー登録</a>
        </li>
        <li>
          <a href="login.php">ログイン</a>
        </li>
        <li>
          <a href="login_guest.php">採用ご担当者様用ログイン</a>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="bg-img">
      <!-- キャッチコピー -->
      <div class="title">
        <div class="t-content">
          
        </div>
      </div>
    </section>
    <!-- ABOUTページ -->
    <div class="wrap_about">
      <div class="bg_ab">
        <h2>「レコFES」とは?</h2>
        <div class="about">
          <div class="ab_image">
            <img src="images/friends.jpg" alt="">
            <!-- <img src="images/top_image3.jpg" alt=""> -->
          </div>
          <div class="ab_text">
            <div class="ab_subtitle">
              <p>&lt;フェス初心者の方&gt;</p>
            </div>
            <p>
              <span>口コミやランキングから<br>オススメのフェスを知ることができる！</span> 
            </p>
            <p>ランキングはフェス経験者による口コミなので、安心！</p> 
            <p>さらに初心者の方にうれしいログイン限定特典あり！</p>
            <br>
            <div class="ab_subtitle">
              <p>&lt;フェス経験者の方&gt;</p>
            </div>
            <p>
              <span>新しいフェス仲間と出会える！</span> 
            </p>
            <p>
              SNSとも連携しているので、有益情報を発信してフェス仲間増やそう！
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- [2つ分けるパターン]書くことがあまりないので却下 -->
    <!-- <div class="wrap_about">
      <div class="bg_ab">
        <h2>「レコFES」とは?</h2>
        <div class="ab_subtitle">
          <p>&lt;フェス初心者の方&gt;</p>
        </div>
        <div class="about">
          <div class="ab_image">
            <img src="images/top_image3.jpg" alt="">
          </div>
          <div class="ab_text">
            <p>
              <span>口コミやランキングからオススメのフェスを知ることができる！</span> 
            </p>
            <p>ランキングはフェス経験者による口コミなので、安心！</p> 
            <p>さらに初心者の方にうれしいログイン限定特典あり！</p> 
          </div>
        </div>
        <div class="ab_subtitle">
          <p>&lt;フェス経験者の方&gt;</p>
        </div>
        <div class="about">
          <div class="ab_text_2nd">
            <p>
              <span>新しいフェス仲間と出会える！</span> 
            </p>
            <p>
              SNSとも連携しているので、有益情報を発信してフェス仲間増やそう！
            </p>
          </div>
          <div class="ab_image_2nd">
            <img src="images/top_image3.jpg" alt="">
          </div>
        </div>
      </div>
    </div> -->
    <div class="wrap_review">
      <div class="bg_rev">
        <h2>直近の口コミ</h2>
        <ul class="recent_reviews">
          <?php foreach($reviews as $review): ?>
            <li class="card"> 
              <p class="card-title"><?php print(htmlspecialchars($review['fes_name'],ENT_QUOTES)); ?></p>
              <img class="card-img" src="review_picture/<?php print(htmlspecialchars($review['review_image'],ENT_QUOTES));?>" alt="思い出の一枚">
              <div class="card-content">
                <div class="card-review">
                  <img class="card-user-img" src="user_picture/<?php print(htmlspecialchars($review['image'],ENT_QUOTES));?>" alt="口コミした人">
                  <div class="card-user-text">
                    <p class="card-text"><?php print(htmlspecialchars($review['review'],ENT_QUOTES)); ?></p>
                  </div>
                </div>
                <div class="card-user-sns">
                  <a href="<?php print(htmlspecialchars($review['sns_twitter'],ENT_QUOTES)); ?>">
                    <img src="images/twitter.png" alt="" target="_blank">
                  </a>
                  <a href="<?php print(htmlspecialchars($review['sns_instagram'],ENT_QUOTES)); ?>">
                    <img src="images/Instagram.png" alt="" target="_blank">
                  </a>
                </div>
                <!-- <div class="card-user-status">
                  <p class="card-user-name"><?php print(htmlspecialchars($review['name'],ENT_QUOTES)); ?></p>
                  <p class="card-user-count">フェス経験回数：<?php print(htmlspecialchars($review['fes_count'],ENT_QUOTES)); ?>回</p>
                </div> -->
              </div>
              <div class="card-link">
                  <a href="login.php">もっと見る</a>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    </main>
    <footer>
    ©2021 Reco.FES 
    </footer>
</body>
</html>

