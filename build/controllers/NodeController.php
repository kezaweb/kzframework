<?php
namespace Kzf\Controller;

use Kzf\Model\NodePeer;

use Kzf\Model\NodeQuery;

use Symfony\Component\HttpFoundation as Http;
use Kzf\Controller\Base as Base;
use Kzf\Model as Model;
use Kzf\Engine as Engine;

class NodeController extends Base\BaseController
{
	public function singleAction() {
		$aData = json_decode($this->request->get('jData'),true);
		$aData = !is_array($aData)?array():$aData;
		if (array_key_exists('action', $aData) && $aData['action']=='read') {
			/* @var $oNode Model\Node */
			$oNode = Engine\KzfObject::findByData($aData, "Kzf\Model\Node");
			$oNode->setAction("read");
			if ($oNode->getFormat()=='text/json') {
				return $this->renderJson(json_encode($oNode->getDataResponse()));
			} else {
				$this->renderBackend($oNode->getTemplate(),$oNode);
			}
		} else {
			$jResponse = Engine\KzfObject::CUDObject($aData, 'Kzf\Model\Node');
			return $this->renderJson($jResponse);	
		}
	}
	
	public function listAction() {
		$oNode = NodePeer::findOrCreateRoot();
		return $this->renderBackend('tree.tpl',array('root_id' => $oNode->getId()));
	}
}