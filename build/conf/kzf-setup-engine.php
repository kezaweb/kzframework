<?php

require(KZF_DIR . 'build/conf/kzf-conf.php');
require(SMARTY_DIR . 'Smarty.class.php');



function autoloaderKzf($class) {
	if(file_exists(KZF_DIR.'build/classes/engine/' . $class . '.class.php'))
		include KZF_DIR.'build/classes/engine/' . $class . '.class.php';
}
spl_autoload_register('autoloaderKzf');

function autoloaderPropel($class, $dir=null) {
	$dir = (is_null($dir))?KZF_DIR.'vendor/propel/generator/lib/':$dir;
	$aSubDirectory = getSubDirectory($dir);
	foreach($aSubDirectory as $subdir){
	  if(file_exists($dir.$subdir.'/' . $class . '.php')){
	  	include $dir.$subdir.'/'. $class . '.php';
	  }
	  else{
	  	autoloaderPropel($class,$dir.$subdir."/");
	  }
	}
	
}
spl_autoload_register('autoloaderPropel');


function getSubDirectory($Directory){
	$aDirectory = array();
	$MyDirectory = opendir($Directory) or die('Erreur');
	while($Entry = @readdir($MyDirectory)) {
		if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
			array_push($aDirectory, $Entry);
		}
	}
	closedir($MyDirectory);
	return $aDirectory;
}



// smarty configuration
class BackendSmarty extends Smarty {
	function __construct() {
		parent::__construct();
		$this->setTemplateDir(KZF_DIR . 'smarty/backend/templates');
		$this->setCompileDir(KZF_DIR . 'smarty/backend/templates_c');
		$this->setConfigDir(KZF_DIR . 'smarty/backend/configs');
		$this->setCacheDir(KZF_DIR . 'smarty/backend/cache');
	}
}

// smarty configuration
class FrontendSmarty extends Smarty {
	function __construct() {
		parent::__construct();
		$this->setTemplateDir(KZF_DIR . 'smarty/frontend/templates');
		$this->setCompileDir(KZF_DIR . 'smarty/frontend/templates_c');
		$this->setConfigDir(KZF_DIR . 'smarty/frontend/configs');
		$this->setCacheDir(KZF_DIR . 'smarty/frontend/cache');
	}
}

?>


