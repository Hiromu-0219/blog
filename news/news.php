<?php
declare(strict_types=1);
require 'db_news_connection.php';

/*

データベース「news」からデータを取り出すプログラム
配列$news_arrayに逆順で入っている

*/
global $news_array;
$news_array=array();

$sql="SELECT * FROM `news`;";
$stmt = $pdo->query($sql);
$news_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
$pdo = null;

// 配列全体の 'newsDay' フィールドをフォーマット
$news_array = array_map(function($news) {
    // DateTimeオブジェクトに変換してからフォーマット
    $news['newsDay'] = (new DateTime($news['newsDay']))->format('Y.m.d');
    return $news;
}, $news_array);

$news_array = array_reverse($news_array);


/*使用例*/ 

// for($i=0;$i<2;$i++){
//     echo $news_array[$i]['newsDay'];
//     echo $news_array[$i]['newsTitle'];
//     echo $news_array[$i]['newsContent'];
// }


// foreach($news_array as $news):
//     echo $news['newsDay'];
//     echo $news['newsTitle'];
//     echo $news['newsContent'];
// endforeach;
?>