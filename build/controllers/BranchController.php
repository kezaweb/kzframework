<?php
namespace Kzf\Controller;

use Symfony\Component\HttpFoundation as Http;
use Kzf\Controller\Base as Base;
use Kzf\Model as Model;
use Kzf\Engine as Engine;

class BranchController extends Base\BaseController
{
	public function singleAction() {
		$aData = json_decode($this->request->get('jData'),true);
		$aData = !is_array($aData)?array():$aData;
		/* @var $oNode Model\Node */
		$oBranch = Engine\KzfObject::CRUDObject($aData, 'Kzf\Model\Branch');
		return $this->render($oBranch, array('oBranch' => $oBranch));
	}
	
	public function listAction() {
		$aoBranch = Model\BranchQuery::create()->find();
		
		return $this->renderBackend('branches.tpl',array('aoBranch'=>$aoBranch));
	}
}