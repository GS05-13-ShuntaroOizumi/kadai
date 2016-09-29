<?php
session_start();
include("functions.php");
ssidCheck();
//1. GETでidを取得
$id = $_GET["id"];

//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3.SELECT * FROM gs_bm_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
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
  <title>ユーザーデータ更新画面</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<?php include("bm_menu.html"); ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <div class="jumbotron">
  <div id="box">
   <fieldset>
    <legend>ユーザーデータ更新</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>ID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>PASS：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <label>権限：　<input type="radio" name="kanri_flg" value=0>一般者　
                <input type="radio" name="kanri_flg" value=1>管理者
     </label><br>
     <label>状況：　<input type="radio" name="life_flg" value=0>使用中　
                <input type="radio" name="life_flg" value=1>使用停止
     </label><br>
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
