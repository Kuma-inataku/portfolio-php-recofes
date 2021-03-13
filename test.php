<?php 
session_start();
require('dbconnect.php');

$rankings = $db->query('SELECT fes_name, COUNT(id) AS review_cnt FROM reviews GROUP BY fes_name ORDER BY review_cnt DESC');

// foreach使うパターン
$fruits = $db->query('SELECT name_fruit, COUNT(*) AS cnt_fruit FROM test GROUP BY name_fruit ORDER BY cnt_fruit DESC');

require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = new Aws\S3\S3Client([
    'version'  => '2006-03-01',
    'region'   => 'us-east-1',
]);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
  <script type="text/javascript" src="js/dropdownmenu.js"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>

<h1>S3 upload example</h1>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
    try {
        // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>

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

  <button id="showr">Show</button>
    <p style="display: none;" id="test">
    <span>昔むかし、</span> <span>ある</span> <span>ところに</span>
    <span>3人の</span> <span>プログラマーが</span> <span>おった</span>
    <span>そうな…</span>
    </p>
  <script>
  $("#showr").click(function () {
    $("#test").show();
  });
  </script>
</body>
</html>