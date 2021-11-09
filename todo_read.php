<?php
// セッションの開始
session_start();
// 関数ファイル読み込み
include('functions.php');
// idチェック関数の実行
check_session_id();

$pdo = connect_to_db();

$sql = 'SELECT * FROM todo_table';

$stmt = $pdo->prepare($sql);
exec_query($stmt);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "<tr>";
  $output .= "<td>{$record["deadline"]}</td>";
  $output .= "<td>{$record["todo"]}</td>";
  $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
  $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
  $output .= "</tr>";
}
unset($value);

// 追加
$sql = 'SELECT * FROM users_table';
$stmt = $pdo->prepare($sql);

try {
  $stmt->execute();
} catch (PDOException $e) {
  exit('sql error：' . $e->getMessage());
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SESSION["is_admin"] == 1) {
  $output_a = "";
  $output_a .= '<a href="user_input.php">入力画面</a>';
  $output1 = "";
  foreach ($result as $record) {
    $output1 .= "<tr>";
    $output1 .= "<td>{$record["username"]}</td>";
    $output1 .= "<td>{$record["password"]}</td>";
    // edit deleteリンクを追加
    $output1 .= "<td>
<a href='edit.php?id={$record["id"]}'>edit</a>
</td>";
    $output1 .= "<td>
<a href='delete.php?id={$record["id"]}'>delete</a>
</td>";
    $output1 .= "</tr>";
  }
} else {
  $output_a = "";
  $output1 = "";
  $output1 .= "<p>※管理者以外は閲覧できません</p>";
}
// $recordの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
// 今回は以降foreachしないので影響なし
unset($record);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型todoリスト（一覧画面）</legend>
    <a href="todo_input.php">入力画面</a>
    <a href="todo_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>todo</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
  <fieldset>
    <legend>DB連携型userリスト（一覧画面）</legend>
    <?= $output_a ?>
    <table>
      <thead>
        <tr>
          <th>username</th>
          <th>password</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output1 ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>