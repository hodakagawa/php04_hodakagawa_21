<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
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
    </style>
</head>
<body>

<!-- Main[Start] -->
<div class="container">
    <form action="select.php" method="post">
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
