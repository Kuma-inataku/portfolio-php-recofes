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
            レコＦＥＳ
        </li>
        <li>
          <a href="#">ユーザー登録</a>
        </li>
        <li>
          <a href="about">ログイン</a>
        </li>
        <li>
          <a href="skills">ゲストログイン</a>
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
              <input type="text" name="name" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Twiter)</p>
            <div>
              <input type="text" name="twitter" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Instagram)</p>
            <div>
              <input type="text" name="instagram" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">フェスに行った回数</p>
            <div>
              <input type="password" name="password" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">プロフィール画像</p>
            <div>
              <input type="password" name="password" size="35" maxlength="255" value="<?php ?>" />
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">自己紹介</p>
            <div>
            <textarea name="profile" cols="50" rows="10" placeholder=""><?php ?></textarea>
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