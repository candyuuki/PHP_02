<?php

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
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
    background-color: #81D8D0;
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
<form method="post" action="insert.php" enctype="multipart/form-data">
<div class="wrapper">
  <div class="jumbotron">
   <fieldset>
    <legend>素敵なカフェをシェアしよう！</legend>
     <label>お店の名前：<input type="text" name="cafeName"></label><br>
     <label>URL：<input type="text" name="cafeUrl"></label><br>
     <label><textArea name="comment" rows="4" cols="40" placeholder="Say something about this cafe..."></textArea></label><br>
    <label>評価：<select name="reputation" id="reputation"></label><br>
      
      <option value="1">☆</option>
      <option value="2">☆☆</option>
      <option value="3">☆☆☆</option>
      <option value="4">☆☆☆☆</option>
      <option value="5">☆☆☆☆☆</option>
      </select><br>
  
     <label>画像を選択：</label>
     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
     <input type="file" name="image" id="image" accept="image/*" /><br>
        <span id="preview_area"></span><br>
     <input type="submit" value="送信" name="upload">
    </fieldset>
  </div>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
