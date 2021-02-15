<?php
//例外処理
try{
  $db = new PDO('mysql:dbname=heroku_805ca66e29a361b; host=us-cdbr-east-03.cleardb.com; charset=utf8','b631d197289086','4f34bddb');
}catch(PDOException $e){
  print('DB接続エラー：' . $e->getMessage());
}
// try{
//   $db = new PDO('mysql:dbname=my_project; host=localhost; port=8889;charset=utf8','root','root');
// }catch(PDOException $e){
//   print('DB接続エラー：' . $e->getMessage());
// }
 ?>