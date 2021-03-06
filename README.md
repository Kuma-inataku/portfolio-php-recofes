# 初めに
元々フロントエンドエンジニア志望だったところからサーバーサイドエンジニア志望に方向転換し

「自分の手でCRUD機能を実装できるのか！！PHPってすごい！！」

と、ひどく感動を覚え知識の定着を目的に作ったアプリです。

また開発の中で一番意識したのは**Twitterでアウトプット**をすることだったので、当時のツイートとともに見ていただけると臨場感がわかるかな、と思います。

※このQiita記事は「まずはアウトプット！」と思い、記事にしましたのでアプリの内容はいくつかお見苦しい点が申し訳ございません。随時、修正・更新していきます。

### 学習時間
PHP/SQL学習期間：約１週間（約５０時間）

本アプリ開発期間：約３週間（約１６０時間）

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1350229150561275905?s=20) (ProgateでPHPを学習開始)

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1353350303072964609?s=20) (遷移図作成から開始)

# アプリの概要

## タイトル
#### 「レコフェス！」
「レコ(Recommend)」＋「フェス(Festival、ここでは音楽フェスの意)」

## 開発の背景
### 自分の「好きなこと」の課題解決をしよう！
過去に、友人が、**初めて行くフェスに悩んでいた**ことを思い出し、同じように悩んでいる方のこの課題を解決するアプリを開発しようと思いました。

### 信用のある情報。それは「経験者による『口コミ』」
今、消費者が信用する情報は実際に経験したことのある人による**口コミ**であることは

Amazonや楽天で買い物したり、

食べログやぐるなびでお店を選んだり、

普段の皆さんの行動から明らかかと思います。

そのような**フェスの口コミ**が集まるサービスが現状なかったため、開発に踏み切りました。

## ターゲット
### ターゲット①(フェス初心者)
・10代後半(高校生・大学生)～30代前半の女性・男性

・音楽フェスに行ったことがなく「一度は行ってみたい」と興味ある

・その反面、自分の周りにフェスに詳しい人がおらず、インターネットが主な情報源である人

・初めて行くフェスで失敗したくない

・SNS(Twitter/Instagram)を使っている
### ターゲット②(フェス経験者)
・10代後半(高校生・大学生)～30代前半の女性・男性

・フェスに行ったことがあり、フェスへ行く際の注意点やオススメなフェスを知っている。

・「フェス／ライブでつながる仲間(趣味仲間)が欲しい」と思っている

・SNS(Twitter/Instagram)を使っている

# 使用イメージ

### 新規登録、ログイン／ログオフ機能
空欄時・既に登録がある場合のエラー表示
![ログインログオフ.gif](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/780929/966eee53-55e9-5bc4-467c-c7b9c305f61b.gif)

### ランキング表示
口コミされた数だけ票数が加算。自動でランキング入れ替え
![ranking.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/780929/d4666f69-03f1-66dd-a159-33edc6c43c3b.png)

### 口コミ投稿機能
オススメしたいフェスを選んで、思い出の写真とオススメの理由を記載

※~~同じ選択肢(フェス名)が3つになっているのは修正中ですm(__)m~~

⇒修正完了しました。
![口コミ.gif](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/780929/684aa651-09ee-7c4b-4821-3a3c5b131908.gif)

### 口コミ内容表示
直近の口コミを思い出の写真と一緒に3つ表示

ログインユーザーのみ自分の口コミ削除や編集が可能

~~※Instagramアイコンが表示されない点、画像が崩れている点については修正中です。~~

⇒修正完了しました。
![口コミ表示.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/780929/a6e3694c-655f-21e5-8970-637a8c596dfb.png)

### ユーザー情報詳細
「この人の口コミ役に立つ(^^)」と思ったらその投稿者のSNSまで遷移可能
![ユーザー情報.gif](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/780929/dd20c0a5-85db-78c8-2521-b65da9c5f7ce.gif)


### 特典ページ
フェス初心者の悩みである「当日の持ち物は何持っていけばいいか？」を解決

⇒ランキング機能だけでは解決できない課題も解決
![特典.gif](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/780929/b956c062-18c0-077e-c114-a38596d2f8e0.gif)

# 使用技術
### フロントエンド
HTML/CSS
jQuery 3.4.1

### バックエンド
PHP 7.4.1

### DBMS
MySQL/PHPMyAdmin

### デプロイ環境
Heroku

# 機能一覧
課題解決のために必要な機能だけ実装することを意識しました。

| No | 必要機能候補 | 優先度 | ×の理由 |
|:-----------:|:------------:|:------------:|:------------:|
| 1 | ユーザー登録機能 | 〇 | -|
| 2 | ログイン機能 | 〇 | - |
| 3 | ゲストログイン機能 | 〇 | - |
| 4 | プロフィール編集機能 | 〇 | - |
| 5 | 口コミ投稿機能 | 〇 | - |
| 6 | 口コミ編集機能 | 〇 | - |
| 7 | 口コミ消去機能 | 〇 | - |
| 8 | ランキング表示機能 | 〇 | - |
| 9 | レスポンシブ機能 | △ | バックエンド側ができれば使用可能なのでデプロイ後追加 |
| 10 | 口コミへの返信機能 | × | 本機能はSNS上で実施可能であるため |
| 11 | 口コミ編集機能 | × | 同上 |
| 12 | フォロー／フォロワー機能 | × | 同上 |

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1353968477527150594?s=20)

# DB設計
非常に簡単なDB設計ですが、DB設計の難しさを経験し

``概念設計⇒論理設計(主に正規化)⇒物理設計``

の流れが学習できたことは大きな収穫でした。

以下が最終的なDB設計です。

![DB.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/780929/baa20744-e287-eeaa-9149-3ec78925275d.png)


※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1354079039468810243?s=20)(手順がわからず、当初はただのテーブルとカラムの羅列のみでした…)

# 工夫した点

**自走すること**と**チーム開発**という実務を見据えた開発を意識しました。

### 1.とにかくTwitterでアウトプット
タイトルや冒頭に記述した通りですが、実装した機能やつまづいた箇所については**コードの処理を言語化し１行１行の理解を深めました**。

また、次回アプリ開発時の**復習材料として見返せる**ことも見据えて欠かさずアウトプットしました。

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1355766073656631297?s=20)

### 2.自力でなるべく解決
**自走力を高める**ことを目的に実装後にうまく実装できない場合の解決のアプローチは

1.タイプミスがないかチェック

2.ini_set()やvar_dump()を用いてエラー文を読み、エラーの原因箇所を重点分析

3.どうしてもわからない場合はメンターの方に質問

を実施しました。


※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1355530348298289158?s=20)

また「やりたいこと」をコードでどのように実装するか悩んだ際は

1.「やりたいこと」を紙に文章化

2.書いた文章をDB情報やコードで置き換える

事で実装がうまくいきました。

これはデータベース上でどうやってリレーションを引けばいいか困惑していたときに非常に役に立ち、繰り返し実施することでリレーションの理解が格段に深まりました。

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1360204732988465152?s=20)

### 3.Githubの活用
Githubについては以下のように活用しました。

・issueを出してタスク管理

・issueをpull requestで結び付けてタスクを消化

・ぱっと見で何をしたかわかるcommit messageを意識

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1356180814082449415?s=20) (Githubのissue立て)

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1354606454565527557?s=20) (Githubのcommit message)

# 苦労した点

### 1.データベースの設計及びリレーション処理
当初はリレーションの理解が浅くSQLの書き方がわかりませんでした。

工夫点の2.で記述した通り紙に書いて対策を取りました。

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1358585335567974400?s=20)

### 2.queryとprepare/execute/fetchの意味の理解
データベースから値を取得する際

```
$members = $db->query('...');
```
や

```
$members = $db->prepare('...');
$members -> execute('...');
$member = $members ->  fetch();
```

を使いますが、これらの使い方ついて最後まで理解できず、つまづいた点もありました。

~~(別途Qiita記事投稿予定)~~

⇒[コチラのQiita記事](https://qiita.com/TkTkTkTkTako/items/aa0063e733a99ef53e54)でアウトプットしました。

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1358414441528786944?s=20) (prepareとquery)

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1358772396551884803?s=20) (fetch)

### 3.Herokuでのデプロイ
特にローカル環境(MyAdmin)から本番環境(MySQL Workbench)へデータベースを移行する際、SQLの処理がうまくいかず苦戦しました。

⇒[コチラのQiita記事](https://qiita.com/TkTkTkTkTako/items/27e9f47923ccb77064d2)でアウトプットしました。

※[参考ツイート](https://twitter.com/TkTkTkTkTako/status/1361330940564267008?s=20)

# 課題
以下が残存課題です。随時修正していきます。

・DBから値をうまく取得できていない

　⇒画像が表示されない、DBの値が重複している、など

・レスポンシブ対応

　⇒ターゲットが若年層であり、スマホからの利用が多いことを考えると必要

・他のランキングも増加

　⇒フェス初心者の悩みは尽きないので、他のランキングを作成し、多角的なフェスに関する悩み解決できるアプリにしていきたいです。
 
　
 (例：オススメアーティストは？オススメフェス飯は？オススメ写真映えスポットは？など)

# 学んだこと
・アプリの内容自体はフレームワークなしでありレベルが高いとは言えませんが

実務を見据えた開発経験ができたこと自体には価値がありWEBエンジニアに不可欠な**自走力**が身についたと実感します。

・PHPのみで開発を進めることで、フレームワークの利便性に頼らない基礎のPHP及びMySQLの理解を深めることができました。

・直近はこの経験を活かして、フレームワーク(Laravel)を使ったアプリ開発に挑戦し、最終的にはWEBエンジニアとして実務を全うできることを目指します。

最後まで読んでいただきありがとうございました！！！m(__)m
