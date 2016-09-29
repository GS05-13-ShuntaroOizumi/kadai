<?php
session_start();
include("functions.php");
ssidCheck();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録画面</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<?php include("bm_menu.html"); ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <div class="jumbotron">
  <div id="box">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>PASS：<input type="text" name="lpw"></label><br>
     <label>権限：　<input type="radio" name="kanri_flg" value=0>一般者　
                <input type="radio" name="kanri_flg" value=1>管理者
     </label><br>
     <input type="hidden" name="life_flg" value=0>
     <input type="submit" value="登録">
    </fieldset>
  </div>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
