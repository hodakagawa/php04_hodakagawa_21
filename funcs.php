<?php
require_once "session.php";
check_login();
// データベース接続
function db_conn()
{
    $dbn = 'mysql:dbname=gs_submit;charset=utf8;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        $pdo = new PDO($dbn, $user, $pwd);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

// SQLエラー関数
function sql_error($stmt)
{
    $error = $stmt->errorInfo();
    exit("SQL Error:" . $error[2]);
}

// XSS対策関数
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// リダイレクト関数
function redirect($page)
{
    header("Location: $page");
    exit;
}