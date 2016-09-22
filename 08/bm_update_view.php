<?php
//1. GETでidを取得
$id = $_GET["id"];

//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3.SELECT * FROM gs_bm_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  $row = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマーク更新画面</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
          <ul id="menu">
              <li><a class="navbar-brand" href="bm_insert_view.php">ブックマーク登録</a></li>
              <li><a class="navbar-brand" href="bm_list_view_2.php">ブックマーク一覧</a></li>
          </ul>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_update.php">
  <div class="jumbotron">
  <div id="box">
   <fieldset>
    <legend>ブックマーク更新</legend>
     <label>本の名前：<input type="text" name="book_name" value="<?=$row["book_name"]?>"></label><br>
     <label>URL：<input type="text" name="book_url" value="<?=$row["book_url"]?>"></label><br>
     <label><textArea name="book_cmt" rows="4" cols="40"><?=$row["book_cmt"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
