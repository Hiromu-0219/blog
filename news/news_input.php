<?php
declare(strict_types=1);
session_start();
date_default_timezone_set("Asia/Tokyo");
//ログインしているかの確認
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $newsTitle = $_POST['title'];
        $newsContent = $_POST['content'];
        $newsDay = date("Y.m.d");
        require 'db_news_connection.php';
        //データベースに挿入
        $stmt = $pdo->prepare('INSERT INTO news (newsDay, newsTitle, newsContent) VALUES (?,?,?)');
        $stmt->execute([$newsDay,$newsTitle,$newsContent]);
        ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>以下のnewsを追加しました</p>
    <p><?=$newsTitle ?></p>
    <p><?=$newsContent ?></p>
    <p><?=$newsDay ?></p>
    <a href="logout.php">Logout</a>

</body>

</html>




<?php
    }else{
        header('Location: news_write.php');
        
    }
}else{
    header('Location: logout.php');
    exit;
}