<?php
//1. POSTでid,name,commentを取得
$id = $_GET["id"];
$cafeName = $_POST["cafeName"];
$cafeUrl = $_POST["cafeUrl"];
$comment = $_POST["comment"];
$reputation = $_POST["reputation"];

// 2.DB接続
try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=cafe;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage()); // データベース接続できない時 DBConnectError
}

//3.UPDATE cafe_table SET ....;で更新(bindValue)
$stmt = $pdo->prepare("UPDATE cafe_table SET cafeName=:cafeName, cafeUrl=:cafeUrl, comment=:comment, reputation=:reputation WHERE id=:id");
// $stmt = $pdo->prepare($spl);
$stmt->bindValue(':cafeName', $cafeName, PDO::PARAM_STR);
$stmt->bindValue(':cafeUrl', $cafeUrl, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':reputation', $reputation, PDO::PARAM_INT); 
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  // select.phpへレダイレクト
  header("Location: select.php");
 exit;

}
?>
