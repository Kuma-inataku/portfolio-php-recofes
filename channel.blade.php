<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <h2>アイコン画像を変更</h2>

  <span width="100px" height="100px">
    <img class="rounded" src="{{ Storage::disk('s3')->url(Auth::user()->icon_image_url) }}">
  </span>

  <figcaption>現在のアイコン画像</figcaption>

  <form method="POST" action="/storeIcon" enctype="multipart/form-data">
  {{ csrf_field() }}
    <input type="file" name="photo">
    <input type="submit" value="更新する？" class="button btn">
  </form>
</body>
</html>