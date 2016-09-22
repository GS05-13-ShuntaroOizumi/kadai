<?php
//1. データ取得
$id        = $_GET["id"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//3．データ削除SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ削除処理後
if($status==false){
  queryError($stmt);
}else{
  header("Location: bm_list_view_2.php");
  exit;
}
?>