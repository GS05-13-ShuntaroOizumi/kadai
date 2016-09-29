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

//２．データ読み込みSQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
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
    $view .= "<tbody><tr><td>".$result["indate"]."</td>".'<td><a href="'.$result["book_url"].'" target="_blank">'.$result["book_name"]."</a></td>"."<td>".$result["book_cmt"]."</td>";
    $view .= '<td><a href="bm_update_view.php?id='.$result["id"].'">';
    $view .= '[更新]';
    $view .= '</a></td>';
    $view .= '<td><a href="bm_delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a></td>';
    $view .= '</tr></tbody>';  
  }

}
?>

<html lang="ja">
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧表示</title>
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
        <div>ようこそ <?php echo $_SESSION["name"] ?> さん</div>
        <div class="theme">ブックマーク一覧</div>
        <form method="get" action="search_name.php">
            書籍名で一覧から検索<input type="text" name="search_name">
            <input type="submit" value="検索">
        </form>
        <form method="get" action="search_cmt.php">
            コメントで一覧から検索<input type="text" name="search_cmt">
            <input type="submit" value="検索">
        </form>
        <table>
            <thead>
                <tr><th>登録日時</th><th>書籍名</th><th>コメント</th><th></th><th></th></tr>
            </thead>
            <?=$view?>
        </table>
       </div>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
