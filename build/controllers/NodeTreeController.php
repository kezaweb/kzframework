<?php
namespace Kzf\Controller;

use Kzf\Model\NodeTreeQuery;

use Symfony\Component\HttpFoundation as Http;
use Kzf\Controller\Base as Base;
use Kzf\Model as Model;
use Kzf\Engine as Engine;

class NodeTreeController extends Base\BaseController
{
	public function singleAction() {
		$aData = json_decode($this->request->get('jData'),true);
		$aData = !is_array($aData)?array():$aData;
		if (array_key_exists('action', $aData) && $aData['action']=='read') {
			/* @var $oNodeTree Model\NodeTree */
			$oNodeTree = Engine\KzfObject::findByData($aData);
			if ($oNodeTree->getFormat()=='text/json') {
				return $this->renderJson(json_encode($oNodeTree->getDataResponse()));
			} else {
				$this->renderBackend($oNodeTree->getTemplate(),$oNodeTree);
			}
		} else {
			$aResponse = Engine\KzfObject::CUDObject($aData, 'Kzf\Model\NodeTree');
			return $this->renderJson(json_encode($aResponse));			
		}
	}
	
	public function listAction() {
		$aoNodeTree = Model\NodeTreeQuery::create()->find();
		return $this->renderBackend('tree.tpl',array('aoNodeTree'=>$aoNodeTree));
	}
}