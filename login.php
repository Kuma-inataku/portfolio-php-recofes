<?php
require('dbconnect.php');
session_start();

// COOKIEのemailに何か保存されている場合、そのemailを呼び出す状況を$emailに代入
if($_COOKIE['email'] !== ''){
  $email = $_COOKIE['email'];
}

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
      // チェックボックスがtrue(=valueがon)である時、COOKIEに_POSTで受け取ったメールアドレスを自動で入力
      if($_POST['save']==='on'){
        setcookie('email',$_POST['email'], time()+60*60*24*14);
      }
      // ranking/index.phpに遷移
      header('Location: ranking/index.php');
      exit();
    }
    //$userが空(＝emailかpasswordが間違えていてログインに失敗)である場合
    else{
      $error['login'] = 'failed';
    }
  }
  //$_POSTで受け取るemailかpasswordのどちらかが空である場合
  else{
    $error['login'] = 'blank';
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
          <a href="http://localhost:8888/my_project/index.php">レコＦＥＳ</a>
        </li>
        <li>
          <a href="http://localhost:8888/my_project/join/index.php">ユーザー登録</a>
        </li>
        <li>
          <a href="http://localhost:8888/my_project/login.php">ログイン</a>
        </li>
        <li>
          <a href="#">ゲストログイン</a>
        </li>
      </ul>
    </nav>
  </header>
  <div class="wrap">
    <div class="container">
      <h1>ログイン</h1>
      <div class="content">
        <form action="" method="post">
          <div class="corner">
            <?php if ($error['login'] === 'blank'): ?>
            <p class="error">メールアドレスとパスワードをご記入ください</p>
            <?php endif;?>
            <?php if ($error['login'] === 'failed'): ?>
              <p class="error">ログインに失敗しました。正しくご記入ください</p>
            <?php endif;?>
            <p class="subtitle">メールアドレス<span class="must">必須</span></p>
            <input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($email,ENT_QUOTES)); ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">パスワード<span class="must">必須</span></p>
            <input type="password" name="password" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['password'],ENT_QUOTES)); ?>" />
          </div>
          <!-- 余裕あればデータベースと連携 -->
          <div class="save_login">
            <input id="save" type="checkbox" name="save" value="on">
            <label for="save">ログイン状態を維持する</label>
          </div>
          <!-- [END]余裕あればデータベースと連携 -->
          <div class="go_login">
            <input type="submit" value="ログイン" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="register">
    <a href="http://localhost:8888/my_project/join/index.php">新規登録はこちら</a>
  </div>
  <footer>
    ©2021 Reco.FES 
  </footer>
</body>
</html>