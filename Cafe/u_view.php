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
//3.SELECT * FROM cafe_table WHERE id=:id;
$stmt = $pdo->prepare("SELECT * FROM cafe_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4.データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  // 1データのみの抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <style>
  div{
    padding: 10px;font-size:16px;
  }

  *{
    /* background-color: #81D8D0; */
    background-color: #eeeeee;

}
  .wrapper{
    /* background-color: #81D8D0; */
    background-color: #B29663;

    /* background-color: #eeeeee; */
  }
  fieldset{
    /* background-color: #eeeeee; */

  }
  a {
    text-decoration: none;
    color: #B29663;
  }
  </style>
  <!-- フォーム -->
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">カフェ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
<div class="wrapper">
  <div class="jumbotron">
   <fieldset>
    <legend>投稿の内容を変更する</legend>
     <label>お店の名前：<input type="text" name="cafeName" value="<?=$row["cafeName"]?>"></label><br>
     <label>URL：<input type="text" name="cafeUrl" value="<?=$row["cafeUrl"]?>"></label><br>
     <label><textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
    <label>評価：<select name="reputation" id="reputation" value="<?=$row["reputation"]?></label><br>
      <option value="1">☆</option>
      <option value="2">☆☆</option>
      <option value="3">☆☆☆</option>
      <option value="4">☆☆☆☆</option>
      <option value="5">☆☆☆☆☆</option>
      </select><br>

      <!-- <label>画像を選択：</label>
     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
     <input type="file" name="image" id="image" accept="image/*" /><br>
        <span id="preview_area"></span><br> -->
        <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
  </div>

</form>
<!-- Main[End] -->


</body>
</html>
