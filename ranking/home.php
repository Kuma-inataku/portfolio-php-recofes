<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レコFES</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <link rel="stylesheet" type="text/css" href="../css/ranking.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li class="nav_home">
            レコＦＥＳ
        </li>
        <li class="nav_must">
          <a href="#">他のランキング</a>
        </li>
        <li class="nav_must">
          <a href="about">口コミする</a>
        </li>
        <li>
          <a href="skills">特典</a>
        </li>
        <li>
          <a href="skills"><?php ?>○○さん</a>
        </li>
      </ul>
    </nav>
  </header>
  <section class="rank_wrap">
    <div class="rank"> 
      <!-- [PHP]投稿内容持ってくる -->
      <div class="rank-content">
        <h2>オススメフェスランキング</h2>
        <ol>
          <li data-rank="1">
            <span>1位</span>
            <a href="#">Rock'in Japan<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li data-rank="2">
            <span>2位</span>
            <a href="#">SWEET LOVE SHOWER<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li data-rank="3">
            <span>3位</span>
            <a href="#">RIZING SUN<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>4位</span>
            <a href="#">COUNT DOWN JAPAN<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
          <li>
            <span>5位</span>
            <a href="#">サマーソニック<?php ?></a>
            <p>(<?php ?>票)</p>
          </li>
        </ol>
      </div>
      <div class="rank-link">
        <a href="#">もっと見る</a>
      </div>
    </div>
    </section>
    <div>
      <h2>口コミをしてまだ知らないフェス仲間とつながろう！</h2>
      <div class="review_btn">
        <button type="submit">口コミする</button>
      </div>
      <div>
        <h2>直近の口コミ</h2>
        <ul class="recent_reviews">
          <!-- <a href="#"> -->
            <li class="card"> 
              <!-- <section> -->
              <!-- [PHP]投稿内容持ってくる -->
              <img class="card-img" src="<?php ?>" alt="">
              <div class="card-content">
                <p class="card-text">サイコーだった！WANIMAいいね！</p>
              </div>
              <div class="card-link">
                  <a href="#">もっと見る</a>
              </div>
            <!-- </section> -->
            </li>
            <li class="card"> 
              <!-- <section> -->
                <!-- [PHP]投稿内容持ってくる -->
                <img class="card-img" src="<?php ?>" alt="">
                <div class="card-content">
                <p class="card-text">サイコーだった！[Alexandros]いいね！</p>
              </div>
              <div class="card-link">
                <a href="#">もっと見る</a>
              </div>
            <!-- </section> -->
            </li>
            <li class="card"> 
            <!-- <section> -->
              <!-- [PHP]投稿内容持ってくる -->
              <img class="card-img" src="<?php ?>" alt="">
              <div class="card-content">
                <p class="card-text">サイコーだった！ロケーションいいね！</p>
              </div>
              <div class="card-link">
                <a href="#">もっと見る</a>
              </div>
                <!-- [PHP]投稿内容持ってくる -->
            <!-- </section> -->
            </li>
          <!-- </a> -->
        </ul>
      </div>
      <footer>
      ©2021 Reco.FES 
      </footer>
</body>
</html>

