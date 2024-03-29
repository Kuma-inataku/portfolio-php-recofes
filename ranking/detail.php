<?php
session_start();
require('../dbconnect.php');

// SESSIONにidやtimeが保存されてた場合
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    // ログイン時にSESSIONのtimeを現在時刻に上書き(更新)する=SESSION長持ち
    $_SESSION['time'] =time();
} else {
    header('Location: ../login.php');
    exit();
}

if (empty($_REQUEST['id'])) {
    header('Location: index.php');
    exit;
}

// DBのusersテーブルからidを取得し、どのユーザーがログインしているかSESSIONで受け取る
$users = $db->prepare('SELECT * FROM users WHERE id=?');
$users->execute(array($_SESSION['id']));
$user = $users->fetch();

// 表示するfesのid特定
$id = $_REQUEST['id'];
//フェス情報詳細をfesテーブルから取得
$festivals = $db->prepare('SELECT * FROM fes WHERE fes_id=?');
$festivals->execute([$id]);
$fes= $festivals->fetch();

//口コミ情報と口コミ投稿者情報をreviews,usersテーブルから取得
$members = $db->prepare('SELECT u.name, u.sns_twitter, u.sns_instagram, u.fes_count, u.image,r.* FROM users u, reviews r WHERE u.id=r.reviewer_id AND fes_id=?');
$members->execute([$id]);
$member=$members->fetch();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レコフェス</title>
  <!-- ナビバー -->
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <!-- --------指定したフェス詳細、フェスの口コミ------- -->
  <link rel="stylesheet" type="text/css" href="../css/ranking.css">
  <!-- --------ハンバーガードロップダウンメニュー------- -->
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
      <div class="rank-content">
        <h2><?php print(htmlspecialchars($fes['fes_name'], ENT_QUOTES)); ?></h2>
        <div class="rank-info">
          <div class="rank_info_img">
            <img src="../fes_picture/<?php print(htmlspecialchars($fes['fes_picture'], ENT_QUOTES)); ?>" alt="フェスの写真">
          </div>
          <div class="rank_info_content">
            <table>
              <tr>
                <th>開催場所</th>
                <td><?php print(htmlspecialchars($fes['fes_location'], ENT_QUOTES)); ?></td>
              </tr>
              <tr>
                <th>開催時期</th>
                <td><?php print(htmlspecialchars($fes['fes_time'], ENT_QUOTES)); ?>月</td>
              </tr>
              <tr>
                <th>公式サイト</th>
                <td><a href="<?php print(htmlspecialchars($fes['fes_url'], ENT_QUOTES)); ?>" target="_blank"><?php print(htmlspecialchars($fes['fes_url'], ENT_QUOTES)); ?></a></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="rank-content">
    <h2><?php print(htmlspecialchars($fes['fes_name'], ENT_QUOTES)); ?>の口コミ</h2>
    <?php foreach ($members as $member): ?>
    <ul class="this_reviews">
      <li class="reviews"> 
        <div class="review_flex">
          <div class="review-left">
            <img class="card-img" src="../review_picture/<?php print(htmlspecialchars($member['review_image'], ENT_QUOTES)); ?>" alt="">
          </div>
          <div class="review-right">
            <div class="rank-review">
              <p class="rank_text"><?php print(htmlspecialchars($member['review'], ENT_QUOTES)); ?></p>
            </div>
            <div class="review_bottom">
              <div class="reviewer_img">
                <img src="../user_picture/<?php print(htmlspecialchars($member['image'], ENT_QUOTES)); ?>" alt="">
              </div>
              <div class="reviewer_profile">
                <p class="reviewer_fescnt">フェス回数：<?php print(htmlspecialchars($member['fes_count'], ENT_QUOTES)); ?>回</p>
                <p class="reviewer_name"><?php print(htmlspecialchars($member['name'], ENT_QUOTES)); ?></p>
              </div>
              <!-- <div class="goodbtn">
                <button type="submit">いいね！</button>
              </div> -->
            </div>
          </div>
        </div>
      </li>
    </ul>
    <?php endforeach; ?>
  </div>
  </main>
  <footer>
  ©2021 Reco.FES 
  </footer>
</body>
</html>

