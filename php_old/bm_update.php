<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1. POSTデータ取得
$book_name = $_POST["book_name"];
$book_url = $_POST["book_url"];
$book_comment = $_POST["book_comment"];
$id = $_POST["id"];   //idを取得

// 2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数

// ３．データ登録SQL作成
$sql = "UPDATE gs_bm_table SET `書籍名`=:book_name, `書籍URL`=:book_url, `書籍コメント`=:book_comment WHERE ユニーク値=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':book_name',  $book_name,   PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url,  PDO::PARAM_STR);
$stmt->bindValue(':book_comment', $book_comment,  PDO::PARAM_STR);
$stmt->bindValue(':id', $id,  PDO::PARAM_INT);
$status = $stmt->execute(); //実行

// ４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("select.php");
}
?>