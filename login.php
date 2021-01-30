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
            <p class="subtitle">メールアドレス<span class="must">必須</span></p>
            <input type="text" name="email" size="35" maxlength="255" value=" " />
            <!-- <div>
              <p class="error">*メールアドレスとパスワードをご記入ください</
              <p class="error">*ログインに失敗しました。正しくご記入ください</p>
            </div> -->
          </div>
          <div class="corner">
            <p class="subtitle">パスワード<span class="must">必須</span></p>
            <div>
              <input type="password" name="password" size="35" maxlength="255" value="" />
            </div>
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
    <a href="#">新規登録はこちら</a>
  </div>
  <footer>
    ©2021 Reco.FES 
  </footer>
</body>
</html>