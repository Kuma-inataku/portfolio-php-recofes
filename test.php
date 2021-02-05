<?php 
session_start();
require('dbconnect.php');

$reviews = $db->query('SELECT * FROM fes WHERE fes_id ORDER BY fes_name_kana ASC');

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

</body>
</html>