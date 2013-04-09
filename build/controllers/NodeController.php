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
		/* @var $oNode Model\Node */
		$oNode = Engine\KzfObject::CRUDObject($aData, 'Kzf\Model\Node');
		return $this->render($oNode, array('oNode' => $oNode));
	}
	
	public function listAction() {
		$oNode = NodePeer::findOrCreateRoot();
		return $this->renderBackend('tree.tpl',array('root_id' => $oNode->getId()));
	}
}