<?php
session_start();

// エラーメッセージ用変数
$message = "";

// Check if the user is logged in
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ログイン処理
    $lid = $_POST["lid"];
    $lpw = $_POST["lpw"];

    // ログイン失敗時（エラー処理）
    $message = "パスワードが正しくありません。";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 2rem;
        }
        .container {
            max-width: 600px;
        }
        .jumbotron {
            padding: 2rem 1rem;
            margin-bottom: 1rem;
        }
        textarea {
            resize: vertical;
        }
    </style>
</head>
<body>

<!-- Main[Start] -->
<div class="container">
    <?php if (!empty($message)) : ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="lid">ユーザー名:</label>
        <input type="text" name="lid" required>
        <label for="lpw">パスワード:</label>
        <input type="password" name="lpw" required>
        <input type="submit" value="ログイン">
    </form>
</div>
<!-- Main[End] -->

</body>
</html>
