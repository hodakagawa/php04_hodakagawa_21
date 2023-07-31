<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>フリーアンケート表示</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
        }

        .data-block {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .data-block a {
            text-decoration: none;
        }

        .data-block .unique-id {
            font-size: 12px;
            color: #777;
            margin-bottom: 5px;
        }

        .return-button {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .return-button a {
            display: inline-block;
            font-size: 18px;
            text-decoration: none;
            background-color: #337ab7;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .return-button .button-text {
            margin-right: 5px;
        }

        .delete-button {
            display: inline-block;
            font-size: 12px;
            background-color: #d9534f;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            margin-top: 5px;
            cursor: pointer;
        }

        .delete-all-button {
            display: inline-block;
            font-size: 18px;
            background-color: #ff0000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 5px;
            cursor: pointer;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0% { background-color: #ff0000; }
            50% { background-color: #ff5555; }
            100% { background-color: #ff0000; }
        }
    </style>
    <script>
        // 削除確認ダイアログを表示する関数
        function confirmDelete() {
            return confirm("本当に削除しますか？");
        }

        // 全て削除の確認ダイアログを表示する関数
        function confirmDeleteAll() {
            return confirm("本当に全て削除しますか？");
        }
    </script>
</head>
<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div class="container">
        <?php
        require_once "session.php";
        check_login();
        // 1. DB接続します
        try {
            $pdo = new PDO('mysql:dbname=gs_submit;charset=utf8;host=localhost','root','');
        } catch (PDOException $e) {
            exit('DB Connection Error:'.$e->getMessage());
        }

        // ２．データ登録SQL作成
        $stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
        $status = $stmt->execute();

        // ３．データ表示
        if ($status == false) {
            // execute（SQL実行時にエラーがある場合）
            $error = $stmt->errorInfo();
            exit("Error: " . $error[2]);
        } else {
            // Selectデータの数だけ自動でループしてくれる
            // FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
            while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="data-block">';
                echo '<div class="unique-id">ユニーク値：' . $res['ユニーク値'] . '</div>';
                echo '<a href="bm_update_view.php?ユニーク値=' . $res['ユニーク値'] . '">';
                echo '<p>書籍名：' . $res['書籍名'] . '</p>';
                echo '<p>書籍URL：' . $res['書籍URL'] . '</p>';
                echo '<p>書籍コメント：' . $res['書籍コメント'] . '</p>';
                echo '<p>登録日時：' . $res['登録日時'] . '</p>';
                echo '</a>';
                echo '<button class="delete-button" onclick="if(confirmDelete()) location.href=\'delete.php?ユニーク値=' . $res['ユニーク値'] . '\';">削除</button>';
                echo '</div>';
            }
        }
        ?>
        <div class="return-button">
            <a href="index.php" class="btn btn-primary">戻る</a>
            <button class="delete-all-button" onclick="if(confirmDeleteAll()) location.href='delete_all.php';">全部なかったことにする！！！</button>
        </div>
    </div>
    <!-- Main[End] -->

</body>
</html>