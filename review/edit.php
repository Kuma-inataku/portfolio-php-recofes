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
  
  $stmts = $db->query('SELECT * FROM fes WHERE fes_id ORDER BY fes_name_kana ASC');
  // reviewsのidに紐づくreviewを表示
  $reviews = $db->prepare('SELECT * FROM reviews WHERE id=?');
  $reviews->execute(array($_REQUEST['id']));
  $review = $reviews->fetch();
}
else{
  header('Location: ../login.php');
  exit();
}

if(!empty($_POST)){
  // $_FILESで受け取った画像データ名を$fileNameに保存($_FILESはグローバル変数)
  // $fileName = $_FILES['review_image']['name'];
  
  // /jpg/.png/gif以外が選択された時のエラー表示(画像選択)
  // if(!empty($fileName)){
  //   $ext = substr($fileName,-3);
  //   if($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
  //     $error['review_image']= 'type';
  //   }
  // }  
  if(empty($error)){
    //$_FILESで受け取った画像データに年月日時分秒を付与したファイル名を$imageに代入
    $image = date('YmdHis') . $_FILES['review_image']['name'];
    // $_FILESで受け取った画像を専用で作ったfes_pctureディレクトリに投函
    move_uploaded_file($_FILES['review_image']['tmp_name'],'../review_picture/' . $image);
 
    // 口コミ編集機能
    $edits = $db->prepare('UPDATE reviews SET fes_name=?, review=?, updated=NOW() WHERE id=?');
    $edits->execute(array(
      $_POST['fes_name'],
      $_POST['review'],
      $_REQUEST['id']
    ));
  } 
    header('Location: ../mypage/mypage.php');
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
  <link rel="stylesheet" type="text/css" href="../css/dropdownmenu.css">
  <script type="text/javascript" src="../js/dropdownmenu.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
<header>
    <nav>
      <ul>
        <li class="nav_home">
          <a href="../ranking/index.php" class="nav_title">レコＦＥＳ</a>
        </li>
        <!-- <li class="nav_must">
          <a href="#">他のランキング</a>
        </li> -->
        <!-- <li class="nav_must">
          <a href="../review/review.php">口コミする</a>
        </li> -->
        <li>
          <a href="../present/present.php"><i class="fas fa-gift fa"></i>特典</a>
          <!-- <div class="nav_present">
            <a href="../present/present.php"><i class="fas fa-gift fa-2x"></i>特典</a>
          </div> -->
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
  <div class="wrap">
    <div class="container">
      <h1>口コミ編集</h1>
      <div class="content">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="corner">
            <p class="subtitle">オススメフェス<span class="must">必須</span></p>
            <select name="fes_name">
              <option value="<?php print(htmlspecialchars($review['fes_name'],ENT_QUOTES)); ?>"><?php print(htmlspecialchars($review['fes_name'],ENT_QUOTES)); ?></option>
              <?php foreach($stmts as $stmt): ?>
              <option value="<?php print(htmlspecialchars($stmt['fes_name'],ENT_QUOTES)); ?>">
              <?php print(htmlspecialchars($stmt['fes_name'],ENT_QUOTES)); ?>
              </option>
              <?php endforeach;?>
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

          <div class="corner">
            <p class="subtitle">思い出の一枚</p>
            <!-- <input type="file" name="review_image" size="35" maxlength="255" value="" /> -->
            <p>
            <img src="../review_picture/<?php print(htmlspecialchars($review['review_image'],ENT_QUOTES));?>" alt="思い出の写真">
            <?php print(htmlspecialchars($review['fes_image'],ENT_QUOTES)); ?>
            </p>
            <!-- 画像じゃないモノが投函された場合のエラー -->
            <?php if ($error['review_image'] === 'type'): ?>
            <p class="error">画像は「.jpg」「.gif」「.png」のどれかで指定してください</p>
            <?php endif; ?>
            <!-- [END]画像じゃないモノが投函された場合のエラー -->
              <!-- 他項目で漏れがあった場合の場合のエラー -->
              <?php if(!empty($error)): ?>
              <p class="error">恐れ入りますが、再度画像を指定してください</p>
              <?php endif; ?>
              <!-- [END]他項目で漏れがあった場合の場合のエラー -->
          </div>

          <div class="corner">
            <p class="subtitle">オススメの理由</p>
            <div>
            <textarea name="review" cols="50" rows="10" placeholder="オススメの理由を書いてください！"><?php print(htmlspecialchars($review['review'],ENT_QUOTES)); ?></textarea>
            </div>
          </div>
          <div class="go_login">
            <input type="submit" value="確認画面へ" />
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