<?php
//1. POSTデータ取得
$id        = $_POST["id"];
$name   = $_POST["name"];
$lid    = $_POST["lid"];
$lpw    = $_POST["lpw"];
$kanri_flg   = $_POST["kanri_flg"];
$life_flg    = $_POST["life_flg"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//3．データ更新SQL作成
$stmt = $pdo->prepare("UPDATE gs_user_table SET name=:a1, lid=:a2, lpw=:a3, kanri_flg=:a4, life_flg=:a5 WHERE id=:id");

$stmt->bindValue(':a1', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ更新処理後
if($status==false){
  queryError($stmt);
}else{
  header("Location: user_select.php");
  exit;
}
?>
