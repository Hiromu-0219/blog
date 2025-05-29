<?php
declare(strict_types=1);
// ブラウザでエラーの確認
ini_set('display_errors',1);

// セッションを破棄する関数です
function deleteSession()
{
    if(ini_get('session.use_cookies')){
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params['path'],$params['domain'],$params['secure'],$params['httponly']);
    }
}
session_start();
if(isset($_SESSION['data'])&& ($_SESSION['flag']===true)){
    $date=$_SESSION['data']['date'];
    $name=$_SESSION['data']['name'];
    $email=$_SESSION['data']['email'];
    $content=$_SESSION['data']['content'];
    ?>

<body>

    <h2>お問い合わせ完了</h2>
    <pre><?php print_r($_SESSION);?></pre>
    <?php $_SESSION=[];?>
    <?php deleteSession();?>
    <?php session_destroy();?>
</body>
<?php
}else{
    deleteSession();
    session_destroy();
    header('Location:index.php');
}