<?php

if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['user_pw']) || $_POST['user_pw'] == '' ||
    !isset($_POST['user_email']) || $_POST['user_email'] == ''
) {
    exit('ParamError');
}

$user_name = $_POST['user_name'];
$user_pw = password_hash($_POST['user_pw'], PASSWORD_DEFAULT);
$user_email = $_POST['user_email'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

//メールアドレス重複チェック
$sql = 'SELECT COUNT(*) FROM user_table WHERE user_email = :user_email';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_email', $user_email);
$stmt->execute([':user_email' => $user_email]);

if ($stmt->fetchColumn()) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="user_signup.php">戻る</a>';
} else {

    $sql = 'INSERT INTO user_table
 (id, user_name, user_pw, user_email, updated_at, created_at) values 
 (NULL, :user_name, :user_pw, :user_email, now(), now())';

    $stmt = $pdo->prepare($sql);

    // バインド変数を設定
    $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindValue(':user_pw', $user_pw, PDO::PARAM_STR);
    $stmt->bindValue(':user_email', $user_email, PDO::PARAM_STR);

    // SQL実行（実行に失敗すると `sql error ...` が出力される）
    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }

    $msg = '会員登録が完了しました';
    $link = '<a href="login_input.php">ログインページ</a>';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規ユーザー登録</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>
</body>

</html>