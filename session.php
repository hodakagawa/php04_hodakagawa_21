<?php
session_start();

// ユーザーがログインしているかどうかをチェック
function check_login() {
    if (!isset($_SESSION["session_id"]) || empty($_SESSION["session_id"])) {
        header("Location: login.php");
        exit();
    }
}
