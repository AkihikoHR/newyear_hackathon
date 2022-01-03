<?php
session_start();
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];

if (
    !isset($_POST['guest_name']) || $_POST['guest_name'] == '' ||
    !isset($_POST['guest_email']) || $_POST['guest_email'] == '' ||
    !isset($_POST['guest_pw']) || $_POST['guest_pw'] == '' ||
    !isset($_POST['message']) || $_POST['message'] == ''
) {
    exit('ParamError');
}

$user_id = $_POST['user_id'];
$guest_name = $_POST['guest_name'];
$guest_email = $_POST['guest_email'];
$guest_pw = $_POST['guest_pw'];
$message = $_POST['message'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'INSERT INTO guest_table
          (id, user_id, guest_name, guest_email, guest_pw, message, created_at)
        VALUES (NULL, :user_id, :guest_name, :guest_email, :guest_pw, :message, now())';
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':guest_name', $guest_name, PDO::PARAM_STR);
$stmt->bindValue(':guest_email', $guest_email, PDO::PARAM_STR);
$stmt->bindValue(':guest_pw', $guest_pw, PDO::PARAM_STR);
$stmt->bindValue(':message', $message, PDO::PARAM_STR);
$stmt->execute();

// SQL作成&実行
$sql = 'SELECT * FROM guest_table WHERE guest_email=:guest_email';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':guest_email', $guest_email, PDO::PARAM_STR);
$stmt->execute();
$guest = $stmt->fetch();
$guest_id = (int)$guest["id"];

header('Location:guest_confirm.php?id=' . $guest_id);
exit();
