-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `my_project`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `fes`
--

CREATE TABLE `fes` (
  `fes_id` int(11) NOT NULL,
  `fes_name` varchar(255) NOT NULL,
  `fes_name_kana` varchar(255) NOT NULL,
  `fes_location` varchar(255) NOT NULL,
  `fes_time` int(11) NOT NULL,
  `fes_url` text NOT NULL,
  `fes_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `fes`
--

INSERT INTO `fes` (`fes_id`, `fes_name`, `fes_name_kana`, `fes_location`, `fes_time`, `fes_url`, `fes_picture`) VALUES
(1, 'Rock\'in Japan', 'ろっきんじゃぱん', '国営ひたち海浜公園(茨城県)', 8, 'http://rijfes.jp/', 'fes_man.png'),
(2, 'SWEET LOVE SHOWER', 'すいーとらぶしゃわー', '山中湖交流プラザ きらら(山梨県)', 8, 'https://www.sweetloveshower.com/2020/online/', 'fes_man.png'),
(3, 'RISING SUN ROCK FESTIVAL', 'らいじんぐさん', '石狩湾新港樽川ふ頭横野外特設ステージ', 8, 'https://rsr.wess.co.jp/2020/', 'fes_man.png'),
(4, 'COUNT DOWN JAPAN', 'かうんとだうんじゃぱん', '幕張メッセ国際展示場(千葉県)', 12, 'http://countdownjapan.jp/', 'fes_man.png'),
(5, 'HAJIKETEMAZARE', 'はじけてまざれ', '泉大津フェニックス(大阪)', 9, 'http://haziketemazare.com/2020_summer/', 'fes_man.png'),
(6, 'イナズマロックフェス', 'いなずまろっくふぇす', '烏丸半島芝生広場(滋賀県)', 9, 'https://inazumarock.com/2021/', 'fes_man.png'),
(7, 'Coming Kobe', 'かみんぐこうべ', '神戸空港多目的広場', 5, 'https://comingkobe.com/', 'fes_man.png'),
(8, 'ツタロックフェス', 'つたろっくふぇす', '幕張メッセ(千葉県)', 3, 'https://tsutaya.tsite.jp/feature/music/tsutarock/tsutarockfes2020/index', 'fes_man.png'),
(9, 'FUJI ROCK FESTIVAL', 'ふじろっくふぇすてぃばる', '苗場スキー場(山梨県)', 8, 'https://www.fujirockfestival.com/', 'fes_man.png'),
(10, 'ジャイガ', 'じゃいが', '舞洲スポーツアイランド 太陽の広場(大阪)', 8, 'http://giga-osaka.com/', 'fes_man.png'),
(11, 'YONFES', 'よんふぇす', 'モリコロパーク(愛知)', 4, 'https://yonfes.nagoya/2020/index.html', 'fes_man.png'),
(12, 'SUMMER SONIC FESTIVAL', 'さまーそにっくふぇすてぃばる', 'ZOZOマリンスタジアム&幕張メッセ(東京)\r\n舞洲スポーツアイランド(大阪)', 8, 'https://www.summersonic.com/', 'fes_man.png'),
(13, 'METROCK', 'めとろっく', '新木場・若洲公園(東京)\r\n海とのふれあい広場(大阪)', 5, 'http://metrock.jp/', 'fes_man.png'),
(14, 'VIVA LA ROCK', 'びばらろっく', 'さいたまスーパーアリーナ(埼玉)', 5, 'https://vivalarock.jp/2020/', 'fes_man.png'),
(15, '京都大作戦', 'きょうとだいさくせん', '京都府立山城総合運動公園(京都)', 7, 'https://kyoto-daisakusen.kyoto/21/', 'fes_man.png');

-- --------------------------------------------------------

--
-- テーブルの構造 `ranking`
--

CREATE TABLE `ranking` (
  `fes_id` int(11) NOT NULL,
  `review_count` int(11) NOT NULL,
  `fes_name` varchar(255) NOT NULL,
  `fes_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `fes_name` varchar(255) NOT NULL,
  `review_image` varchar(255) NOT NULL,
  `review` varchar(400) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `reviews`
--

INSERT INTO `reviews` (`id`, `fes_name`, `review_image`, `review`, `reviewer_id`, `created`, `updated`) VALUES
(7, 'カウントダウンジャパン', '2046690_s.jpg', 'なんか、いいって聞きました。', 6, '2021-02-02 01:10:44', '2021-02-02 01:10:44'),
(8, 'ラブシャ', 'IMG_1873_Original.jpg', 'ご飯おいしい', 4, '2021-02-03 00:09:26', '2021-02-03 00:09:26');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sns_twitter` text NOT NULL,
  `sns_instagram` text NOT NULL,
  `fes_count` int(11) NOT NULL,
  `image` text NOT NULL,
  `profile` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `sns_twitter`, `sns_instagram`, `fes_count`, `image`, `profile`, `created`, `modified`) VALUES
(3, 'kuma@mail', '54adbc768978d9574b682470bd1f568f5a3f43da', 'kuma', 'kuma_twitter', 'kuma_insta', 93, '20210131030926animal_stand_kuma.png', 'kumaです！\r\nよろしくお願いします！！', '2021-01-31 12:09:45', '2021-01-31 03:09:45'),
(4, 'test@test.com', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'クマ', 'kuma', 'kuma', 12, '202101310454212337957_m.jpg', 'こんにちは！\r\nよろしくお願いします！', '2021-01-31 13:55:05', '2021-01-31 04:55:05'),
(6, 'test@mail', '011c945f30ce2cbafc452f39840f025693339c42', 'bear', 'bearbear', 'bearbear', 0, '20210202010911face_smile_man2.png', 'bearです、初心者です。', '2021-02-02 10:09:45', '2021-02-02 01:09:45');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `fes`
--
ALTER TABLE `fes`
  ADD PRIMARY KEY (`fes_id`);

--
-- テーブルのインデックス `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`fes_id`);

--
-- テーブルのインデックス `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `fes`
--
ALTER TABLE `fes`
  MODIFY `fes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルのAUTO_INCREMENT `ranking`
--
ALTER TABLE `ranking`
  MODIFY `fes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
