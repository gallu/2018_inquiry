<?php  // admin_list.php
//
require_once('init_admin_auth.php');

// DBへの接続
$dbh = db_connect($config);

// プリペアドステートメントの作成
$sql = 'SELECT * FROM inquiry ORDER BY created_at DESC LIMIT 0, 20;';
$pre = $dbh->prepare($sql);
// 値をバインド
// XXX 今回は(一旦)なし
// SQLの実行
$r = $pre->execute();

//データを取得
$data = $pre->fetchAll();
var_dump($data);

// 出力
$tmp_filename = 'admin_list.tpl';
require_once('./fin.php');
