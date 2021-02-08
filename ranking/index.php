
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

  // fes_nameを表示するために$rankingを定義
  $rankings = $db->query('SELECT * FROM reviews LIMIT 0,5');
  // $rankings->execute([]);
  // $ranking= $rankings->fetch();

  //エラーデバックコード
  // var_dump($ranking);
  // var_dump($db->errorInfo()); 
  // exit();

  // fes_name1個に対してのidを取得するために定義
  $stmts = $db->query('SELECT fes_name, COUNT(id) AS review_cnt FROM reviews GROUP BY fes_name ORDER BY review_cnt DESC');
  // $stmts->execute($ranking['fes_name']);
  // $stmt = $stmts->fetch();

  //エラーデバックコード
  // var_dump($stmts);
  // var_dump($db->errorInfo()); 
  // exit();
 
}
else{
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
      <div class="rank-content">
        <h2>オススメフェスランキング</h2>
        <ol>
          <?php foreach($rankings as $ranking):?>
            <?php foreach($stmts as $stmt):?>
          <li data-rank="1">
            <span>1位</span>
            <a href="detail.php?id="><?php print(htmlspecialchars($ranking['fes_name'],ENT_QUOTES)); ?></a>
            <p>(<?php print(htmlspecialchars($stmt['review_cnt'],ENT_QUOTES)); ?>票)</p>
          </li>
            <?php endforeach; ?>
          <?php endforeach; ?>
          <!-- <li data-rank="2">
            <span>2位</span>
            <a href="#">SWEET LOVE SHOWER</a>
            <p>(票)</p>
          </li>
          <li data-rank="3">
            <span>3位</span>
            <a href="#">RIZING SUN</a>
            <p>(票)</p>
          </li>
          <li>
            <span>4位</span>
            <a href="#">COUNT DOWN JAPAN</a>
            <p>(票)</p>
          </li> -->

        </ol>
      </div>
      <div class="rank-link">
        <a href="ranking.php">もっと見る</a>
      </div>
    </div>
    </section>
    <div>
      <h2>口コミをしてまだ知らないフェス仲間とつながろう！</h2>
      <div class="review_btn">
        <button type="submit" onClick="location.href='http://localhost:8888/my_project/review/review.php'">口コミする</button>
      </div>
      <div>
        <h2>直近の口コミ</h2>
        <ul class="recent_reviews">
        <?php foreach($reviews as $review): ?>
          <!-- <a href="#"> -->
            <li class="card"> 
              <!-- <section> -->
              <img class="card-img" src="../fes_picture/<?php print(htmlspecialchars($review['review_image'],ENT_QUOTES));?>" alt="思い出の一枚">

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
                  <img src="../images/twitter.png" alt="">
                </a>
                <a href="<?php print(htmlspecialchars($review['sns_twitter'],ENT_QUOTES)); ?>">
                  <img src="../images/instagram.png" alt="">
                </a>
              </div>
              <div class="card-link">
                  <a href="../review/detail.php">もっと見る</a>
                 <?php if($_SESSION['id'] == $review['reviewer_id']) : ?>
                  <a href="../delete.php?id=<?php print(htmlspecialchars($review['id'])) ?>">
                    <i class="far fa-trash-alt"></i>
                  </a>
                  <?php endif; ?>
              </div>
            <!-- </section> -->
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <footer>
      ©2021 Reco.FES 
      </footer>
</body>
</html>

