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
 
}
  else{
  header('Location: ../login.php');
  exit();
}
if(!empty($_POST)){
  $statement = $db->prepare('UPDATE users SET name, sns_twitter, sns_instagram, fes_count, image, profile WHERE id=? ');
  $statement->execute(array(
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
           <a href="http://localhost:8888/my_project/ranking/home.php">レコＦＥＳ</a>
        </li>
        <li class="nav_must">
          <a href="#">他のランキング</a>
        </li>
        <li class="nav_must">
          <a href="http://localhost:8888/my_project/review/review.php">口コミする</a>
        </li>
        <li>
          <a href="#">特典</a>
        </li>
        <li>
          <a href="http://localhost:8888/my_project/mypage/mypage.php"><?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?>さん</a>
        </li>
        <li>
          <a href="http://localhost:8888/my_project/logout.php">ログアウト</a>
        </li>
      </ul>
    </nav>
  </header>
  <div class="wrap">
    <div class="container">
      <h1>プロフィール編集</h1>
      <div class="content">
        <form action="" method="post">
          <div class="corner">
            <p class="subtitle">ニックネーム</p>
            <!-- <p class="error">*ニックネームを入力してください</p> -->
            <div>
              <input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($user['name'],ENT_QUOTES)); ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Twiter)</p>
            <div>
              <input type="text" name="twitter" size="35" maxlength="255" value="<?php print(htmlspecialchars($user['sns_twitter'],ENT_QUOTES)); ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Instagram)</p>
            <div>
              <input type="text" name="instagram" size="35" maxlength="255" value="<?php print(htmlspecialchars($user['sns_instagram'],ENT_QUOTES)); ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">フェスに行った回数</p>
            <select name="fes_count">
              <option value="<?php print(htmlspecialchars($user['fes_count'],ENT_QUOTES)); ?>"><?php print(htmlspecialchars($user['fes_count'],ENT_QUOTES)); ?>回</option>
              <?php for($i=0; $i<=100; $i++): ?>
              <option value="<?php print $i ?>"><?php print $i . '回' ?></option>
              <?php endfor;?>
            </select>
          </div>
          <div class="corner">
            <p class="subtitle">プロフィール画像</p>
            <div>
              <img src="../user_picture/<?php print(htmlspecialchars($user['image'],ENT_QUOTES)); ?>" alt="プロフィール画像">
            </div>
            <input type="file" name="image" size="35" maxlength="255" value="" />
          </div>
          <div class="corner">
            <p class="subtitle">自己紹介</p>
            <div>
            <textarea name="profile" cols="50" rows="10" placeholder=""><?php print(htmlspecialchars($user['profile'],ENT_QUOTES)); ?></textarea>
            </div>
          </div>
          <div class="go_login">
            <!-- <input type="submit" onClick="location.href='../mypage.php'" value="登録" /> -->
            <input type="submit" value="登録" />
            </div>
        </form>
      </div>
    </div>
  </div>
  <footer>
    ©2021 Reco.FES 
  </footer>
</body>
</html>