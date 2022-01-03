<?php
session_start();

// 入力項目のチェック

$id = $_POST['id'];
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE user_table SET user_name=:user_name, 
user_email=:user_email, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':user_email', $user_email, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
};

$msg = 'ユーザー情報が変更されました';
$link = '<a href="login_input.php">再ログイン</a>';

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