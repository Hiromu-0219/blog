<?php
declare(strict_types=1);
require 'db_connection.php';
$username = 'example_user';
$password = 'example_password';

//パスワードのハッシュ化
$hashed_password = password_hash($password,PASSWORD_DEFAULT);

//データベースに挿入
$stmt = $pdo->prepare('INSERT INTO user_data (username, password) VALUES (?,?)');
$stmt->execute([$username,$hashed_password]);

echo "User registered!";
?>