<?php
session_start();
require_once('dbc.php');
// require_once('../common/head_parts.php');
loginCheck();

$id = $_GET['id'];
$pdo = dbc();
$img = '';

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM content_table WHERE id=:id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>内容更新</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index01.php">選手一覧</a>
                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="post.php">投稿する</a>
                    </li> -->
                    <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">投稿一覧</a>
                    </li> -->

                </ul>
            </div>
        </nav>
    </header>

    <?php if (isset($_GET['error'])): ?>
        <p class="text-danger">記入内容を確認してください</p>
    <?php endif;?>

    <form method="POST" action="update.php" class="mb-3" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="img" class="form-label">写真</label>
            <br>
            <img src="images/<?= $row["img"] ?>" alt="" width="200px">
            <br>
            <input type="file" class="form-control" name="img" id="img" aria-describedby="img">
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">名前（漢字）</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="<?= $row["title"] ?>">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Name</label>
            <input type="text" class="form-control" name="content" id="content" aria-describedby="content" value="<?= $row["content"] ?>">
        </div>

        <div class="mb-3">
            <label for="Number" class="form-label">Name</label>
            <input type="text" class="form-control" name="Number" id="Number" aria-describedby="Number" value="<?= $row["Number"] ?>">
        </div>


        <input type="hidden" name="id" id="id" aria-describedby="id" value="<?= $row["id"] ?>">
        <button type="submit" class="btn btn-primary">修正</button>
    </form>

    <form method="POST" action="delete.php?id=<?= $row['id'] ?>" class="mb-3">
        <button type="submit" class="btn btn-danger">削除</button>
    </form>
    
</body>

</html>
