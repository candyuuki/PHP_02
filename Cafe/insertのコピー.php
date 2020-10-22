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

// 画像ファイル関連の取得
$file = $_FILES['image'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = '/Applications/MAMP/htdocs/upload/images/';
$save_filename = date('YmdHis'). $filename;
$err_msgs = array();
$save_path = $upload_dir . 

// var_dump($file);

require_once "./dbc.php";

// キャプションを取得
$comment = filter_input(INPUT_POST, 'comment',
FILTER_SANITIZE_SPECIAL_CHARS);

// キャプションのバリデーション
// 未入力
if(empty($comment)){
  array_push($err_msgs,'キャプションを入力してください。');
  echo '<br>';
}
// １４０文字
if(strlen($comment) > 140) {
  array_push($err_msgs,'キャプションは140文字以内で入力してください。');
}

// ファイルのバリデーション
// ファイルのサイズが1MB未満か
if($filesize > 1048576 || $file_err ==2) {
  array_push($err_msgs,'画像ファイルを添付してください。');

  array_push($err_msgs,'ファイルサイズは1MB未満にしてください。');
}

// 拡張子は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext),$allow_ext)) { //strtplowerで.JPG大文字も小文字にしてくれる
  array_push($err_msgs,'画像ファイルを添付してください。');
  echo '<br>';
}
if (count($err_msgs) === 0){
// ファイルはあるかどうか？
if(is_uploaded_file($tmp_path)) {
  if(move_uploaded_file($tmp_path, $upload_dir. $save_filename)) {
echo $filename . 'を'. $upload_dir . 'アップしました。';
// DBに保存(ファイル名、ファイルパス、キャプション)
$result = fileSave($filename, );
  } else {
    array_push($err_msgs,'ファイルが保存できませんでした。');

  }
  // echo $filename . 'アップしました。';
} else {
echo 'ファイルが選択されていません。';
echo '<br>';
}
} else {
  foreach($err_msgs as $msg) {
    echo $msg;
    echo '<br>';
  }
}


//３．データ登録SQL作成
// $stmt = $pdo->prepare("INSERT INTO cafe_table(id, cafeName , cafeUrl, comment, reputation, image, date)VALUES(NULL, :cafeName, :cafeUrl, :comment, :reputation, image, sysdate())");
$stmt = $pdo->prepare("INSERT INTO cafe_table(id, cafeName , cafeUrl, comment, reputation, date)VALUES(NULL, :cafeName, :cafeUrl, :comment, :reputation, sysdate())");
$stmt->bindValue(':cafeName', $cafeName, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cafeUrl', $cafeUrl,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':reputation', $reputation, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':image', $image, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


$status = $stmt->execute();
// $err_msgs = $stmt->execute();

// echo '$name';


//４．データ登録処理後 結果が入る
$view="";
// if($err_msgs==$err_msgs){
// if($status==$err_msgs){

// if($err_msgs==true){
//   $error = $stmt->errorInfo();
//   exit("ErrorMessage:".$error[2]);
// }else{
//   //５．index.phpへリダイレクト
//   // 書き込みが成功した場合 header=移動処理 遷移
//   header('Location: index.php');
//   // １データのみの抽出の場合はwhileループで取り出さない
//   $row = $stmt->fetch();
  

// }
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
