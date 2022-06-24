<?php
// confirm.phpの中身は、ほとんどpost.phpに似ています。

session_start();
require_once('dbc.php');
// require_once('../common/head_parts.php');

loginCheck();

// post受け取る
// $title = $_POST['title'];
// $content = $_POST['content'];

//$_SESSIONに保存してファイルを跨いで使えるようにする
$title = $_SESSION['post']['title'] = $_POST['title'];
$content = $_SESSION['post']['content'] = $_POST['content'];
$Number = $_SESSION['post']['Number'] = $_POST['Number'];



// 簡単なバリデーション処理。
if(trim($title) === '' || trim($content) ===''){
    redirect('post.php?error=1');
}


// imgある場合
// var_dump($_FILES);

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

?>

<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>記事管理</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index01.php">選手一覧</a>
                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="post.php">投稿する</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">投稿一覧</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="logout.php">ログアウト</a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>

    <!-- errorを受け取ったら、エラー文出力。 -->

    <form method="POST" action="register.php" enctype="multipart/form-data" class="mb-3">

        <div class="mb-3">
            <label for="title" class="form-label">名前（漢字）</label>
            <input type="hidden"name="title" value="<?= $title ?>">
            <h2><?= $title ?></h2>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Name</label>
            <input type="hidden"name="content" value="<?= $content ?>">
            <h2><?= $content ?></h2>
        </div>

        <div class="mb-3">
            <label for="Number" class="form-label">背番号</label>
            <input type="hidden" name="Number" value="<?= $Number ?>">
            <h2><?= $Number ?></h2>
        </div>

        <?PHP if($image_data) :?>
            <div class="mb-3">
                <img src="image.php" alt="" width="300px">
            </div>
        <?php endif; ?>


        <button type="submit" class="btn btn-primary">選手を登録</button>
    </form>

    <a href="post.php?re-register=true">前の画面に戻る</a>
</body>
</html>
