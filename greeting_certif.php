<?php
session_start();
$guest_id = $_POST['guest_id'];
$guest_pw = $_POST['guest_pw'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'SELECT * FROM guest_table WHERE id = :guest_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':guest_id', $guest_id);
$stmt->execute();
$guest = $stmt->fetch();

//ハッシュがパスワードにマッチしているかチェック
if ($guest_pw == $guest['guest_pw']) {

  $msg = 'パスワードを確認しました。';
  $link = '<a href="greeting_card.php?id=' . $guest_id . '">年賀状を見る</a>';
} else {
  $msg = 'パスワードが間違っています。';
  $link = '<a href="greeting.php?id=' . $guest_id . '" >戻る</a>';
}
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
  <h1><?php echo $msg; ?></h1>
  <?php echo $link; ?>
</body>

</html>