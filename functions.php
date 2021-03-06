<?php

function connect_to_db()
{
  $dbn = 'mysql:dbname=gsacf_d09_01;charset=utf8;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    exit('DB エラー:' . $e->getMessage());
  }
}

function exec_query($stmt)
{
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    exit('SQL エラー：' . $e->getMessage());
  }
}

// ログイン状態のチェック関数
function check_session_id()
{
  // 失敗時はログイン画面に戻る
  if (
    !isset($_SESSION['session_id']) || // session_idがない
    $_SESSION['session_id'] != session_id() // idが一致しない（左側：session関数でとってきたid、右側：今ログインしたユーザーのid ）
  ) {
    header('Location: todo_login.php'); // ログイン画面へ移動 
  } else {
    session_regenerate_id(true); // セッションidの再生成
    $_SESSION['session_id'] = session_id(); // セッション変数上書き 
  }
}
