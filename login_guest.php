<?php
require('dbconnect.php');
session_start();

if(!empty($_POST)){
  // emailとpasswordの入力フォーム(=method属性が"post"であるformタグ内)にどちらも入力がある場合

  if($_POST['email'] !== '' && $_POST['password'] !== ''){
    // $emailを元々入力した内容($_POST['email'])に代入
    $email = $_POST['email'];
    // ＤＢ上のusersテーブルのemailカラムとpasswordカラムの値を選択
    $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['password'])
    ));
    $user = $login->fetch();

    if($user){
      // SESSIONに値を代入
      $_SESSION['id'] = $user['id'];
      $_SESSION['time'] = time();
      // ranking/index.phpに遷移
      header('Location: ranking/index.php');
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レコフェス</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
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
          <a href="login_guest.php">ゲストログイン</a>
        </li>
      </ul>
    </nav>
  </header>
  <div class="wrap">
    <div class="container">
      <h1>ログイン(ゲスト)</h1>
      <div class="content">
        <form action="" method="post">
          <!-- [ログインフォーム]メールアドレス -->
          <div class="corner">
            <p class="subtitle">メールアドレス<span class="must">必須</span></p>
            <input type="text" name="email" size="35" maxlength="255" value="guest@mail.com" />
          </div>
          <!-- [ログインフォーム]パスワード -->
          <div class="corner">
            <p class="subtitle">パスワード<span class="must">必須</span></p>
            <input type="password" name="password" size="35" maxlength="255" value="guest" />
          </div>
          <div class="go_login">
            <input type="submit" value="ログイン" />
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