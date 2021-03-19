<?php
class PhotosController extends Controller
{
    public function storeIcon(Request $request)
    {
            $file=$params['photo'];

            // s3のuploadsファイルに追加
            $path = Storage::disk('s3')->put('/icon_images',$file, 'public');

            // パスを、ユーザのicon_image_urlというカラムに保存
            $user=\Auth::user();
            $user->icon_image_url = $path;
            $user->save();

            return view('setting.channel');
    }
}
?>