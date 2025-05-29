<?php
declare(strict_types=1);
session_start();
/*

お問い合わせ入力のプログラム


*/
if (!isset($_SESSION['token'])) {
    // トークンの生成
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

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
            <?php if(isset($_SESSION['e'])){
                echo '<p class="ex-text">'.$_SESSION['e'].'</p>';
            }else{
                echo '<p class="ex-text">※必要事項を入力して下さい</p>';
            }?>
        </div>
        <form action="contact_check.php" method="POST">
            <div class="form-list">
                <label for="name">Name :</label>
                <input type="text" id="name" name="name" placeholder="お名前(または企業名)"
                    value="<?php if(isset($_SESSION['data']['name'])){echo $_SESSION['data']['name'];}?>" required />
            </div>
            <div class="form-list">
                <label for="email">Email :</label>
                <input type="email" id="name" name="email" placeholder="ご連絡が取れるメールアドレスを入力ください"
                    value="<?php if(isset($_SESSION['data']['email'])){echo $_SESSION['data']['email'];}?>" required />
            </div>
            <div class="form-list">
                <label for="content">Detail :</label>
                <textarea id="content" name="content" placeholder="お問い合わせ内容"
                    required><?php if(isset($_SESSION['data']['content'])){echo $_SESSION['data']['content'];}?></textarea>
            </div>

            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />

            <div class="submit">
                <input type="submit" value="確認する" name="submit" />
            </div>
        </form>
    </div>
</body>

</html>