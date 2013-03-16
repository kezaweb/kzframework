<?php 

namespace Kzf\Engine;

use \Smarty;
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