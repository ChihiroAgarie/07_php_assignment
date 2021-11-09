<?php
// var_dump($_POST);
// exit();

// 呼び出し(todo_create.php, todo_read.php, など) 
include('functions.php'); // 関数を記述したファイルの読み込み

if (
    !isset($_POST['username']) || $_POST['username'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' ||
    !isset($_POST['id']) || $_POST['id'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];

// var_dump('<pre>');
// var_dump($todo);
// var_dump('<pre>');
// var_dump($deadline);
// var_dump('<pre>');
// var_dump($id);
// var_dump('<pre>');

$pdo = connect_to_db();

$sql = "UPDATE users_table SET username=:username, password=:password,
updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

//関数を実行
exec_query($stmt);

header("Location:user_read.php");
exit();
