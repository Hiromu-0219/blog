<?php
declare(strict_types=1);
session_start();
/*

index.phpで入力された内容をcheckしてデータベースへ


*/


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "不正なリクエストです。";
        header('Location: index.php');
        exit;
    }
    if(isset($_POST['sendcheck']) && $_POST['sendcheck'] == $_SESSION['sendcheck']){
        require 'db_contact_connection.php';

        $date = date("Y.m.d");
        $name=$_SESSION['data']['name'];
        $email=$_SESSION['data']['email'];
        $content=$_SESSION['data']['content'];
        // データベースに挿入
        $stmt = $pdo->prepare('INSERT INTO contact (date, name, email, content) VALUES (?,?,?,?)');
        try{
            $stmt->execute([$date ,$name, $email, $content]);
            header('Location:thankyou.php');
        }catch(Exception $e){
            $_SESSION['e'] = "もう一度入力して下さい";
            $_SESSION['sendcheck']=NULL;
            header('Location:../contact');
            exit;
        }
        header('Location:thankyou.php');
    }
    $_SESSION['sendcheck'] = bin2hex(random_bytes(32));
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');

    // バリデーション
    if (empty($name) || empty($email) || empty($content)) {
        $_SESSION['e'] = "すべてのフィールドを入力してください。";
        header('Location:index.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['e'] = "正しいメールアドレスを入力してください。";
        
        header('Location:index.php');
        exit;
    }

    $_SESSION['data']['name']=$name;
    $_SESSION['data']['email']=$email;
    $_SESSION['data']['content']=$content;
    $_SESSION['flag'] = true;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Googlefont -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Slab:wght@100..900&family=Sacramento&family=Walter+Turncoat&display=swap"
        rel="stylesheet" />
    <title>コンタクトページ</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="box">
        <div class="title-box">
            <h1 class="title pop-3">CONTACT</h1>
            <h2 class="sub-title">お問い合わせ</h2>
            <p class="ex-text">※こちらの内容を送信してもよろしいですか</p>
        </div>
        <form action="" method="POST">
            <div class="form-list">
                <p class="pop-3">
                    Name : <span class="checkList"><?=$name?></span>
                </p>
            </div>
            <div class="form-list">
                <p class="pop-3">
                    Email : <span class="checkList"><?=$email?></span>
                </p>
            </div>
            <div class="form-list">
                <p class="pop-3">
                    Detail : <span class="checkList"><?=$content?></span>
                </p>
            </div>

            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
            <input type="hidden" name="sendcheck" value="<?php echo $_SESSION['sendcheck']; ?>" />

            <div class="submit">
                <input type="submit" value="お問い合わせする" name="submit" />
            </div>
            <div class="submit">
                <a class="submitBotton" href="index.php">戻る</a>
            </div>
        </form>
    </div>
</body>

</html>

<?php
}else{
    $_SESSION['e'] = "※もう一度入力して下さい";
    header('Location: ../contact/contact_check.php');
    exit;
}?>