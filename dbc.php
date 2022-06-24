<?php

//2. DB接続する

function dbc()                                                  //データベースに接続する関数を作るぞ！
{
    $host = "localhost";                                        //MAMPのデータベースを作成したときに使った名前などを関数に入れておく
    $dbname = "file_db5";
    $user = "root";                                             //とりあえず初期設定
    $pass = "root";

    $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";      //PHPのPDOオブジェクトの第一引数に入れる「接続文字列」を変数に入れてます。

    try{
    $pdo = new PDO($dns, $user, $pass,                      //PHPのPDOオブジェクト（PHP Data Object）を作成。PDOを呼び出す。参考：https://www.youtube.com/watch?v=zz7KzILdBpU&list=PLCyDm9NTxdhIwBK3hsY_2GNg8BPgLMV1M&index=3
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        //エラーモード
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC    //デフォルトFETCHモード
    ]);
    return $pdo;                                            //関数dbc()を動かしたときにPDOを使えるようになる

    }catch(PDOException $e){                                    //例外が発生したときの処理。PDOExceptionを変数eに入れる
    exit($e->getMessage());                                     //エラーの時はexitで止める。getMessage()という関数呼ぶ
    }
}


// phpMyadminにINSERTする関数fileSave()
function fileSave($dateInput, $filename, $save_path, $caption){
    $result = False;                                            //returnで返す値の初期値はFalseとする。

    $sql = "INSERT INTO file_table2 (dateInput, file_name, file_path, caption) VALUE(?, ?, ?, ?)";  //データを登録するSQL構文。phpMyAdminで作ったテーブルfile_tableの３つのカラムに、VALUE（入れたい値）を入れる。
    
    try
    {
        $stmt = dbc()->prepare($sql);                       //SQLの準備
        $stmt->bindValue(1, $dateInput);                     //execute()を実行する前にbindValue()でVALUEの「?」に値を入れる
        $stmt->bindValue(2, $filename);                     //execute()を実行する前にbindValue()でVALUEの「?」に値を入れる
        $stmt->bindValue(3, $save_path);
        $stmt->bindValue(4, $caption);
        $result = $stmt->execute();                         //SQLを実行する。成功したらtrueが返ってくる。
        return $result;                 
    }
    catch(\Exception $e)                                    //例外処理をキャッチ。
    {
        echo $e->getMessage();
        return $result;
    }
}


// SQLから全てのデータを取得する関数getAllFile()
function getAllFile()
{
    $sql = "SELECT * FROM file_table2";

    $fileData = dbc()->query($sql);

    return $fileData;
}

//htmlタグがPOSTされた時のエスケープ
function h($s){
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header('Location:' . $file_name);
    exit();
}

// ログインチェク処理 loginCheck()
function loginCheck(){
    if($_SESSION['chk_ssid'] != session_id()){          //loginできていない場合
    // if (!empty($_SESSION['chk_ssid']) && $_SESSION['chk_ssid'] != session_id()) {
        redirect('login.php');
        exit('LOGIN ERROR');
    }else{                                              //loginが出来ていたら、安全のために鍵を新しく発行し、交換する（入れる）
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}



?>