<?php

namespace Kzf\Model;

use Kzf\Model\om\BaseNodeTree;


/**
 * Skeleton subclass for representing a row from the 'node_tree' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class NodeTree extends BaseNodeTree
{
	protected $crudFrom;
	protected $format;
	protected $template;
	protected $action;
	
	public function __construct() {
		// It's mean thant create / read / update or delete provide from free in Ajax.
		// So, the response must bien in Json for JSTree
		$this->crudFrom = 'tree';
		$this->format = array('tree'=>'text/json','node'=>'text/html');
		$this->template = array('tree'=>'','node'=>'node.tpl');
	}
	
	public function setCrudFrom($v) {
		$this->crudFrom = $v;
	}
	
	public function getCrudFrom() {
		return $this->crudFrom;
	}
	
	public function setAction($v) {
		$this->action = $v;
	}
	
	public function getAction() {
		return $this->action;
	}	
	
	public function getDataResponse() {
		if ($this->getAction()!='read') {
			$aData = array();
			$aData['status'] = 1;
			$aData['id'] = $this->getId();
		} else {
			// We parse the objects to reponse for jsTree
			$aoNodeTree = NodeTreeQuery::create()->findByNdtId($this->getId());
			$aData = array();
			/* @var $oNodeTree NodeTree */
			foreach ($aoNodeTree as $oNodeTree) {
				$tmp = array();
				$tmp['attr']['id'] = "node_".$oNodeTree->getId();
				$tmp['attr']['rel'] = $oNodeTree->getNdtType();
				$tmp['data'] = $oNodeTree->getNdtTitle();
				$tmp['state'] = ($oNodeTree->getNdtRight() - $oNodeTree->getNdtLeft() > 1) ? "closed" : "";
				array_push($aData, $tmp);
			}
		}
		return $aData;
	}
	
	public function getFormat() {
		return $this->format[$this->crudFrom];
	}
	public function getTemplate() {
		return $this->template[$this->crudFrom];
	}	
	
	/* TODO : Useless...*/
	private function _get_node($id) {
		return NodeTreeQuery::create()->findPk($id);
	}
	private function _get_children($id, $recursive = false) {
		$children = array();
		if($recursive) {
			$oNodeTree  = $this->_get_node($id);
			$aoNodeTree = NodeTreeQuery::create()
							->filterByNdtLeft(array('min' => $oNodeTree->getNdtLeft()))
							->filterByNdtRight(array('max' => $oNodeTree->getNdtRight()))
							->orderByNdtLeft()
							->find();
		}
		else {
			$aoNodeTree = NodeTreeQuery::create()
							->filterByNdtId($id)
							->orderByNdtPosition()
							->find();
		}			
		return $aoNodeTree;
	}
	private function _get_path($id) {
		$oNodeTree = $this->_get_node($id);
		$path = array();
		if(!$oNodeTree === false) return false;
		$aoNodeTree = NodeTreeQuery::create()
							->filterByNdtLeft(array('max'=>$oNodeTree->getNdtLeft()))
							->filterByNdtRight(array('min'=>$oNodeTree->getNdtRight()))
							->find();
		return $aoNodeTree;
	}
	
	private function _create($parent, $position) {
		return $this->_move(0, $parent, $position);
	}
	function _remove($id) {
		if((int)$id === 1) {
			return false;
		}
		$oNodeTree = $this->_get_node($id);
		$ndtLeft   = $oNodeTree->getNdtLeft();
		$ndtRight  = $oNodeTree->getNdtRight();
		$dif = $ndtRight - $ndtLeft + 1;
	
		NodeTreeQuery::create()
						->filterByNdtLeft(array('min'=>$ndtLeft))
						->filterByNdtRight(array('max'=>$ndtRight))
						->delete();
		
		NodeTreeQuery::create()
						->where('NodeTree.NdtLeft > ?', $ndtLeft)
						->update('');
		// shift left indexes of nodes right of the node
		$this->db->query("".
				"UPDATE `".$this->table."` " .
				"SET `".$this->fields["left"]."` = `".$this->fields["left"]."` - ".$dif." " .
				"WHERE `".$this->fields["left"]."` > ".$rgt
		);
		// shift right indexes of nodes right of the node and the node's parents
		$this->db->query("" .
				"UPDATE `".$this->table."` " .
				"SET `".$this->fields["right"]."` = `".$this->fields["right"]."` - ".$dif." " .
				"WHERE `".$this->fields["right"]."` > ".$lft
		);
	
		$pid = (int)$data[$this->fields["parent_id"]];
		$pos = (int)$data[$this->fields["position"]];
	
		// Update position of siblings below the deleted node
		$this->db->query("" .
				"UPDATE `".$this->table."` " .
				"SET `".$this->fields["position"]."` = `".$this->fields["position"]."` - 1 " .
				"WHERE `".$this->fields["parent_id"]."` = ".$pid." AND `".$this->fields["position"]."` > ".$pos
		);
		return true;
	}
	function _move($id, $ref_id, $position = 0, $is_copy = false) {
		if((int)$ref_id === 0 || (int)$id === 1) {
			return false;
		}
		$sql		= array();						// Queries executed at the end
		$node		= $this->_get_node($id);		// Node data
		$nchildren	= $this->_get_children($id);	// Node children
		$ref_node	= $this->_get_node($ref_id);	// Ref node data
		$rchildren	= $this->_get_children($ref_id);// Ref node children
	
		$ndif = 2;
		$node_ids = array(-1);
		if($node !== false) {
			$node_ids = array_keys($this->_get_children($id, true));
			// TODO: should be !$is_copy && , but if copied to self - screws some right indexes
			if(in_array($ref_id, $node_ids)) return false;
			$ndif = $node[$this->fields["right"]] - $node[$this->fields["left"]] + 1;
		}
		if($position >= count($rchildren)) {
			$position = count($rchildren);
		}
	
		// Not creating or copying - old parent is cleaned
		if($node !== false && $is_copy == false) {
			$sql[] = "" .
					"UPDATE `".$this->table."` " .
					"SET `".$this->fields["position"]."` = `".$this->fields["position"]."` - 1 " .
					"WHERE " .
					"`".$this->fields["parent_id"]."` = ".$node[$this->fields["parent_id"]]." AND " .
					"`".$this->fields["position"]."` > ".$node[$this->fields["position"]];
			$sql[] = "" .
					"UPDATE `".$this->table."` " .
					"SET `".$this->fields["left"]."` = `".$this->fields["left"]."` - ".$ndif." " .
					"WHERE `".$this->fields["left"]."` > ".$node[$this->fields["right"]];
			$sql[] = "" .
					"UPDATE `".$this->table."` " .
					"SET `".$this->fields["right"]."` = `".$this->fields["right"]."` - ".$ndif." " .
					"WHERE " .
					"`".$this->fields["right"]."` > ".$node[$this->fields["left"]]." AND " .
					"`".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") ";
		}
		// Preparing new parent
		$sql[] = "" .
				"UPDATE `".$this->table."` " .
				"SET `".$this->fields["position"]."` = `".$this->fields["position"]."` + 1 " .
				"WHERE " .
				"`".$this->fields["parent_id"]."` = ".$ref_id." AND " .
				"`".$this->fields["position"]."` >= ".$position." " .
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") ");
	
		$ref_ind = $ref_id === 0 ? (int)$rchildren[count($rchildren) - 1][$this->fields["right"]] + 1 : (int)$ref_node[$this->fields["right"]];
		$ref_ind = max($ref_ind, 1);
	
		$self = ($node !== false && !$is_copy && (int)$node[$this->fields["parent_id"]] == $ref_id && $position > $node[$this->fields["position"]]) ? 1 : 0;
		foreach($rchildren as $k => $v) {
			if($v[$this->fields["position"]] - $self == $position) {
				$ref_ind = (int)$v[$this->fields["left"]];
				break;
			}
		}
		if($node !== false && !$is_copy && $node[$this->fields["left"]] < $ref_ind) {
			$ref_ind -= $ndif;
		}
	
		$sql[] = "" .
				"UPDATE `".$this->table."` " .
				"SET `".$this->fields["left"]."` = `".$this->fields["left"]."` + ".$ndif." " .
				"WHERE " .
				"`".$this->fields["left"]."` >= ".$ref_ind." " .
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") ");
		$sql[] = "" .
				"UPDATE `".$this->table."` " .
				"SET `".$this->fields["right"]."` = `".$this->fields["right"]."` + ".$ndif." " .
				"WHERE " .
				"`".$this->fields["right"]."` >= ".$ref_ind." " .
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") ");
	
		$ldif = $ref_id == 0 ? 0 : $ref_node[$this->fields["level"]] + 1;
		$idif = $ref_ind;
		if($node !== false) {
			$ldif = $node[$this->fields["level"]] - ($ref_node[$this->fields["level"]] + 1);
			$idif = $node[$this->fields["left"]] - $ref_ind;
			if($is_copy) {
				$sql[] = "" .
						"INSERT INTO `".$this->table."` (" .
						"`".$this->fields["parent_id"]."`, " .
						"`".$this->fields["position"]."`, " .
						"`".$this->fields["left"]."`, " .
						"`".$this->fields["right"]."`, " .
						"`".$this->fields["level"]."`" .
						") " .
						"SELECT " .
						"".$ref_id.", " .
						"`".$this->fields["position"]."`, " .
						"`".$this->fields["left"]."` - (".($idif + ($node[$this->fields["left"]] >= $ref_ind ? $ndif : 0))."), " .
						"`".$this->fields["right"]."` - (".($idif + ($node[$this->fields["left"]] >= $ref_ind ? $ndif : 0))."), " .
						"`".$this->fields["level"]."` - (".$ldif.") " .
						"FROM `".$this->table."` " .
						"WHERE " .
						"`".$this->fields["id"]."` IN (".implode(",", $node_ids).") " .
						"ORDER BY `".$this->fields["level"]."` ASC";
			}
			else {
				$sql[] = "" .
						"UPDATE `".$this->table."` SET " .
						"`".$this->fields["parent_id"]."` = ".$ref_id.", " .
						"`".$this->fields["position"]."` = ".$position." " .
						"WHERE " .
						"`".$this->fields["id"]."` = ".$id;
				$sql[] = "" .
						"UPDATE `".$this->table."` SET " .
						"`".$this->fields["left"]."` = `".$this->fields["left"]."` - (".$idif."), " .
						"`".$this->fields["right"]."` = `".$this->fields["right"]."` - (".$idif."), " .
						"`".$this->fields["level"]."` = `".$this->fields["level"]."` - (".$ldif.") " .
						"WHERE " .
						"`".$this->fields["id"]."` IN (".implode(",", $node_ids).") ";
			}
		}
		else {
			$sql[] = "" .
					"INSERT INTO `".$this->table."` (" .
					"`".$this->fields["parent_id"]."`, " .
					"`".$this->fields["position"]."`, " .
					"`".$this->fields["left"]."`, " .
					"`".$this->fields["right"]."`, " .
					"`".$this->fields["level"]."` " .
					") " .
					"VALUES (" .
					$ref_id.", " .
					$position.", " .
					$idif.", " .
					($idif + 1).", " .
					$ldif.
					")";
		}
		foreach($sql as $q) {
			$this->db->query($q);
		}
		$ind = $this->db->insert_id();
		if($is_copy) $this->_fix_copy($ind, $position);
		return $node === false || $is_copy ? $ind : true;
	}
	function _fix_copy($id, $position) {
		$node = $this->_get_node($id);
		$children = $this->_get_children($id, true);
	
		$map = array();
		for($i = $node[$this->fields["left"]] + 1; $i < $node[$this->fields["right"]]; $i++) {
			$map[$i] = $id;
		}
		foreach($children as $cid => $child) {
			if((int)$cid == (int)$id) {
				$this->db->query("UPDATE `".$this->table."` SET `".$this->fields["position"]."` = ".$position." WHERE `".$this->fields["id"]."` = ".$cid);
				continue;
			}
			$this->db->query("UPDATE `".$this->table."` SET `".$this->fields["parent_id"]."` = ".$map[(int)$child[$this->fields["left"]]]." WHERE `".$this->fields["id"]."` = ".$cid);
			for($i = $child[$this->fields["left"]] + 1; $i < $child[$this->fields["right"]]; $i++) {
				$map[$i] = $cid;
			}
		}
	}
	
	function _reconstruct() {
		$this->db->query("" .
				"CREATE TEMPORARY TABLE `temp_tree` (" .
				"`".$this->fields["id"]."` INTEGER NOT NULL, " .
				"`".$this->fields["parent_id"]."` INTEGER NOT NULL, " .
				"`". $this->fields["position"]."` INTEGER NOT NULL" .
				") type=HEAP"
		);
		$this->db->query("" .
				"INSERT INTO `temp_tree` " .
				"SELECT " .
				"`".$this->fields["id"]."`, " .
				"`".$this->fields["parent_id"]."`, " .
				"`".$this->fields["position"]."` " .
				"FROM `".$this->table."`"
		);
	
		$this->db->query("" .
				"CREATE TEMPORARY TABLE `temp_stack` (" .
				"`".$this->fields["id"]."` INTEGER NOT NULL, " .
				"`".$this->fields["left"]."` INTEGER, " .
				"`".$this->fields["right"]."` INTEGER, " .
				"`".$this->fields["level"]."` INTEGER, " .
				"`stack_top` INTEGER NOT NULL, " .
				"`".$this->fields["parent_id"]."` INTEGER, " .
				"`".$this->fields["position"]."` INTEGER " .
				") type=HEAP"
		);
		$counter = 2;
		$this->db->query("SELECT COUNT(*) FROM temp_tree");
		$this->db->nextr();
		$maxcounter = (int) $this->db->f(0) * 2;
		$currenttop = 1;
		$this->db->query("" .
				"INSERT INTO `temp_stack` " .
				"SELECT " .
				"`".$this->fields["id"]."`, " .
				"1, " .
				"NULL, " .
				"0, " .
				"1, " .
				"`".$this->fields["parent_id"]."`, " .
				"`".$this->fields["position"]."` " .
				"FROM `temp_tree` " .
				"WHERE `".$this->fields["parent_id"]."` = 0"
		);
		$this->db->query("DELETE FROM `temp_tree` WHERE `".$this->fields["parent_id"]."` = 0");
	
		while ($counter <= $maxcounter) {
			$this->db->query("" .
					"SELECT " .
					"`temp_tree`.`".$this->fields["id"]."` AS tempmin, " .
					"`temp_tree`.`".$this->fields["parent_id"]."` AS pid, " .
					"`temp_tree`.`".$this->fields["position"]."` AS lid " .
					"FROM `temp_stack`, `temp_tree` " .
					"WHERE " .
					"`temp_stack`.`".$this->fields["id"]."` = `temp_tree`.`".$this->fields["parent_id"]."` AND " .
					"`temp_stack`.`stack_top` = ".$currenttop." " .
					"ORDER BY `temp_tree`.`".$this->fields["position"]."` ASC LIMIT 1"
			);
	
			if ($this->db->nextr()) {
				$tmp = $this->db->f("tempmin");
	
				$q = "INSERT INTO temp_stack (stack_top, `".$this->fields["id"]."`, `".$this->fields["left"]."`, `".$this->fields["right"]."`, `".$this->fields["level"]."`, `".$this->fields["parent_id"]."`, `".$this->fields["position"]."`) VALUES(".($currenttop + 1).", ".$tmp.", ".$counter.", NULL, ".$currenttop.", ".$this->db->f("pid").", ".$this->db->f("lid").")";
				$this->db->query($q);
				$this->db->query("DELETE FROM `temp_tree` WHERE `".$this->fields["id"]."` = ".$tmp);
				$counter++;
				$currenttop++;
			}
			else {
				$this->db->query("" .
						"UPDATE temp_stack SET " .
						"`".$this->fields["right"]."` = ".$counter.", " .
						"`stack_top` = -`stack_top` " .
						"WHERE `stack_top` = ".$currenttop
				);
				$counter++;
				$currenttop--;
			}
		}
	
		$temp_fields = $this->fields;
		unset($temp_fields["parent_id"]);
		unset($temp_fields["position"]);
		unset($temp_fields["left"]);
		unset($temp_fields["right"]);
		unset($temp_fields["level"]);
		if(count($temp_fields) > 1) {
			$this->db->query("" .
					"CREATE TEMPORARY TABLE `temp_tree2` " .
					"SELECT `".implode("`, `", $temp_fields)."` FROM `".$this->table."` "
			);
		}
		$this->db->query("TRUNCATE TABLE `".$this->table."`");
		$this->db->query("" .
				"INSERT INTO ".$this->table." (" .
				"`".$this->fields["id"]."`, " .
				"`".$this->fields["parent_id"]."`, " .
				"`".$this->fields["position"]."`, " .
				"`".$this->fields["left"]."`, " .
				"`".$this->fields["right"]."`, " .
				"`".$this->fields["level"]."` " .
				") " .
				"SELECT " .
				"`".$this->fields["id"]."`, " .
				"`".$this->fields["parent_id"]."`, " .
				"`".$this->fields["position"]."`, " .
				"`".$this->fields["left"]."`, " .
				"`".$this->fields["right"]."`, " .
				"`".$this->fields["level"]."` " .
				"FROM temp_stack " .
				"ORDER BY `".$this->fields["id"]."`"
		);
		if(count($temp_fields) > 1) {
			$sql = "" .
					"UPDATE `".$this->table."` v, `temp_tree2` SET v.`".$this->fields["id"]."` = v.`".$this->fields["id"]."` ";
			foreach($temp_fields as $k => $v) {
				if($k == "id") continue;
				$sql .= ", v.`".$v."` = `temp_tree2`.`".$v."` ";
			}
			$sql .= " WHERE v.`".$this->fields["id"]."` = `temp_tree2`.`".$this->fields["id"]."` ";
			$this->db->query($sql);
		}
	}
	
	function _analyze() {
		$report = array();
	
		$this->db->query("" .
				"SELECT " .
				"`".$this->fields["left"]."` FROM `".$this->table."` s " .
				"WHERE " .
				"`".$this->fields["parent_id"]."` = 0 "
		);
		$this->db->nextr();
		if($this->db->nf() == 0) {
			$report[] = "[FAIL]\tNo root node.";
		}
		else {
			$report[] = ($this->db->nf() > 1) ? "[FAIL]\tMore than one root node." : "[OK]\tJust one root node.";
		}
		$report[] = ($this->db->f(0) != 1) ? "[FAIL]\tRoot node's left index is not 1." : "[OK]\tRoot node's left index is 1.";
	
		$this->db->query("" .
				"SELECT " .
				"COUNT(*) FROM `".$this->table."` s " .
				"WHERE " .
				"`".$this->fields["parent_id"]."` != 0 AND " .
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE `".$this->fields["id"]."` = s.`".$this->fields["parent_id"]."`) = 0 ");
		$this->db->nextr();
		$report[] = ($this->db->f(0) > 0) ? "[FAIL]\tMissing parents." : "[OK]\tNo missing parents.";
	
		$this->db->query("SELECT MAX(`".$this->fields["right"]."`) FROM `".$this->table."`");
		$this->db->nextr();
		$n = $this->db->f(0);
		$this->db->query("SELECT COUNT(*) FROM `".$this->table."`");
		$this->db->nextr();
		$c = $this->db->f(0);
		$report[] = ($n/2 != $c) ? "[FAIL]\tRight index does not match node count." : "[OK]\tRight index matches count.";
	
		$this->db->query("" .
				"SELECT COUNT(`".$this->fields["id"]."`) FROM `".$this->table."` s " .
				"WHERE " .
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE " .
				"`".$this->fields["right"]."` < s.`".$this->fields["right"]."` AND " .
				"`".$this->fields["left"]."` > s.`".$this->fields["left"]."` AND " .
				"`".$this->fields["level"]."` = s.`".$this->fields["level"]."` + 1" .
				") != " .
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE " .
				"`".$this->fields["parent_id"]."` = s.`".$this->fields["id"]."`" .
				") "
		);
		$this->db->nextr();
		$report[] = ($this->db->f(0) > 0) ? "[FAIL]\tAdjacency and nested set do not match." : "[OK]\tNS and AJ match";
	
		return implode("<br />",$report);
	}
	
	function _dump($output = false) {
		$nodes = array();
		$this->db->query("SELECT * FROM ".$this->table." ORDER BY `".$this->fields["left"]."`");
		while($this->db->nextr()) $nodes[] = $this->db->get_row("assoc");
		if($output) {
			echo "<pre>";
			foreach($nodes as $node) {
				echo str_repeat("&#160;",(int)$node[$this->fields["level"]] * 2);
				echo $node[$this->fields["id"]]." (".$node[$this->fields["left"]].",".$node[$this->fields["right"]].",".$node[$this->fields["level"]].",".$node[$this->fields["parent_id"]].",".$node[$this->fields["position"]].")<br />";
			}
			echo str_repeat("-",40);
			echo "</pre>";
		}
		return $nodes;
	}	
}
