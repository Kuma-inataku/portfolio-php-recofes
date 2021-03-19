<?php 
// Noticeメッセージを表示する
// ini_set('display_errors', 1); 

session_start();
require('../dbconnect.php');

if(!isset($_SESSION['join'])){
  header('Location:index.php');
  exit();
}

if(!empty($_POST)){
  $statement = $db->prepare('INSERT INTO users SET email=?, password=?, name=?, sns_twitter=?,sns_instagram=?, fes_count=?, image=?, profile=?, created=NOW()');
  $statement->execute(array(
    $_SESSION['join']['email'],
    sha1($_SESSION['join']['password']),
    $_SESSION['join']['name'],
    $_SESSION['join']['twitter'],
    $_SESSION['join']['instagram'],
    $_SESSION['join']['fes_count'],
    $_SESSION['join']['image'],
    $_SESSION['join']['profile']
  ));

  unset($_SESSION['join']);

  header('Location: thanks.php');
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
</head>
<body>
<header>
    <nav>
      <ul>
        <li class="nav_home">
        <a href="../index.php" class="nav_title">レコフェス</a> 
        </li>
        <li>
          <a href="index.php">ユーザー登録</a>
        </li>
        <li>
          <a href="../login.php">ログイン</a>
        </li>
        <li>
        <a href="../login_guest.php">ゲストログイン</a>
        </li>
      </ul>
    </nav>
</header>
<main>
  <div class="wrap">
    <div class="container">
      <h1>登録内容確認</h1>
      <div class="content">
        <form action="" method="post">
          <input type="hidden" name="action" value="submit"/>
          <div class="corner">
            <p class="subtitle">メールアドレス</p>
            <p>
            <?php print(htmlspecialchars($_SESSION['join']['email'],ENT_QUOTES)); ?>
            </p>
          </div>
          <div class="corner">
            <p class="subtitle">パスワード</p>
            <p>*****(表示されません)</p>
          </div>
          <div class="corner">
            <p class="subtitle">ニックネーム</p>
            <p><?php print(htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES)); ?></p>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Twiter)</p>
            <p>
            <?php print(htmlspecialchars($_SESSION['join']['twitter'],ENT_QUOTES)); ?>
            </p>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Instagram)</p>
            <p>
            <?php print(htmlspecialchars($_SESSION['join']['instagram'],ENT_QUOTES)); ?>
            </p>
          </div>
          <div class="corner">
            <p class="subtitle">フェスに行った回数</p>
            <p>
            <?php print(htmlspecialchars($_SESSION['join']['fes_count'],ENT_QUOTES)); ?>回
            </p>
          </div>
          <div class="corner">
            <p class="subtitle">プロフィール画像</p>
              <?php if($_SESSION['join']['image'] !== ''): ?>
               <img src="../user_picture/<?php print(htmlspecialchars($_SESSION['join']['image'],ENT_QUOTES)); ?>" alt=""> 
               <?php endif; ?>
          </div>
          <div class="corner">
            <p class="subtitle">自己紹介</p>
            <p>
            <?php print(htmlspecialchars($_SESSION['join']['profile'],ENT_QUOTES)); ?>
            </p>
          </div>
          <div class="go_login">
            <a href="index.php?action=rewrite">&laquo;&nbsp;修正する</a>
            <input type="submit" value="登録" />
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
  <footer>
    ©2021 Reco.FES 
  </footer>
</body>
</html>