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
} else {
      header('Location: ../login.php');
      exit();
  }
if (!empty($_POST)) {
    //空欄時のエラー表示(ニックネーム)
    if ($_POST['name'] === '') {
        $error['name'] = 'blank';
    }
    //空欄時のエラー表示(フェス回数)
    if ($_POST['fes_count'] === '選択してください') {
        $error['fes_count'] = 'must_select';
    }
    ///jpg/.png/gif以外が選択された時のエラー表示(画像選択)
    $fileName = $_FILES['image']['name'];
    if (!empty($fileName)) {
        $ext = substr($fileName, -3);
        if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
            $error['image']= 'type';
        }
    }
    //アカウントの重複チェック
    if (empty($error)) {
        //ニックネームの重複チェック
        $member = $db->prepare('SELECT COUNT(*) AS cnt_name FROM users WHERE name=?');
        $member->execute(array($_POST['name']));
        $recordName = $member->fetch();
        if ($recordName['cnt_name'] > 0) {
            $error['name'] = 'duplicate';
        }
    }
    // エラーが一つも出て得ない場合
    if (empty($error)) {
        // 画像データを../user_pictureという場所に投函し、かつ画像データを保持
        $image = date('YmdHis') . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../user_picture/' . $image);
    }

    // プロフィール編集機能
    $stmt = $db->prepare('UPDATE users SET name=?, sns_twitter=?, sns_instagram=?, fes_count=?, profile=?, modified=NOW() WHERE id=?');
    $stmt->execute(array(
    $_POST['name'],
    $_POST['twitter'],
    $_POST['instagram'],
    $_POST['fes_count'],
    $_POST['profile'],
    $_SESSION['id']
  ));

    header('Location: mypage.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レコフェス</title>
    <!-- ナビバー -->
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/home.css">
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
        <li class="nav_must">
          <a href="../review/review.php">口コミする</a>
        </li>
        <li>
          <a href="../present/present.php"><i class="fas fa-gift fa"></i>特典</a>
          <div class="nav_present">
            <a href="../present/present.php"><i class="fas fa-gift"></i>特典</a>
          </div>
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
  <div class="wrap">
    <div class="container">
      <h1>プロフィール編集</h1>
      <div class="content">
        <form action="" method="post">
        <div class="corner">
          <p class="subtitle">プロフィール画像</p>
          <p>※変更できません</p>
            <img src="../user_picture/<?php print(htmlspecialchars($user['image'], ENT_QUOTES)); ?>" alt="プロフィール画像">
        </div>
          <div class="corner">
            <p class="subtitle">ニックネーム</p>
              <input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($user['name'], ENT_QUOTES)); ?>" />
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Twiter)</p>
              <input type="text" name="twitter" size="35" maxlength="255" value="<?php print(htmlspecialchars($user['sns_twitter'], ENT_QUOTES)); ?>" />
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Instagram)</p>
              <input type="text" name="instagram" size="35" maxlength="255" value="<?php print(htmlspecialchars($user['sns_instagram'], ENT_QUOTES)); ?>" />
          </div>
          <div class="corner">
            <p class="subtitle">フェスに行った回数</p>
            <select name="fes_count">
              <option value="<?php print(htmlspecialchars($user['fes_count'], ENT_QUOTES)); ?>"><?php print(htmlspecialchars($user['fes_count'], ENT_QUOTES)); ?>回</option>
              <?php for ($i=0; $i<=100; $i++): ?>
              <option value="<?php print $i ?>"><?php print $i . '回' ?></option>
              <?php endfor;?>
            </select>
          </div>
          <div class="corner">
            <p class="subtitle">自己紹介</p>
            <textarea name="profile" cols="50" rows="10" placeholder=""><?php print(htmlspecialchars($user['profile'], ENT_QUOTES)); ?></textarea>
          </div>
          <div class="go_login">
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