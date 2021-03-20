<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Upload</title>
</head>

<body>
  <form enctype="multipart/form-data" action="s3.php" method="POST">
    <input type="file" name="file">
    <input type="submit">
  </form>
  <!-- <p><?php print $result; ?></p> -->
</body>
</html>