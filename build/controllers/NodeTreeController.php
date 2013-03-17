<?php
namespace Kzf\Controller;

use Symfony\Component\HttpFoundation as Http;
use Kzf\Controller\Base as Base;
use Kzf\Model as Model;
use Kzf\Engine as Engine;

class NodeTreeController extends Base\BaseController
{
	public function singleAction() {
		$aData = json_decode($this->request->get('jData'),true);
		$aData = !is_array($aData)?array():$aData;
		$aResponse = Engine\KzfObject::CUDObject($aData, 'Kzf\Model\NodeTree');
		return $this->renderJson(json_encode($aResponse));
	}
	
	public function listAction() {
		$aoNodeTree = Model\NodeTreeQuery::create()->find();
		return $this->renderBackend('tree.tpl',array('aoNodeTree'=>$aoNodeTree));
	}
}