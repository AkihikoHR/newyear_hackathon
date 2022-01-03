<?php

session_start();
$_SESSION = array();
session_destroy();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p>ログアウトしました</p>
    <a href="login_input.php">ログインへ</a>
</body>

</html>