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
// 		echo "ON PASSE ?";
 		NodeQuery::create()->deleteAll();
		$oNodeRoot = new Model\Node();
		$oNodeRoot->setNodTitle("Roots");
		$oNodeRoot->createRoot();
		$oNodeRoot->save();

		
		$oNodeChild1_1 = new Model\Node();
		$oNodeChild1_1->setNodTitle("Pos 1 Niv 1");
		$oNodeChild1_1->setAction("create");
		$oNodeChild1_1->setIdParent($oNodeRoot->getId());
		$oNodeChild1_1->save();
		
		
		$oNodeChild2_1 = new Model\Node();
		$oNodeChild2_1->setNodTitle("Pos 2 Niv 1");	
		$oNodeChild2_1->setAction("create");
		$oNodeChild2_1->setIdPrevSibling($oNodeChild1_1->getId());
		$oNodeChild2_1->save();
		
		$oNodeChild3_1 = new Model\Node();
		$oNodeChild3_1->setNodTitle("Pos 3 Niv 1");
		$oNodeChild3_1->setAction("create");
		$oNodeChild3_1->setIdPrevSibling($oNodeChild2_1->getId());
		$oNodeChild3_1->save();
		
		$oNodeChild1_2 = new Model\Node();
		$oNodeChild1_2->setNodTitle("Pos 1 Niv 2");	
		$oNodeChild1_2->setAction("create");
		$oNodeChild1_2->setIdParent($oNodeChild1_1->getId());
		$oNodeChild1_2->save();
		
		$oNodeChild2_2 = new Model\Node();
		$oNodeChild2_2->setNodTitle("Pos 2 Niv 2");
		$oNodeChild2_2->setAction("create");
		$oNodeChild2_2->setIdPrevSibling($oNodeChild1_2->getId());
		$oNodeChild2_2->save();
		
		$oNodeChild2_2 = NodeQuery::create()->filterByNodTitle("Pos 2 Niv 2")
						   					->findOne();
		$oNodeChild2_2->setNodTitle("Pos 4 Niv 1");
		$oNodeChild2_2->setAction("update");
		$oNodeChild2_2->setIdPrevSibling($oNodeChild3_1->getId());
		$oNodeChild2_2->save();

		/* @var $oNode Node */
		$oNode = NodeQuery::create()->filterByNodTitle("Pos 1 Niv 1")
						   ->findOne();
		echo $oNode->getNodTitle();
		//$oNode->
		/*
		$aData = json_decode($this->request->get('jData'),true);
		$aData = !is_array($aData)?array():$aData;
		$aResponse = Engine\KzfObject::CUDObject($aData, 'Kzf\Model\Leaf');
		return $this->renderJson(json_encode($aResponse));
		*/
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