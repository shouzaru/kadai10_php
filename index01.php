<?php
session_start();
require_once('dbc.php');
// require_once('common/footer.php');

$pdo = dbc();
$stmt = $pdo->prepare('SELECT * FROM content_table');
$status = $stmt->execute();

$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>EMSC選手一覧</title>
</head>

<body id="main">
    <!-- <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="post.php">登録する</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header> -->


    <div class="album py-5 bg-light">
        <figure class="text-center">
            <h1>選手一覧</h1>
        </figure>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-md-4 row-cols-md-5 g-3">
                <?php foreach ($contents as $content): ?>
                <!-- <a href="#"> -->
                    <div class="col">
                        <div class="card shadow-sm">

                            <!-- <img src="images/default_image/no_image_logo.png" alt="" class="bd-placeholder-img card-img-top" > -->
                            
                            <?php if ($content['img']): ?>
                                <img src="images/<?=$content['img']?>" alt="" class="bd-placeholder-img card-img-top img-thumbnail">
                            <?php else: ?>
                                <img src="images/default_image/no_image_logo.png" alt="" class="bd-placeholder-img card-img-top" >
                            <?php endif ?>
                                                
                            
                            
                            <div class="card-body">
                                <h3><?= $content['title'] ?></h3>
                                <h3><?= $content['content'] ?></h3>
                                <h3><?= $content['Number'] ?></h3>

                                
                                
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">登録日:<?= $content['date'] ?></small>
                                </div>
                                
                                <?php if (!is_null($content['update_time'])): ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">最終更新:<?= $content['update_time'] ?></small>
                                </div>
                                <?php endif ?>
                    
                                <?php if(!empty($_SESSION['kanri_flg']) && $_SESSION['kanri_flg'] === '1'):?>
                                <a href="detail.php?id=<?=$content['id']?>" class="btn btn-outline-info stretched-link">編集する</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                <!-- </a> -->
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
<div class="container">
<a href="./login.php" class="btn btn-success" role="button">Log in</a>

<?php if(!empty($_SESSION['kanri_flg']) && $_SESSION['kanri_flg'] === '1'):?>
<a href="./logout.php" class="btn btn-warning" role="button">Logout</a>
<a href="./post.php" class="btn btn-outline-primary" role="button">新規選手登録</a>
<?php endif ?>



</div>
<p class="mt-5 mb-3 text-muted">&copy;greyracoon 2022</p>
</footer>

</body>
</html>
