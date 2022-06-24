<?php
session_start();
require_once('dbc.php');
// require_once('../common/head_parts.php');
loginCheck();

$title = '';
$content = '';
$Number = '';

if(!empty($_SESSION['post']['title'] )){
    $title = $_SESSION['post']['title'];
}

if(!empty($_SESSION['post']['content'] )){
    $content = $_SESSION['post']['content'];
}

if(!empty($_SESSION['post']['Number'] )){
    $content = $_SESSION['post']['Number'];
}

if(!empty($_SESSION['post']['Number'] )){
    $content = $_SESSION['post']['Number'];
}



?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>新規選手登録</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index01.php">選手一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- // もしURLパラメータがある場合 -->
    <?php if (isset($_GET['error'])): ?>
    <p class="text-danger">情報を入力してください</p>
    <?php endif ?>


    <form method="POST" action="confirm.php" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="img" class="form-label">写真</label>
            <br>
            <input type="file" name="img">
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">名前（漢字）</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="<?= $title ?>">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Name</label>
            <input type="text" class="form-control" name="content" id="content" aria-describedby="content" value="<?= $content ?>">
        </div>

        <div class="mb-3">
            <label for="Number" class="form-label">背番号</label>
            <input type="text" class="form-control" name="Number" id="Number" aria-describedby="Number" value="<?= $Number ?>">
        </div>

        <button type="submit" class="btn btn-primary">選手を登録する</button>
    </form>
</body>
</html>
