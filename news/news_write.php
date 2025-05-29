<?php
declare(strict_types=1);
session_start();
/*

ニュース更新用のプログラム


*/
//ログインしているかの確認
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
    ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ニュース更新ページ</title>
</head>

<body>
    <h1>新しいニュースを追加</h1>
    <form action="news_input.php" method="POST">
        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title" required />
        </div>
        <div>
            <label for="content">内容</label>
            <input type="text" name="content" required />
        </div>
        <div>
            <input type="submit" value="submit" name="submit">
        </div>
    </form>
</body>

</html>
<?php
    echo '<a href="logout.php">Logout</a>';
}else{
    header('Location: logout.php');
    exit;
}