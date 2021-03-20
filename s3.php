<?php
// エラーを出力する
ini_set('display_errors', "On");

require_once "vendor/autoload.php";
use Aws\S3\S3Client;

$bucket = getenv('S3_BUCKET_NAME');
$key = getenv('AWS_ACCESS_KEY_ID');
$secret = getenv('AWS_SECRET_ACCESS_KEY');

// S3クライアントを作成
$s3 = new S3Client(array(
    'version' => 'latest',
    'credentials' => array(
        'key' => $key,
        'secret' => $secret,
    ),
    'region'  => 'us-east-1', // 米国(バージニア)
));

// アップロードされた画像の処理
$file = $_FILES['file']['tmp_name'];
if (!is_uploaded_file($file)) {
    return;
}

// S3バケットに画像をアップロード
$result = $s3->putObject(array(
    'Bucket' => $bucket,
    'Key' => time() . '.jpg',
    'Body' => fopen($file, 'rb'),
    'ACL' => 'public-read', // 画像は一般公開されます
    'ContentType' => mime_content_type($file),
));

// 結果を表示
echo "<pre>";
var_dump($result);
echo "</pre>";
?>

