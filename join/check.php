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
      <h1>登録内容確認</h1>
      <div class="content">
        <form action="" method="post">
          <div class="corner">
            <p class="subtitle">メールアドレス</p>
            <?php ?>
          </div>
          <div class="corner">
            <p class="subtitle">パスワード</p>
            <div>*****(表示されません)</div>
          </div>
          <div class="corner">
            <p class="subtitle">ニックネーム</p>
            <div>
              <?php ?>
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Twiter)</p>
            <div>
              <?php ?>
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">SNS(Instagram)</p>
            <div>
              <?php ?>
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">フェスに行った回数</p>
            <div>
              <?php ?>
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">プロフィール画像</p>
            <div>
              <?php ?>
            </div>
          </div>
          <div class="corner">
            <p class="subtitle">自己紹介</p>
            <div>
              <?php ?>
            </div>
          </div>
          <div class="go_login">
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