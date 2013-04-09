<?php
namespace Kzf\Controller;

use Symfony\Component\HttpFoundation as Http;
use Kzf\Controller\Base as Base;
use Kzf\Model as Model;
use Kzf\Engine as Engine;

class TemplateController extends Base\BaseController
{
	public function singleAction() {
		$aData = json_decode($this->request->get('jData'),true);
		$aData = !is_array($aData)?array():$aData;
		$aResponse = Engine\KzfObject::CRUDObject($aData, 'Kzf\Model\Template');
		return $this->renderJson(json_encode($aResponse));
	}
	
	public function listAction() {
		$aoTemplate = Model\TemplateQuery::create()->find();
		
		return $this->renderBackend('templates.tpl',array('aoTemplate'=>$aoTemplate));
	}
}