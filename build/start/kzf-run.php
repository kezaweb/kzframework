#!/usr/bin/php
<?php
/* This file [kzf-run.php] is used by kzframework Shell */
require_once 'config/config.php';

// We consider that the first arg ( path of kzf-run.php script ) is unnecessary
unset($argv[0]);
$argc--;
$argv = array_values($argv);

$oKzfShellRun = new \Kzf\Engine\KzfShellRun();
$oKzfShellRun->execute($argv, $argc, $conf['classmap']);
