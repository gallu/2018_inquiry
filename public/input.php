<?php // input.php
ob_start();
session_start();
require_once( __DIR__ . '/../config.php');

// 入力値の取得
/*
// いろいろな「入力値の取得方法」
$name = (string)@$_POST['name'];
$name = @$_POST['name'] ?? ''; // PHP7以降
$name = (string)filter_input(INPUT_POST, 'name');
if (true === isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = '';
}
*/
/*
// これで「ダメ」とは言わないが……
$name = @$_POST['name'] ?? '';
$address = @$_POST['address'] ?? '';
$body = @$_POST['body'] ?? '';
*/
//
$params = ['name', 'address', 'body'];
$input_data = []; // 入力値保存用
foreach($params as $p) {
    $input_data[$p] = @$_POST[$p] ?? '';
}
//var_dump($input_data);

// validate
$error_flg = [];

// 「address と body」は必須入力
if ('' === $input_data['address']) {
    // エラー
    $error_flg['address_empty'] = 1;
}
if ('' === $input_data['body']) {
    // エラー
    $error_flg['body_empty'] = 1;
}
//
if ([] !== $error_flg) {
    // form.phpにデータを渡す
    $_SESSION['input'] = $input_data;
    $_SESSION['error'] = $error_flg;

    // エラーが発生してる！！
    header('Location: ./form.php');
    exit;
}

// DBへの接続
// XXX 「横幅を画面に収める」為だけのsprintf：文字列連結でOK
$dsn  = sprintf("mysql:dbname=%s;host=%s;charset=%s"
            , $config['db']['dbname']
            , $config['db']['host']
            , $config['db']['charset'] );
$user = $config['db']['user'];
$pass = $config['db']['pass'];
// MySQL固有の設定
$opt = [
    // 静的プレースホルダを指定
    PDO::ATTR_EMULATE_PREPARES => false,
    // 複文禁止
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
];
try {
    $dbh = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    echo 'DB Connect error: ', $e->getMessage();
    exit;
}
//var_dump($dbh);

/* DBへのINSERT */
// 準備された文(プリペアドステートメント)の作成
$sql = 'INSERT INTO inquiry(name, address, body, created_at)
               VALUES(:name, :address, :body, now());';
$pre = $dbh->prepare($sql);
//var_dump($pre); exit;

// プレースホルダへの値のバインド
$pre->bindValue(':name'   , $input_data['name'], PDO::PARAM_STR); // 正しい
$pre->bindValue(':address', $input_data['address']); // 文字列なら省略可
$pre->bindValue(':body'   , $input_data['body']);

// SQLの実行
$r = $pre->execute();
//var_dump( $dbh->errorInfo() );
//var_dump($r); exit;

//
header('Location: fin.html');

