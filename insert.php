
<?php
require_once "session.php";
check_login();
ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
error_reporting(E_ALL); // 全てのレベルのエラーを表示してください
ini_set('display_errors', 1);
error_reporting(E_ALL);

//1. POSTデータ取得
$book_name = $_POST['book_name'];
$book_url = $_POST['book_url'];
$book_comment = $_POST['book_comment'];

//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_submit;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
exit('DB Connection Error:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(`書籍名`,`書籍URL`,`書籍コメント`,`登録日時`)VALUES(:book_name, :book_url, :book_comment, sysdate());");
$stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  header("Location: index.php");
  exit();
}
?>