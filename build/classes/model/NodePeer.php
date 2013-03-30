<?php

use Kzf\Model\Node;

namespace Kzf\Model;

use Kzf\Model\om\BaseNodePeer;


/**
 * Skeleton subclass for performing query and update operations on the 'node' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class NodePeer extends BaseNodePeer
{
	public static function findOrCreateRoot()
	{
		$oNodeRoot = NodeQuery::create()->findRoot();
		if (!$oNodeRoot instanceof Node) {
			$oNodeRoot = new Node();
			$oNodeRoot->setNodTitle("Root");
			$oNodeRoot->setNodType("root");
			$oNodeRoot->makeRoot();
			$oNodeRoot->save();
		}
		
		if (!$oNodeRoot->hasChildren()) {
			$oNode = new Node();
			$oNode->setNodTitle("Your website");
			$oNode->setNodType("drive");
			$oNode->insertAsFirstChildOf($oNodeRoot);
			$oNode->save();
		}
		return $oNodeRoot;
	}
	
	
}
