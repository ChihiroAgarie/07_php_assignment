<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型userリスト（入力画面）</title>
</head>

<body>
  <form action="user_create.php" method="POST">
    <fieldset>
      <legend>DB連携型userリスト（入力画面）</legend>
      <a href="user_read.php">一覧画面</a>
      <div>
        username: <input type="text" name="username">
      </div>
      <div>
        password: <input type="password" name="password">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>