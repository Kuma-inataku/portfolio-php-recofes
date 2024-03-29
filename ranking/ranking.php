<?php
session_start();
require('../dbconnect.php');

// SESSIONにidやtimeが保存されてた場合
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    // ログイン時にSESSIONのtimeを現在時刻に上書き(更新)する=SESSION長持ち
    $_SESSION['time'] =time();

    // DBのusersテーブルからidを取得し、どのユーザーがログインしているかSESSIONで受け取る
    $users = $db->prepare('SELECT * FROM users WHERE id=?');
    $users->execute(array($_SESSION['id']));
    $user = $users->fetch();

    $rankings = $db->query('SELECT DISTINCT * FROM fes LIMIT 0,15');
} else {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レコフェス</title>
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
        <li class="nav_home_log">
          <a href="../ranking/index.php" class="nav_title">レコフェス</a>
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
          <a href="../present/present.php">特典</a>
        </li>
        <li>
          <p>ようこそ、<?php print(htmlspecialchars($user['name'], ENT_QUOTES)); ?>さん</p>
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
      <!-- [PHP]投稿内容持ってくる -->
      <div class="rank-content">
        <h2>オススメフェスランキング</h2>
        <ol>
        <?php foreach ($rankings as $ranking):?>
          <li data-rank="1">
            <span><?php print(htmlspecialchars($ranking['fes_id'], ENT_QUOTES)); ?>位</span>
            <a href="detail.php?id=<?php print(htmlspecialchars($ranking['fes_id'], ENT_QUOTES)); ?>"><?php print(htmlspecialchars($ranking['fes_name'], ENT_QUOTES)); ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </div>
  </section>
  </main>
  <footer>
  ©2021 Reco.FES 
  </footer>
</body>
</html>

