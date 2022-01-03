<?php
session_start();
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];
$guest_id = $_GET['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// 画像を取得
$sql = 'SELECT * FROM img_table WHERE user_id=:user_id ORDER BY created_at ASC ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
$stmt->execute();
$images = $stmt->fetchAll();

// ゲスト情報を取得
$sql = 'SELECT * FROM guest_table WHERE id = :guest_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':guest_id', $guest_id);
$stmt->execute();
$guest = $stmt->fetch();


if (isset($_SESSION['id'])) {
  $msg = $user_name . 'さんから年賀状が届きました';
} else {
  $msg = '最初からやり直してください';
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
  <div class="wrapper">
    <h1><?php echo $msg; ?></h1>
    <h2><?php echo $guest['guest_name'] ?> 様</h2>
    <h2>あけましておめでとうございます</h2>
    <h3><?php echo $guest['message'] ?></h3>
    <h3>家族のアルバムをご覧ください</h3>

    <div>
      <ul>
        <?php for ($i = 0; $i < count($images); $i++) : ?>
          <li style="list-style-type:none;">
            <img src="images.php?id=<?= $images[$i]['id']; ?>">
            <h3><?= $images[$i]['img_comment']; ?> </h3>
          </li>
        <?php endfor; ?>
      </ul>
    </div>
  </div>

  <script>
  </script>

</body>

</html>