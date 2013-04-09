<?php
namespace Kzf\Controller\Base;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Kzf\Engine as Engine;

class BaseController
{
	protected $isAjax = false;
	protected $request;
	
	public function __construct(){
		$this->isAjax = (bool) (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		$this->request = Request::createFromGlobals();
	}
	
	public function renderBackend($tpl, $aParameters = array()){
		$oSmarty = new Engine\BackendSmarty();
		foreach($aParameters as $key => $value) {
			$oSmarty->assign($key,$value);
		}
		$oSmarty->compile_id = ($this->isAjax ? 'ajax' : 'layout');
		$oSmarty->assign('sParentTemplate', $oSmarty->compile_id . '.tpl');
		$render = $oSmarty->fetch($tpl);
		
		
		return new Response($render);
	}
	
	public function renderJson($json)
	{
 		$aJson = json_decode($json, true);
		if(array_key_exists('type', $aJson) && $aJson['type']=="Error") $status = 500;
		else $status = 200;
		$response = new Response(
				$json,
				$status,
				array('content-type' => 'application/json')
		);
		
		return $response;
	}
	
	public function renderFrontend($tpl, $aParameters = array())
	{
	
		return new Response("It's work !");
	}	
	
	public function render($oObject, $aParams)
	{
		try {
			if (is_object($oObject)) {
				if ($oObject->getFormat()=='text/json' || $oObject->hasInternalError()) {
					return $this->renderJson($oObject->getJsonResponse());
				} else {
					return $this->renderBackend($oObject->getRenderTemplate(),$aParams);
				}
			} else {
				return $this->renderJson($oObject);
			}
		} catch (\Exception $e) {
			$aResponse['type']    = 'Error';
			$aResponse['message'] = $e->getMessage();
			return $this->renderJson(json_encode($aResponse));
		}
	}
}