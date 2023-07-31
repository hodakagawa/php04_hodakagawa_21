<?php
require_once "session.php";
check_login();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("funcs.php");  //funcs.phpを読み込む（関数群）

// １．PHP
$id = $_GET["ユニーク値"] ?? "";

if ($id === "") {
    exit("Invalid ID"); // idが取得できない場合はエラーメッセージを表示して終了
}

$pdo = db_conn();      //DB接続関数

$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE ユニーク値=:id"); // カラム名を修正
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

if ($status == false) {
    //SQLエラーの場合
    sql_error($stmt);
}

$row = $stmt->fetch(PDO::FETCH_ASSOC); //データを取得

// データが存在しない場合はエラーメッセージを表示して終了
if (!$row) {
    exit("Data not found");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="bm_update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>フリーアンケート</legend>
                <label>書籍名：<input type="text" name="book_name" value="<?= htmlspecialchars($row["書籍名"], ENT_QUOTES, 'UTF-8') ?>"></label><br>
                <label>書籍URL：<input type="text" name="book_url" value="<?= htmlspecialchars($row["書籍URL"], ENT_QUOTES, 'UTF-8') ?>"></label><br>
                <label>書籍コメント：<textarea name="book_comment" rows="4" cols="40"><?= htmlspecialchars($row["書籍コメント"], ENT_QUOTES, 'UTF-8') ?></textarea></label><br>
                <!-- idを隠して送信 -->
                <input type="hidden" name="id" value="<?= $id ?>">
                <!-- idを隠して送信 -->
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>
</html>