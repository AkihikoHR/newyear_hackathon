<?php

session_start();
$user_name = $_SESSION['user_name'];

if (isset($_SESSION['id'])) { //ログインしているとき
  $msg = 'こんにちは！' . $user_name . 'さん';
  $edit = '<a href="user_edit.php">ユーザー情報変更</a>';
  $link_img = 'img_input.php';
  $link_album = 'album_read.php';
  $link = '<a href="logout.php">ログアウト</a>';
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
  <title>ホーム画面</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <h1><?php echo $msg; ?></h1>

  <h2>今年の家族アルバムをつくる</h2>

  <button onclick="location.href='<?php echo $link_img; ?>'">アルバムを作る</button>
  <button onclick="location.href='<?php echo $link_album; ?>'">アルバムを見る</button>

  <div> <?php echo $edit; ?></div>
  <div> <?php echo $link; ?></div>

</body>

</html>