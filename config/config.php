<?php
session_start();

$pwd = exec("pwd");
if(!defined('KZF_DIR')) define('KZF_DIR', (($_SERVER['DOCUMENT_ROOT']=='')?$pwd."/":$_SERVER['DOCUMENT_ROOT']));

// include the autoload of symfony
include(KZF_DIR . 'vendor/autoload.php');

include(KZF_DIR . "build/conf/kzf-conf.php");

// Initialize Propel with the runtime configuration
Propel::init(KZF_DIR."build/conf/kzf-conf.php");


?>