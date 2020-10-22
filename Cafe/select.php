<?php
//1.  DB接続します
try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=cafe;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage()); // データベース接続できない時 DBConnectError
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM cafe_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // var_dump ($result);
    
    
    $view .= "<div class='container'>";
    $view .= "<div class='contents'>";
    $view .='<a href="u_view.php?id='.$result["id"].'"><span class="material-icons">
    local_cafe</span></a>';
    // $view .= '<a href="u_view.php?id='.$result["id"].'">< class="material-icons">
    // local_cafe</a>';
    $view .= '<p>'.$result['date'].'<br>'.'<a href="'.$result['cafeUrl'].'" class="cafeName">'.$result['cafeName'].'</a>'.'<br>'.$result['comment'].'<br>'.'評価：'.$result['reputation'].'<br>'.'</p>';
   
    //画像ありver 
    // $view .= '<p>'.$result['date'].'<br>'.'<a href="'.$result['cafeUrl'].'">'.$result['cafeName'].'</a>'.'<br>'.$result['comment'].'<br>'.$result['reputation'].'<br>'.'<img width="100" src="./img/'.$result['image'].'">'.'</p>';
    
    // $view .=' ';
    
    
    $view .= '<a href="delete.php?id='.$result["id"].'" class="delete">';
    $view .=' [Delete] ';
    $view .='</a>';
    $view .= "</div>";
    $view .= "</div>";
  };
  

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>カフェを記録</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
div {
  padding: 10px;font-size:16px;
}

*{
  background-color: #81D8D0;
}

.material-icons {
  position: absolute;
  margin-top: 16px;
  color: #503A2F;

}
.container{
  background-color: #eeeeee;
  
}

p{
  margin-left:32px

}
.cafeName {
  color: #B29663;
  font-size: 18px;
}
.navbar-brand{
  color: #B29663;
}

.delete{
  margin-left: 28px;
color: black;
}
a {
  text-decoration: none;
}

a:hover {
  color:#F5EDD2;
}

</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">訪れたカフェを登録する</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
