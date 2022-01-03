<?php

session_start();
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];

if (isset($_SESSION['id'])) { //ログインしているとき
  $msg = $user_name . 'さんのお気に入りの家族写真を選んでください';
  $link = '<a href="top.php">ホームへ</a>';
} else {
  $msg = 'ログインしていません';
  $link = '<a href="login_input.php">ログイン</a>';
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>写真を選ぶ</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1><?php echo $msg; ?></h1>
  <form action="img_create.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>写真をアップロードする</legend>
      <div>
        <input type="file" id="inputfile" name="image" required>
      </div>
      <div>
        一言コメント: <input type="text" name="comment" required>
      </div>
      <div>
        <input type="hidden" name="user_id" value="<?= $id ?>">
      </div>
      <div>
        <button>アップロード</button>
      </div>
    </fieldset>
  </form>

  <div><?php echo $link; ?></div>

</body>

</html>