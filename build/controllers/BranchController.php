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
		$aResponse = Engine\KzfObject::CUDObject($aData, 'Kzf\Model\Branch');
		return $this->renderJson(json_encode($aResponse));
	}
	
	public function listAction() {
		$aoBranch = Model\BranchQuery::create()->find();
		
		return $this->renderBackend('branches.tpl',array('aoBranch'=>$aoBranch));
	}
}