<?php 
session_start();
require('dbconnect.php');

// reviewsテーブルから持っていた方がいい？
// $reviews = $db->query('SELECT * FROM fes WHERE fes_id ORDER BY fes_name_kana ASC');

// $rankings = $db->query('SELECT * FROM reviews LIMIT 0,5');

// $stmts = $db->prepare('SELECT COUNT (id) AS review_cnt FROM reviews GROUP BY fes_name');
// $stmts->execute(array());
// $stmt = $stmts->fetch();

// foreach使わないパターン
// $fruits = $db->prepare('SELECT name_fruit, COUNT(*) AS cnt_fruit FROM test WHERE name_fruit=? GROUP BY name_fruit ORDER BY cnt_fruit DESC');
// $fruits->execute([$_POST['name_fruit']]);
// $fruit=$fruits->fetch();

// foreach使うパターン
$fruits = $db->query('SELECT name_fruit, COUNT(*) AS cnt_fruit FROM test GROUP BY name_fruit ORDER BY cnt_fruit DESC');

// var_dump($fruit);
// var_dump($db->errorInfo()); 
// exit();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
</head>
<body>
<?php foreach($fruits as $fruit):?>
  <p><?php print(htmlspecialchars($fruit['name_fruit'],ENT_QUOTES)); ?>・<?php print(htmlspecialchars($fruit['cnt_fruit'], ENT_QUOTES )); ?>個</p>
<?php endforeach; ?>
</body>
</html>