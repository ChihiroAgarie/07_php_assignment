<?php
// var_dump($_POST);
// exit();

// セッションの開始
session_start();
// 関数ファイル読み込み
include('functions.php');
// DB接続
$pdo = connect_to_db();
// データ受け取り→変数に入れる
$username = $_POST['username'];
$password = $_POST['password'];
// DBにデータがあるかどうか検索
$sql = 'SELECT * FROM users_table 
WHERE username=:username 
AND password=:password
AND is_deleted=0';
// WHEREで条件を指定!

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR); //数字の場合はPARAM_INT
exec_query($stmt); //functionsにある変数を実行

// DBのデータ有無で条件分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC); // 該当レコードだけ取得 
if (!$val) { // 該当データがないときはログインページへのリンクを表示
    echo "<p>ログイン情報に誤りがあります.</p>";
    echo '<a href="todo_login.php">login</a>';
    exit();
}
// DBにデータがあればセッション変数に格納
else {
    $_SESSION = array(); // セッション変数を空にする 
    $_SESSION["session_id"] = session_id(); //セッションid生成
    $_SESSION["is_admin"] = $val["is_admin"]; //DBからとってきたis_adminの値を入れる
    $_SESSION["username"] = $val["username"]; //DBからとってきたusernameの値を入れる
    header("Location:todo_read.php"); // 一覧ページへ移動 
    exit();
}
