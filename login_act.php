<?php
session_start();

// DB接続の設定
$dbn = 'mysql:dbname=gs_submit;host=localhost;charset=utf8';
$user = 'kikugawa'; // 作成したユーザー名に変更する
$pwd = 'hodaka'; // 作成したパスワードに変更する

try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

// データ受け取り
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

// データ取得SQL作成&実行
$sql = 'SELECT * FROM gs_bm_table WHERE user_name=:lid AND password=:lpw';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時にエラーがある場合
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("sqlError:" . $error[2]);
} else {
    $val = $stmt->fetch(PDO::FETCH_ASSOC); // 該当レコードだけ取得
    if ($val["ユニーク値"] != "") {
        // ログイン成功時
        $_SESSION = array(); // セッション変数を空にする
        $_SESSION["session_id"] = session_id();
        $_SESSION["is_admin"] = $val["is_admin"];
        $_SESSION["name"] = $val["name"];
        header("Location: select.php"); // select.phpへ移動
        exit();
    } else {
        // ログイン失敗時（エラー処理）
        echo '<script>alert("アカウントが見つかりませんでした。新たにアカウントを作成しますか？"); location.href="login.php";</script>';
    }
}
?>
