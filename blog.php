<?php
/*

データベースからブログのデータを持ってくる

*/

$host = 'localhost';
$db = 'blog';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

try{
    $pdo = new PDO($dsn,$user,$pass,$options);
}catch(PDOException $e){
    throw new PDOException($e->getMessage(),(int)$e->getCode());
}
global $blog_array;
$blog_array=array();
$sql="SELECT * FROM `blogcontent` ORDER BY `create_at` DESC;";
$stmt = $pdo->query($sql);
$blog_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
$pdo = null;

// 配列全体の 'newsDay' フィールドをフォーマット
$blog_array = array_map(function($blog) {
    // DateTimeオブジェクトに変換してからフォーマット
    $blog['create_at'] = (new DateTime($blog['create_at']))->format('Y.m.d');
    return $blog;
}, $blog_array);