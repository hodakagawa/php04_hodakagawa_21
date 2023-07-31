<?php
try {
    $pdo = new PDO('mysql:dbname=gs_submit;charset=utf8;host=localhost','root','');
    //$pdo = new PDO('mysql:dbname=hodakagawa_gs_submit;charset=utf8;host=mysql655.db.sakura.ne.jp','hodakagawa','hoda3615'); 
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