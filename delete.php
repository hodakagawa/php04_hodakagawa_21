<?php
require_once "session.php";
check_login();
// １．PHP
$id = $_GET["ユニーク値"] ?? "";
if ($id === "") {
    exit("Invalid ID");
}

try {
    $pdo = new PDO('mysql:dbname=gs_submit;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}

$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE ユニーク値=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    exit("Error: Delete failed");
} else {
    header("Location: select.php");
    exit();
}
?>