<?php
// セッションの開始
// session_start();
// 関数ファイル読み込み
include('functions.php');
// idチェック関数の実行
// check_session_id();

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
  // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
  // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
  $output .= "</tr>";
}
unset($value);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todoリストログイン画面</title>
</head>

<body>
  <form action="todo_login_act.php" method="POST">
    <fieldset>
      <legend>todoリストログイン画面</legend>
      <div>
        username: <input type="text" name="username">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>Login</button>
      </div>
      <a href="todo_register.php">or register</a>
    </fieldset>
  </form>

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

</body>

</html>