<?php
session_start();
include("functions.php");
ssidCheck();

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//1. GETデータ取得
$search_name = $_GET["search_name"];


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE book_name LIKE '%$search_name%'");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<tbody><tr><td>".$result["indate"]."</td>".'<td><a href="'.$result["book_url"].'" target="_blank">'.$result["book_name"]."</a></td>"."<td>".$result["book_cmt"]."</td></tr></tbody>";
  }
}

?>
<html lang="ja">
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク検索結果表示</title>
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
        <div class="theme">書籍名「<?=$search_name?>」の検索結果</div>
        <form method="get" action="search_name.php">
            書籍名で一覧から検索<input type="text" name="search_name">
            <input type="submit" value="検索">
        </form>
        <form method="get" action="search_cmt.php">
            コメントで一覧から検索<input type="text" name="search_cmt">
            <input type="submit" value="検索">
        </form>
        <div id="return">
            <a href="bm_list_view_2.php">ブックマーク一覧に戻る</a>
        </div>
        <table>
            <thead>
                <tr><th>登録日時</th><th>書籍名</th><th>コメント</th></tr>
            </thead>
            <?=$view?>
        </table>
       </div>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>