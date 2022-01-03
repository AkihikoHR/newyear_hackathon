<?php

session_start();
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報更新</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <form action="user_update.php" method="POST">
    <fieldset>
      <legend>ユーザー情報変更</legend>
      <div>
        現在の氏名:<?php echo $user_name; ?>
      </div>
      <div>
        変更後の氏名<input type="text" name="user_name" value="<?php echo $user_name; ?>">
      </div>
      <div>
        現在のemail: <?php echo $user_email; ?>
      </div>
      <div>
        変更後のemail<input type="email" name="user_email" value="<?php echo $user_email; ?>">
      </div>
      <div>
        <input type="hidden" name="id" value="<?= $id ?>">
      </div>

      <input type="submit" value="ユーザー情報更新">
    </fieldset>
  </form>

</body>

</html>