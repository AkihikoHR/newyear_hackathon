<?php
session_start();
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];
$guest_id = $_GET['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// ゲスト情報取得
$sql = 'SELECT * FROM guest_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $guest_id, PDO::PARAM_INT);
$stmt->execute();
$guest = $stmt->fetch();

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
    <P>ゲスト登録が完了しました。</P>
    <p>下記のURLとパスワードをコピーして相手に共有してください。</P>

    <h2>お名前</h2>
    <p><?= $guest["guest_name"] ?> 様
    <p>

    <h2>URL</h2>
    <p>localhost/G's/newyear_hackathon/greeting.php?id=<?= $guest["id"]; ?>
    <p>

    <h2>パスワード</h2>
    <p><?= $guest["guest_pw"] ?></P>

    <div>
        <button onclick="location.href='top.php'">トップページに戻る</button>
    </div>
</body>

</html>