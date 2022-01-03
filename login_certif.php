<?php
session_start();
$user_email = $_POST['user_email'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'SELECT * FROM user_table WHERE user_email = :user_email';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_email', $user_email);
$stmt->execute();
$member = $stmt->fetch();

//ハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['user_pw'], $member['user_pw'])) {

  //DBのユーザー情報をセッションに保存

  $_SESSION['id'] = $member['id'];
  $_SESSION['user_name'] = $member['user_name'];
  $_SESSION['user_pw'] = $member['user_pw'];
  $_SESSION['user_email'] = $member['user_email'];

  $msg = 'ログインしました。';
  $link = '<a href="top.php">ホーム</a>';
} else {
  $msg = 'メールアドレスまたはパスワードが間違っています。';
  $link = '<a href="login_input.php">戻る</a>';
}
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
  <h1><?php echo $msg; ?></h1>
  <?php echo $link; ?>
</body>

</html>