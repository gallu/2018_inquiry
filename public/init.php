<?php  // init.php
//
ob_start();
session_start();

// config�̓ǂݍ���
require_once( __DIR__ . '/../config.php');

// Smarty�̐ݒ�
require_once('/vendor/smarty/libs/Smarty.class.php');
//
$smarty_obj  =  new Smarty();
$smarty_obj->setTemplateDir(__DIR__.'/../smarty/templates/');
$smarty_obj->setCompileDir(__DIR__.'/../smarty/templates_c/');

// �G�X�P�[�v��������on�ɂ���
$smarty_obj->escape_html = true;
//var_dump($smarty_obj);



