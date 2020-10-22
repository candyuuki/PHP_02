<?php

//1.  GETでid値を取得
$id = $_GET["id"];


//2.DB接続など
try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=cafe;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage()); // データベース接続できない時 DBConnectError
}

//3.UPDATE cafe_table SET ....; で更新(bindValue)
$stmt = $pdo->prepare("DELETE FROM cafe_table WHERE id=:id");
// $stmt = $pdo->prepare($spl);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if ($status==false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  // 1データのみの抽出の場合はwhileループで取り出さない
  header("Location: select.php");
  exit;

}
?>
