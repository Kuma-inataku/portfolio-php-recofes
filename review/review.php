<?php
// Noticeメッセージを表示する
// ini_set('display_errors', 1); 

session_start();
require('../dbconnect.php');

if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
  // ログイン時にSESSIONのtimeを現在時刻に上書き(=更新)
  $_SESSION['time'] =time();
  
  // $_SESSION['id']でusersテーブルからidを取得し、ログイン中のユーザーを特定
  $users = $db->prepare('SELECT * FROM users WHERE id=?');
  $users->execute(array($_SESSION['id']));
  $user = $users->fetch();

  $stmts = $db->query('SELECT * FROM fes ORDER BY fes_name_kana ASC');
}
else{
  header('Location: ../login.php');
  exit();
}

if(!empty($_POST)){
  //空欄時のエラー表示(ニックネーム)
  if($_POST['fes_name'] === '選択してください'){
    $error['fes_name'] = 'must_select';
  }
  // fes_nameが既に口コミされていた時の重複を防ぐ
  if(empty($error)){
    $fes_review = $db->prepare('SELECT COUNT(*) AS cnt_fes_name FROM reviews WHERE fes_name=? AND reviewer_id=?');
    $fes_review->execute(array($_POST['fes_name'],$_SESSION['id']));
    $recordFes_name = $fes_review->fetch();

    if ($recordFes_name['cnt_fes_name'] > 0){
      $error['cnt_fes_name'] = 'duplicate';
      }
    }
  // $_FILESで受け取った画像データ名を$fileNameに保存($_FILESはグローバル変数)
  $fileName = $_FILES['review_image']['name'];
  // /jpg/.png/gif以外が選択された時のエラー表示(画像選択)
  if(!empty($fileName)){
    $ext = substr($fileName,-3);
    if($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
      $error['review_image']= 'type';
    }
  }
  // INSERTでfes_id代入するために$_POST['fes_name']で受け取るフェス名と同じfesテーブル内のフェス名に紐づくfes_idを$fesCntに代入
  $fesCnts = $db->prepare('SELECT fes_id FROM fes WHERE fes_name=?');
  $fesCnts->execute(array($_POST['fes_name']));
  $fesCnt=$fesCnts->fetch();

  if(empty($error)){   
    // 思い出の写真が空欄だった場合、固定の画像を表示
    if($_FILES['review_image']['name'] == ""){
      $image = 'test.jpg';
    }
    // 思い出の写真が入っていたら、その通り表示
    else{
      //$_FILESで受け取った画像データに年月日時分秒を付与したファイル名を$imageに代入
      $image = date('YmdHis') . $_FILES['review_image']['name'];
    }
    // $_FILESで受け取った画像を専用で作ったfes_pctureディレクトリに投函
    move_uploaded_file($_FILES['review_image']['tmp_name'],'../review_picture/' . $image);
    // フォーム入力内容をDBに保存
      $review = $db->prepare('INSERT INTO reviews SET fes_id=?, fes_name=?, review_image=?, review=?, reviewer_id=?, created=NOW()');
      $review->execute(array(
        $fesCnt['fes_id'],
        $_POST['fes_name'],
        $image,
        $_POST['review'],
        $user['id']
      )); 
    header('Location: ../ranking/index.php');
    exit();
  }
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
          <li class="nav_home_log">
            <a href="../ranking/index.php" class="nav_title">レコＦＥＳ</a>
          </li>
          <!-- <li class="nav_must">
            <a href="#">他のランキング</a>
          </li> -->
          <li class="nav_must">
            <a href="../review/review.php">口コミする</a>
          </li>
          <li>
            <a href="../present/present.php"><i class="fas fa-gift fa"></i>特典</a>
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
        <h1>口コミする</h1>
        <div class="content">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="corner">
              <p class="subtitle">オススメフェス<span class="must">必須</span></p>
              <select name="fes_name">
                <option value="選択してください">選択してください</option>
                <?php foreach($stmts as $stmt): ?>
                <option value="<?php print(htmlspecialchars($stmt['fes_name'],ENT_QUOTES)); ?>">
                <?php print(htmlspecialchars($stmt['fes_name'],ENT_QUOTES)); ?>
                </option>
                <?php endforeach;?>
              </select>
              <!-- 未選択の場合のエラー表示 -->
              <?php if ($error['fes_name'] === 'must_select'): ?>
                <p class="error">回数を選んでください</p>
              <?php endif; ?>
              <!-- fes_nameが重複時のエラー表示 -->
              <?php if ($error['cnt_fes_name'] === 'duplicate'): ?>
                <p class="error">指定されたフェスは既に口コミしています</p>
              <?php endif; ?> 
              <!-- 他項目で漏れがあった場合の場合のエラー -->
              <?php if(!empty($error)): ?>
                <p class="error">恐れ入りますが、再度回数を選択ください</p>
              <?php endif; ?>
            </div>
            <div class="corner">
              <p class="subtitle">思い出の一枚</p>
              <input type="file" name="review_image" size="35" maxlength="255" value="" />

              <!-- 画像じゃないモノが投函された場合のエラー -->
              <?php if ($error['review_image'] === 'type'): ?>
              <p class="error">画像は「.jpg」「.gif」「.png」のどれかで指定してください</p>
              <?php endif; ?>

              <!-- 他項目で漏れがあった場合の場合のエラー -->
              <?php if(!empty($error)): ?>
              <p class="error">恐れ入りますが、再度画像を指定してください</p>
              <?php endif; ?>

            </div>
            <div class="corner">
              <p class="subtitle">オススメの理由</p>
              <div>
              <textarea name="review" cols="50" rows="10" placeholder="オススメの理由を書いてください！"></textarea>
              </div>
            </div>
            <div class="go_review">
              <input type="submit" value="口コミする" />
              <p class="">後から修正ができます</p>
              <p class="">※「思い出の一枚」は修正ができません。</p>
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