<?php

namespace Kzf\Model;

use Kzf\Model\om\BaseNode;


/**
 * Skeleton subclass for representing a row from the 'node' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class Node extends BaseNode
{
	
	protected $crudFrom;
	protected $format;
	protected $renderTemplate;
	protected $action;
	protected $idParent;
	protected $idPrevSibling;
	protected $aJsonResponse;
	
	public function __construct() 
	{
		// It's mean thant create / read / update or delete provide from free in Ajax.
		// So, the response must bien in Json for JSTree
		$this->crudFrom			 = 'tree';
		$this->format			 = array('tree'=>'text/json','node'=>'text/html');
		$this->renderTemplate 	 = array('tree'=>'','node'=>'node.tpl');
		$this->aJsonResponse	 = array();
	}
	
	public function setCrudFrom($v)
	{
		$this->crudFrom = $v;
	}
	
	public function getCrudFrom()
	{
		return $this->crudFrom;
	}
	
	public function getFormat()
	{
		return $this->format[$this->getCrudFrom()];
	}
	
	public function getRenderTemplate()
	{
		return $this->renderTemplate[$this->getCrudFrom()];
	}	
	
	public function setAction($v)
	{
		$this->action = $v;
	}
	
	public function getAction()
	{
		return $this->action;
	}	
	
	public function setIdParent($v)
	{
		if (is_int($v)) {
			$this->idParent = $v;
		}
	}

	public function setIdPrevSibling($v)
	{
		if (is_int($v)) {
			$this->idPrevSibling = $v;			
		}
	}
	
	public function preSave()
	{
		switch($this->action) {
			case 'create':
				if (is_null($this->idPrevSibling) && !is_null($this->idParent)) {
					$this->insertAsFirstChildOf(NodeQuery::create()->findPk($this->idParent));
				} elseif (!is_null($this->idPrevSibling)) {
					$this->insertAsNextSiblingOf(NodeQuery::create()->findPk($this->idPrevSibling));
				} else {
					throw new \Exception("You must to define an idParent or idPrevSibling to create a Node");
				}
				break;
			case 'update':
				if (is_null($this->idPrevSibling) && !is_null($this->idParent)) {
					$this->moveToFirstChildOf(NodeQuery::create()->findPk($this->idParent));
				} elseif (!is_null($this->idPrevSibling)) {
					echo $this->idPrevSibling;
					$this->moveToNextSiblingOf(NodeQuery::create()->findPk($this->idPrevSibling));
				}
				break;
		}
		
		return true;
	}
	
	public function getDataResponse()
	{
		$aData = array();
		if ($this->getAction()!='read') {
			$aData['status'] = 1;
			$aData['id'] = $this->getId();
		} else {
			// We parse the objects to reponse for jsTree
			$aoNode = NodeQuery::create()->childrenOf($this)
							  			  ->orderByNodLeft()
										  ->find();
			$aData = array();
			/* @var $oNode Node */
			foreach ($aoNode as $oNode) {
				$tmp = array();
				$tmp['attr']['id'] = "node_".$oNode->getId();
				$tmp['attr']['rel'] = $oNode->getNodType();
				$tmp['attr']['data-cloud'] = $oNode->getNodCloud();
				$tmp['attr']['data-virtual'] = $oNode->getNodVirtual();
				$tmp['data'] = $oNode->getNodTitle();
				$tmp['state'] = ($oNode->getNodRight() - $oNode->getNodLeft() > 1) ? "closed" : "";
				array_push($aData, $tmp);
			}
		}
		return $aData;
	}
	
	public function hasLeafOrBranch() {
		return ($this->lef_id!='' || $this->bch_id!='');
	}
	
	public function isVirtual() {
		return ($this->nod_virtual==true && $this->nod_master!='');
	}
	
	public function isCreating() {
		if (!$this->hasLeafOrBranch() && !$this->isVirtual()) {
			return true;
		} else {
			return false;
		}
		
	}
	
	public function getNodTypeForBootstrap() {
			switch ($this->getNodType()) {
			case 'default':
				return 'leaf';
				break;
				break;
			case 'folder':
				return 'folder-open';
				break;
				break;
			case 'drive':
				return 'globe';
				break;
			case 'root':
				return '';
				break;
		}
	}
	
	public function getNodTypeForUser($ucfirst=false) {
		switch ($this->getNodType()) {
			case 'default':
				$nodTypeForUser = 'leaf';
				break;
			case 'folder':
				$nodTypeForUser = 'branch';
				break;
			case 'drive':
				$nodTypeForUser = 'base';
				break;
			case 'root':
				$nodTypeForUser = '';
				break;
		}
		if ($ucfirst && !empty($nodTypeForUser)) {
			return ucfirst($nodTypeForUser);
		} else {
			return $nodTypeForUser;
		}
	}
	
	public function isDrive() {
		return ($this->getNodType()=='drive');
	}
	
	public function getJsonToCreateAsSimple() {
		$aJson = array();
		$aJson["action"]   = "read";
		$aJson["nod_id"]   = $this->getId();
		$aJson["crudFrom"] = "admin";
		return htmlentities(json_encode($aJson));
	}
	
	public function getJsonToCreateAsCloud() {
		$aJson = array();
		$aJson["action"]    = "read";
		$aJson["nod_id"]    = $this->getId();
		$aJson["crudFrom"]  = "admin";
		$aJson["nod_cloud"] = 1;
		return htmlentities(json_encode($aJson));
	}
	
	public function getJsonToCreateAsVirtual() {
		$aJson = array();
		$aJson["action"]     = "read";
		$aJson["nod_id"]     = $this->getId();
		$aJson["crudFrom"]   = "admin";
		$aJson["nod_virual"] = 1;
		return htmlentities(json_encode($aJson));
	}
	
	public function addAJsonResponse($aJsonToMerge) {
		$this->aJsonResponse = array_merge($this->aJsonResponse,$aJsonToMerge);
	}
	
	public function getJsonResponse() {
		return json_encode($this->aJsonResponse);
	}
	
	public function hasInternalError()
	{
		if (array_key_exists('type', $this->aJsonResponse) && $this->aJsonResponse['type'] == 'Error') {
			return true;
		} else {
			return false;
		}
	}
	
}
