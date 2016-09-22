<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマーク登録画面</title>
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
<form method="post" action="bm_insert.php">
  <div class="jumbotron">
  <div id="box">
   <fieldset>
    <legend>ブックマーク登録</legend>
     <label>本の名前：<input type="text" name="book_name"></label><br>
     <label>URL：<input type="text" name="book_url"></label><br>
     <label><textArea name="book_cmt" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="登録">
    </fieldset>
  </div>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
