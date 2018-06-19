<?php  // init.php
//
ob_start();
session_start();

// configの読み込み
require_once( __DIR__ . '/../config.php');
//
require_once( __DIR__ . '/db_connect.php');


// Smartyの設定
require_once('/vendor/smarty/libs/Smarty.class.php');
//
$smarty_obj  =  new Smarty();
$smarty_obj->setTemplateDir(__DIR__.'/../smarty/templates/');
$smarty_obj->setCompileDir(__DIR__.'/../smarty/templates_c/');

// エスケープを自動でonにする
$smarty_obj->escape_html = true;
//var_dump($smarty_obj);



