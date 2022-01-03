<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <form action="login_certif.php" method="POST">
    <fieldset>
      <legend>ログイン</legend>
      <div>
        email: <input type="text" name="user_email" required>
      </div>
      <div>
        password: <input type="password" name="user_pw" required>
      </div>
      <input type="submit" value="ログイン">
    </fieldset>
  </form>

</body>

</html>