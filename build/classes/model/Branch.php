<?php

namespace Kzf\Model;

use Kzf\Model\om\BaseBranch;


/**
 * Skeleton subclass for representing a row from the 'branch' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class Branch extends BaseBranch
{
	protected $aJsonResponse;
	protected $nodId;
	protected $action;
	
	public function __construct()
	{
		$this->aJsonResponse = array();
	}
	
	
	public function addAJsonResponse($aJsonToMerge)
	{
		$this->aJsonResponse = array_merge($this->aJsonResponse,$aJsonToMerge);
	}
	
	public function getJsonResponse()
	{
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
	
	public function getFormat()
	{
		return 'text/html';
	}
	
	public function getRenderTemplate() 
	{
		return 'branch_form.tpl';
	}
	
	public function setNodId($v)
	{
		$oNode = NodeQuery::create()->findPk($v);
		if ($this->isPrimaryKeyNull()) {
			// Where hydrate the title branch with title node
			$this->setBchTitle($oNode->getNodTitle());
		}
		$this->nodId = $v;
	}
	
	public function postSave()
	{
		$oNode = NodeQuery::create()->findPk($this−>nodId);
		$oNode->setBchId($this->getId());
		$oNode->save();
	}
	
	public function setAction($v)
	{
		$this->action = $v;
	}
	
	public function getAction()
	{
		return $this->action;
	}
}
