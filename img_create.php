<?php
session_start();

// DB接続
include('functions.php');
$pdo = connect_to_db();

// POSTデータ確認

if (
    !isset($_POST['user_id']) || $_POST['user_id'] == '' ||
    !isset($_POST['comment']) || $_POST['comment'] == ''
) {
    exit('ParamError');
}

$user_id = $_POST['user_id'];
$comment = $_POST['comment'];

// 画像を保存
if (!empty($_FILES['image']['name'])) {
    $name = $_FILES['image']['name'];
    $type = $_FILES['image']['type'];
    $content = file_get_contents($_FILES['image']['tmp_name']);
    $size = $_FILES['image']['size'];

    $sql = 'INSERT INTO img_table
               (id, user_id, img_name, img_type, img_content, img_comment, img_size, created_at)
                VALUES (NULL, :user_id, :img_name, :img_type, :img_content, :img_comment, :img_size, now())';
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindValue(':img_name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':img_type', $type, PDO::PARAM_STR);
    $stmt->bindValue(':img_content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':img_comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':img_size', $size, PDO::PARAM_INT);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
}
header('Location:img_input.php');
exit();
