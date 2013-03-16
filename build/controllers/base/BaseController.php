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
	
	public function renderJson($json) {
		$response = new Response(
				$json,
				200,
				array('content-type' => 'text/json')
		);
		
		return $response;
	}
	
	public function renderFrontend($tpl, $aParameters = array()){
	
		return new Response("It's work !");
	}	
	
}