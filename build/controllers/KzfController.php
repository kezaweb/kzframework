<?php
namespace Kzf\Controller;

use Symfony\Component\HttpFoundation as Http;
use Kzf\Controller\Base as Base;
use Kzf\Model as Model;

class KzfController extends Base\BaseController
{
	public function indexAction() {
		return $this->renderBackend('index.tpl');
	}
}