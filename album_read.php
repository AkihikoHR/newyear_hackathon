<?php
session_start();
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// 画像を取得
$sql = 'SELECT * FROM img_table WHERE user_id=:user_id ORDER BY created_at ASC ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
$stmt->execute();
$images = $stmt->fetchAll();

if (isset($_SESSION['id'])) { //ログインしているとき
  $msg = $user_name . 'さんの今年の家族アルバムです';
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
  <title>家族アルバム</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1><?php echo $msg; ?></h1>
  <div>
    <ul>
      <?php for ($i = 0; $i < count($images); $i++) : ?>
        <li style="list-style-type:none;">
          <img src="images.php?id=<?= $images[$i]['id']; ?>">
          <div>
            <h5><?= $images[$i]['img_name']; ?> (<?= number_format($images[$i]['img_size'] / 1000, 2); ?> KB)</h5>
            <h3><?= $images[$i]['img_comment']; ?> </h3>
            <a href="#">削除</a>
        </li>
      <?php endfor; ?>
    </ul>
  </div>
  <div>
    <form action="guest_resist.php" method="POST">
      <fieldset>
        <legend>年賀状モード</legend>
        <div>
          共有相手の氏名: <input type="text" name="guest_name" required>
        </div>
        <div>
          共有相手のメールアドレス: <input type="text" name="guest_email" required>
        </div>
        <div>
          閲覧パスワード設定: <input type="password" name="guest_pw" required><br>
          ※閲覧パスワードは暗号化されずにそのまま相手に表示されます
        </div>
        年賀状メッセージ: <textarea name="message" cols="50" rows="5" required></textarea>
        <div>
          <input type="hidden" name="user_id" value="<?= $id ?>">
        </div>
        <input type="submit" value="ゲスト登録">
      </fieldset>
    </form>
  </div>
  <div><?php echo $link; ?></div>


  <script>
  </script>

</body>

</html>