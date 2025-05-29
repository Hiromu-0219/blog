<?php
declare(strict_types=1);
session_start();
/*

login.phpからPOSTされてきたユーザー名とパスワードを確認する
適切ならnews_write.phpへ
不適ならlogout.phpを経由してlogin.phpへ戻る

*/

// データベース接続
require 'db_connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //ユーザー名が存在するか確認
    $stmt = $pdo->prepare('SELECT * FROM user_data WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if($user && password_verify($password,$user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;
        header('Location:news_write.php');
        exit;
    }else{
        header('Location:logout.php');
    }
}