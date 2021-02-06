<?php 
session_start();
require('dbconnect.php');

// reviewsテーブルから持っていた方がいい？
$reviews = $db->query('SELECT * FROM fes WHERE fes_id ORDER BY fes_name_kana ASC');

$rankings = $db->query('SELECT * FROM reviews LIMIT 0,5');

$stmts = $db->prepare('SELECT COUNT (id) AS review_cnt FROM reviews GROUP BY fes_name');
// $stmts->execute(array());
// $stmt = $stmts->fetch();
  var_dump($stmts);
  // var_dump($db->errorInfo()); 
  exit();

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

  <select name="fes_count">
    <option value="選択してください">選択してください</option>
    <?php foreach($reviews as $review): ?>
    <option value="<?php print(htmlspecialchars($review['fes_name'],ENT_QUOTES)); ?>">
    <?php print(htmlspecialchars($review['fes_name'],ENT_QUOTES)); ?>
    </option>
    <?php endforeach;?>
  </select>

  <?php foreach($rankings as $ranking):?>

  <p><?php print(htmlspecialchars($stmt['review_cnt'],ENT_QUOTES)); ?></p>

  <?php endforeach; ?>

</body>
</html>