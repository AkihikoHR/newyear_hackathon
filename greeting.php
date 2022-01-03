<?php
session_start();
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];
$guest_id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>年賀状モード</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <form action="greeting_certif.php" method="POST">
    <h1><?= $user_name ?>さんから年賀状が届きました</h1>
    <fieldset>
      <legend>年賀状を見る</legend>
      <div>
        password: <input type="password" name="guest_pw" required>
      </div>
      <div>
        <input type="hidden" name="guest_id" value="<?= $guest_id ?>">
      </div>
      <input type="submit" value="送信">
    </fieldset>
  </form>

</body>

</html>