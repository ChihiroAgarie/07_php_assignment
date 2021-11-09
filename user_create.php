<?php
// 呼び出し(todo_create.php, todo_read.php, など) 
include('functions.php'); // 関数を記述したファイルの読み込み

if (
  !isset($_POST['username']) || $_POST['username'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

$pdo = connect_to_db(); // 関数実行

$sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at) VALUES(NULL, :username, :password,0 ,0,sysdate(), sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

exec_query($stmt);

header("Location:user_input.php");
exit();
