<?php 
session_start();
require('dbconnect.php');

$rankings = $db->query('SELECT fes_name, COUNT(id) AS review_cnt FROM reviews GROUP BY fes_name ORDER BY review_cnt DESC');
$ranking= $rankings->fetch();

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

  <h2>オススメフェスランキング</h2>
  <ol>
    <?php foreach($rankings as $ranking):?>
      <li data-rank="1">
        <span>1位</span>
        <a href="detail.php?id="><?php print(htmlspecialchars($ranking['fes_name'],ENT_QUOTES)); ?></a>
        <p>(<?php print(htmlspecialchars($ranking['review_cnt'],ENT_QUOTES)); ?>票)</p>
      </li>
    <?php endforeach; ?>
  </ol>

</body>
</html>