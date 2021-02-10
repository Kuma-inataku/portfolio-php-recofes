<?php 
// Noticeメッセージを表示する
ini_set('display_errors', 1); 

//セッションの値受取(書き直し時に受け取れるように)
session_start();

//MyAdminとの接続用
require('../dbconnect.php');

if(!empty($_POST)){
  //空欄時のエラー表示(メールアドレス)
  if($_POST['email'] === ''){
    $error['email'] = 'blank';
  }
  //4文字以下入力時のエラー表示(パスワード)
  if(strlen($_POST['password']) < 4){
    $error['password'] ='length';
  }
  //空欄時のエラー表示(パスワード)
  if($_POST['password'] === ''){
    $error['password'] ='blank';
  }
  //空欄時のエラー表示(ニックネーム)
  if($_POST['name'] === ''){
    $error['name'] = 'blank';
  }
  //非選択時のエラー表示(フェス回数)
  if($_POST['fes_count'] === '選択してください'){
    $error['fes_count'] = 'must_select';
  }
  // /jpg/.png/gif以外が選択された時のエラー表示(画像選択)
  $fileName = $_FILES['image']['name'];
  if(!empty($fileName)){
    $ext = substr($fileName,-3);
    if($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
      $error['image']= 'type';
    }
  }
  //アカウントの重複チェック
  if(empty($error)){
    //メールアドレスの重複チェック
    $member = $db->prepare('SELECT COUNT(*) AS cnt_email FROM users WHERE email=?');
    $member->execute(array($_POST['email']));
    $recordEmail = $member->fetch();
    if ($recordEmail['cnt_email'] > 0){
      $error['email'] = 'duplicate';
    }
    //ニックネームの重複チェック
    $member = $db->prepare('SELECT COUNT(*) AS cnt_name FROM users WHERE name=?');
    $member->execute(array($_POST['name']));
    $recordName = $member->fetch();
    if ($recordName['cnt_name'] > 0){
      $error['name'] = 'duplicate';
    }
  }
    // エラーが一つも出て得ない場合
  if(empty($error)){
    // 画像データを../user_pictureという場所に投函し、かつ画像データを保持
    $image = date('YmdHis') . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../user_picture/' . $image);
    $_SESSION['join'] = $_POST;
    $_SESSION['join']['image'] = $image;
    // check.phpに遷移する
    header('Location:check.php');
    exit();
  }
}
// check.phpで内容修正があった場合、SESSIONの値をフォームに入力する
if($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])){
  $_POST = $_SESSION['join'];
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
          <a href="../index.php">レコＦＥＳ</a> 
        </li>
        <li>
          <a href="index.php">ユーザー登録</a>
        </li>
        <li>
          <a href="../login.php">ログイン</a>
        </li>
        <li>
          <a href="#">ゲストログイン</a>
        </li>
      </ul>
    </nav>
</header>
  <div class="wrap">
    <div class="container">
      <h1>新規登録</h1>
      <div class="content">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="corner">
            <p class="subtitle">メールアドレス<span class="must">必須</span></p>
            <input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES)); ?>" />
            <!-- 未記入の場合のエラー表示 -->
            <?php if($error['email'] === 'blank'): ?>
            <p class="error">メールアドレスをご記入ください</p>
            <?php endif; ?>
            <!-- [END]未記入の場合のエラー表示 -->
            <!-- メールアドレス重複時のエラー表示 -->
            <?php if($error['email'] === 'duplicate'): ?>
            <p class="error">指定されたメールアドレスは既に登録されています</p>
            <?php endif; ?>
            <!-- [END]メールアドレス重複時のエラー表示 -->
          </div>
            
            <div class="corner">
              <p class="subtitle">パスワード<span class="must">必須</span></p>
              <input type="password" name="password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>" />
              <!-- 未記入の場合のエラー表示 -->
              <?php if ($error['password'] === 'blank'): ?>
                <p class="error">パスワードを入力してください</p>
              <?php endif; ?>      
              <!-- [END]未記入の場合のエラー表示 -->
              <!-- 4文字以下の場合のエラー表示 -->
              <?php if ($error['password'] === 'length'): ?>
                <p class="error">4文字以上で入力ください</p>
              <?php endif; ?>      
              <!-- [END]4文字以下の場合のエラー表示 -->
          </div>
          <div class="corner">
            <p class="subtitle">ニックネーム<span class="must">必須</span></p>
            <div>
              <input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES)); ?>" />
            <!-- 未記入の場合のエラー表示 -->
            <?php if ($error['name'] === 'blank'): ?>
						<p class="error">ニックネームを入力してください</p>
            <?php endif; ?> 
            <!-- [END]未記入の場合のエラー表示 -->
            <!-- ニックネームが重複時のエラー表示 -->
            <?php if ($error['name'] === 'duplicate'): ?>
              <p class="error">指定されたニックネームは既に他のユーザーが使用しています</p>
            <?php endif; ?> 
            <!-- [END]ニックネームが重複時のエラー表示 -->
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Twiter)</p>
            <span class="sns_url">※https://twitter.com/以降(ユーザー名)を記入ください</span>
            <div>
              <input type="text" name="twitter" size="35" maxlength="255" value="https://twitter.com/<?php print(htmlspecialchars($_POST['twitter'],ENT_QUOTES)); ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Instagram)</p>
            <span class="sns_url">※https://www.instagram.com/以降(ユーザーネーム)を記入ください</span>
            <div>
              <input type="text" name="instagram" size="35" maxlength="255" value="https://www.instagram.com/<?php print(htmlspecialchars($_POST['instagram'],ENT_QUOTES)); ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">フェスに行った回数<span class="must">必須</span></p>
            <div>
              <select name="fes_count">
                <option value="選択してください">選択してください</option>
                <?php for($i=0; $i<=100; $i++): ?>
                <option value="<?php print $i ?>"><?php print $i . '回' ?></option>
                <?php endfor;?>
              </select>
            <!-- 未記入の場合のエラー表示 -->
            <?php if ($error['fes_count'] === 'must_select'): ?>
  						<p class="error">回数を選んでください</p>
            <?php endif; ?>
            <!-- [END]未記入の場合のエラー表示 -->
            <!-- 他項目で漏れがあった場合の場合のエラー -->
            <?php if(!empty($error)): ?>
              <p class="error">恐れ入りますが、再度回数を選択ください</p>
            <?php endif; ?>
            <!-- [END]他項目で漏れがあった場合の場合のエラー -->
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">プロフィール画像</p>
            <div>
              <input type="file" name="image" size="35" maxlength="255" value="" />
              <!-- 画像じゃないモノが投函された場合のエラー -->
              <?php if ($error['image'] === 'type'): ?>
                <p class="error">画像は「.jpg」「.gif」「.png」のどれかで指定してください</p>
                <?php endif; ?>
              <!-- [END]画像じゃないモノが投函された場合のエラー -->
              <!-- 他項目で漏れがあった場合の場合のエラー -->
              <?php if(!empty($error)): ?>
              <p class="error">恐れ入りますが、再度画像を指定してください</p>
              <?php endif; ?>
              <!-- [END]他項目で漏れがあった場合の場合のエラー -->
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">自己紹介</p>
            <div>
            <textarea name="profile" cols="50" rows="10" placeholder="簡単な自己紹介をどうぞ！"></textarea>
            </div>
          </div>
          <div class="go_login">
            <input type="submit" value="登録" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="register">
    既に会員の方は<a href="#">コチラ</a>からログイン
  </div>
  <footer>
    ©2021 Reco.FES 
  </footer>
</body>
</html>