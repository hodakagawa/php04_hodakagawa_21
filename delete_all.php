<?php
require_once "session.php";
check_login();
try {
    $pdo = new PDO('mysql:dbname=gs_submit;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}

$stmt = $pdo->prepare("DELETE FROM gs_bm_table");
$status = $stmt->execute();

if ($status == false) {
    exit("Error: Delete all failed");
} else {
    header("Location: select.php");
    exit();
}
?>