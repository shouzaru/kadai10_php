<?php
session_start();

require_once('dbc.php');
loginCheck();

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$Number = $_POST['Number'];
$img = '';
$imgName = '';



// imgがある場合
if($_FILES['img']['name']){
    $file_name = $_SESSION['post']['file_name'] = $_FILES['img']['name'];
    // 一時保存されているファイル内容を取得して、セッションに格納
    $image_data = $_SESSION['post']['image_data'] = file_get_contents($_FILES['img']['tmp_name']);
    // 一時保存されているファイルの種類を確認して、セッションにその種類に当てはまる特定のintを格納
    $image_type = $_SESSION['post']['image_type'] = exif_imagetype($_FILES['img']['tmp_name']);
}else{
    // 空白をセッションに格納
    $image_data = $_SESSION['post']['image_data'] = '';
    $image_type = $_SESSION['post']['image_type'] = '';
}


if ($_FILES['img']['name']) {
    $img = date('YmdHis') . '_' . $_FILES['img']['name'];
}


// 簡単なバリデーション処理。
if (trim($_POST['title']) === '') {
    $err[] = '名前（漢字）を入力してください。';
}
if (trim($_POST['content']) === '') {
    $err[] = 'Nameを入力してください';
}

if (trim($_POST['Number']) === '') {
    $err[] = '背番号を入力してください';
}


// もしerr配列に何か入っている場合はエラーなので、redirect関数でindexに戻す。その際、GETでerrを渡す。
if (count($err) > 0) {
    redirect('post.php?error=1');
}

/**
 * (1)$_FILES['img']['tmp_name']... 一時的にアップロードされたファイル
 * (2)'../picture/' . $image...写真を保存したい場所。先にフォルダを作成しておく。
 * (3)move_uploaded_fileで、（１）の写真を（２）に移動させる。
 */
if ($_FILES['img']['name']) {
    move_uploaded_file($_FILES['img']['tmp_name'], './images/' . $img);
}


//2. DB接続します
$pdo = dbc();





//３．データ登録SQL作成
if ($_FILES['img']['name']) {
    $stmt = $pdo->prepare('UPDATE content_table
                        SET
                            title = :title,
                            content = :content,
                            img = :img,
                            Number = :Number,
                            update_time = sysdate()
                        WHERE id = :id;');
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':img', $img, PDO::PARAM_STR);
    $stmt->bindValue(':Number', $Number, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
} else {
    //  画像がない場合imgは省略する。
    $stmt = $pdo->prepare('UPDATE content_table
                        SET
                            title = :title,
                            content = :content,
                            Number = :Number,
                            update_time = sysdate()
                        WHERE id = :id;');
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':Number', $Number, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
}

$status = $stmt->execute(); //実行

//４．データ登録処理後
if (!$status) {
    sql_error($stmt);
} else {
    redirect('index01.php');
}
