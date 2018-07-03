<?php  // admin_update.php
//
require_once('init_admin_auth.php');

// 返信内容を取得
$body = (string)@$_POST['response_body'];
var_dump($body);

// IDを取得
// CSRF対策
// 返信内容をDBに登録

// Locationで詳細画面に戻す
