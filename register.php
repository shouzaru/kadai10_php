<?php
session_start();
require_once('dbc.php');
loginCheck();

$title = $_POST['title'];
$content  = $_POST['content'];
$Number = $_POST['Number'];
$img = '';



// 簡単なバリデーション処理追加。
if(trim($title) === '' || trim($content) ===''){
    redirect('post.php?error=1');
}

//名前を一意にするため時間を加えています
if($_SESSION['post']['image_data']){
    $img = date('YmdHis') . '_' . $_SESSION['post']['file_name'];
}

if($_SESSION['post']['image_data']){
    file_put_contents('./images/'. $img, $_SESSION['post']['image_data'] );
}


//2. DB接続します
$pdo = dbc();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO content_table(
                            title, content, img, Number, date
                        )VALUES(
                            :title, :content, :img, :Number, sysdate()
                        )');
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);
$stmt->bindValue(':Number', $Number, PDO::PARAM_STR);

$status = $stmt->execute(); //実行

//４．データ登録処理後
if (!$status) {
    sql_error($stmt);
} else {
    $_SESSION['post'] = [] ;
    redirect('index01.php');
}
