<?php
// var_dump($_GET['id']);

// 関数を記述したファイルの読み込み
include('functions.php');

// idをgetで受け取る
$id = $_GET['id'];

// 関数実行
$pdo = connect_to_db();

//SQL組み立て
$sql = 'DELETE FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

//クエリ実行
exec_query($stmt);

// 一覧画面にリダイレクト 
header('Location:user_read.php');
