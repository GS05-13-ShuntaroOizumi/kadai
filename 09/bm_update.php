<?php
//1. POSTデータ取得
$id        = $_POST["id"];
$book_name = $_POST["book_name"];
$book_url  = $_POST["book_url"];
$book_cmt  = $_POST["book_cmt"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//3．データ更新SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET book_name=:book_name, book_url=:book_url, book_cmt=:book_cmt WHERE id=:id");

$stmt->bindValue(':book_name',  $book_name,   PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url,  PDO::PARAM_STR);
$stmt->bindValue(':book_cmt',$book_cmt, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ更新処理後
if($status==false){
  queryError($stmt);
}else{
  header("Location: bm_list_view_2.php");
  exit;
}
?>
