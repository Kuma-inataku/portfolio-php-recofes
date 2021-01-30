<?php 
// Noticeメッセージを表示する
ini_set('display_errors', 1); 

session_start();

if(!empty($_POST)){
  if($_POST['email'] === ''){
    $error['email'] = 'blank';
  }
  if(strlen($_POST['password']) < 4){
    $error['password'] ='length';
  }
  if($_POST['password'] === ''){
    $error['password'] ='blank';
  }
  if($_POST['name'] === ''){
    $error['name'] = 'blank';
  }
  if($_POST['fes_count'] === '選択してください'){
    $error['fes_count'] = 'must_select';
  }
  $fileName = $_FILES['image']['name'];
  if(!empty($fileName)){
    $ext = substr($fileName,-3);
    if($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
      $error['image']= 'type';
    }
  }
  
  if(empty($error)){
    $image = date('YmdHis') . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../user_picture/' . $image);
    $_SESSION['join'] = $_POST;
    $_SESSION['join']['image'] = $image;
    header('Location:check.php');
    exit();
  }
}

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
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Twiter)<span class="sns_url">※URLを記入ください</span></p>
            <div>
              <input type="text" name="twitter" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['twitter'],ENT_QUOTES)); ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Instagram)<span class="sns_url">※URLを記入ください</span></p>
            <div>
              <input type="text" name="instagram" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['instagram'],ENT_QUOTES)); ?>" />
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