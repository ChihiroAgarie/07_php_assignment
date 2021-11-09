<?php
// var_dump($_GET);

// 関数ファイル読み込み 
include("functions.php");
// 送信されたidをgetで受け取る 
$id = $_GET['id'];
// DB接続&id名でテーブルから検索
$pdo = connect_to_db();
$sql = 'SELECT * FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_STRと違うので注意！今回はidが数字なのでINT

exec_query($stmt);

// fetch()で1レコード取得できる.
$record = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($record);

// $todo = $record['todo'];
// $deadline = $record['deadline'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型userリスト（編集画面）</title>
</head>

<body>
  <form action="user_update.php" method="POST">
    <fieldset>
      <legend>DB連携型userリスト（編集画面）</legend>
      <a href="user_read.php">一覧画面</a>
      <div>
        username: <input type="text" name="username" value="<?= $record['username'] ?>">
      </div>
      <div>
        password: <input type="text" name="password" value="<?= $record['password'] ?>">
      </div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
      <div>
        <button>submit</button>
      </div>

    </fieldset>
  </form>

</body>

</html>