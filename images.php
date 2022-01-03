<?php

// DB接続
include('functions.php');
$pdo = connect_to_db();

$sql = 'SELECT * FROM img_table WHERE id=:id LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch();

header('Content-type: ' . $image['img_type']);
echo $image['img_content'];
exit();
