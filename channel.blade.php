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