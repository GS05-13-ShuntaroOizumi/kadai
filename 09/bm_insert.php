<?php
session_start();
include("functions.php");
ssidCheck();

//1. POSTデータ取得
$book_name   = $_POST["book_name"];
$book_url  = $_POST["book_url"];
$book_cmt = $_POST["book_cmt"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, book_name, book_url, book_cmt,
indate )VALUES(NULL, :a1, :a2, :a3, sysdate())");
$stmt->bindValue(':a1', $book_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $book_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $book_cmt, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}
?>
<html lang="ja">
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク登録完了</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<?php include("bm_menu.html"); ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
       <div id="box">
        <div class="theme">書籍の登録が完了しました。</div>
        <table>
            <thead>
                <tr><th>書籍名</th><th>コメント</th></tr>
            </thead>
                <tr><td><?=$book_name?></td><td><?=$book_cmt?></td></tr>
        </table>
        <form method="get" action="search_name.php">
            書籍名で一覧から検索<input type="text" name="search_name">
            <input type="submit" value="検索">
        </form>
        <form method="get" action="search_cmt.php">
            コメントで一覧から検索<input type="text" name="search_cmt">
            <input type="submit" value="検索">
        </form>
        <div id="return">
            <a href="bm_insert_view.php">ブックマーク登録</a>
        </div>
        <div id="return">
            <a href="bm_list_view_2.php">ブックマーク一覧</a>
        </div>
       </div>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>