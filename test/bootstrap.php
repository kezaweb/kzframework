<?php
$pwd = exec("pwd");
if(!defined('KZF_DIR')) define('KZF_DIR', (($_SERVER['DOCUMENT_ROOT']=='')?$pwd."/":$_SERVER['DOCUMENT_ROOT']));

require_once KZF_DIR."config/config.php";
require_once KZF_DIR."test/phpunit/Generic_Tests_DatabaseTestCase.php";
require_once KZF_DIR."test/phpunit/TruncateOperation.php";