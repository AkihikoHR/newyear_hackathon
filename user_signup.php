<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規ユーザー登録</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <form action="user_resist.php" method="POST">
    <fieldset>
      <legend>新規ユーザー登録</legend>
      <div>
        氏名: <input type="text" name="user_name" required>
      </div>
      <div>
        password: <input type="password" name="user_pw" required>
      </div>
      <div>
        email: <input type="email" name="user_email" required>
      </div>
      <input type="submit" value="新規登録">
    </fieldset>
  </form>
  <p>すでに登録済みの方は<a href="login_input.php">こちら</a></p>

</body>

</html>