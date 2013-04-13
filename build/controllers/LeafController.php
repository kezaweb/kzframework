<?php
namespace Kzf\Controller;

use Kzf\Model\NodeQuery;

use Kzf\Model\Node;

use Symfony\Component\HttpFoundation as Http;
use Kzf\Controller\Base as Base;
use Kzf\Model as Model;
use Kzf\Engine as Engine;

class LeafController extends Base\BaseController
{
	public function singleAction() 
	{
	
	}
	
	public function listAction() 
	{
		$oNode = NodeQuery::create()->findRoot();
		if ($oNode instanceof Node) {
			echo $oNode->getNodTitle()." <br />";
			/* @var $oNode Node */
			$aoNode = $oNode->getChildren();
			foreach ($aoNode as $oNode) {
				echo " * ".$oNode->getNodTitle()." <br />";
				if ($oNode->hasChildren()) {
					$aoNodeChild = $oNode->getChildren();
					foreach ($aoNodeChild as $oNode) {
						echo " * * ".$oNode->getNodTitle()." <br />";
					}
				}
			}
			
		}
		//$this->renderBackend('leaves.tpl',array('aoLeaf'=>$aoLeaf));
		/*
		$aoLeaf = Model\LeafQuery::create()->find();
		
		return $this->renderBackend('leaves.tpl',array('aoLeaf'=>$aoLeaf));*/
	}
}