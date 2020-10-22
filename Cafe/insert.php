<?php


// データ飛ばす
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

// gs_db
//2. DB接続します
try {

  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=cafe;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage()); // データベース接続できない時 DBConnectError
}


//POSTの受け取りは$_POST["input名"];
$cafeName = $_POST["cafeName"];
$cafeUrl = $_POST["cafeUrl"];
$comment = $_POST["comment"];
$reputation = $_POST["reputation"];

// $image = $_POST["image"];

// 変数宣言の後にechoで確認
// echo $name;
// echo $email;
// echo $text;


//３．データ登録SQL作成

$stmt = $pdo->prepare("INSERT INTO cafe_table(id, cafeName , cafeUrl, comment, reputation, date)VALUES(NULL, :cafeName, :cafeUrl, :comment, :reputation, sysdate())");
$stmt->bindValue(':cafeName', $cafeName, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cafeUrl', $cafeUrl,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':reputation', $reputation, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


$status = $stmt->execute();
// $err_msgs = $stmt->execute();

// echo '$name';


//４．データ登録処理後 結果が入る
$view="";

if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  // $err_msgs = $stmt->errorInfo();
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  // 書き込みが成功した場合 header=移動処理 遷移
  header('Location: index.php');
  // １データのみの抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
  

}
?>
