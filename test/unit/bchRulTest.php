<?php

class BchRulTest extends Generic_Tests_DatabaseTestCase
{
  /**
  @expectedException PHPUnit_Framework_Error
  */
	public function getSetUpOperation()
	{		
		$this->clear();
		$cascadeTruncates = true; // If you want cascading truncates, false otherwise. If unsure choose false.
		return new \PHPUnit_Extensions_Database_Operation_Composite(array(
				new TruncateOperation($cascadeTruncates),
				\PHPUnit_Extensions_Database_Operation_Factory::INSERT()
		));
		
	}
	
	/**
	 * @return PHPUnit_Extensions_Database_DataSet_IDataSet
	 */
	public function getDataSet()
	{
		return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
				dirname(__FILE__).'/../fixtures/kzf.yml'
		);
	}	
	
	
    private function clear() {
    	/* Add here objects who have to clear */
    	\Kzf\Model\RulePeer::clearInstancePool(true);
    }
	
	public function testDataBase()
	{
		/* résoudre problème de namespace sur Rule */
		
		$oRule = new \Kzf\Model\Rule();
		$oRule->setRulName("Test");
		$oRule->save();
		
		$aoRuleQuery = \Kzf\Model\RuleQuery::create()->find();
		/* @var $oRule \Kzf\Rule */
		foreach($aoRuleQuery as $oRule)
		{
			$oRule->setRulName("Pwet !");
			$oRule->save();
		}
		
	}
	
	public function testDataBase2()
	{
		/* résoudre problème de namespace sur Rule */
		$aoRuleQuery = \Kzf\Model\RuleQuery::create()->find();
		foreach($aoRuleQuery as $oRule)
		{
			echo $oRule->getRulName();
		}
	}	

  
/*  VOIR LESS CSS
  
  Metre en place la base de donnée de test

  
  Faire ça avec en chargant du yml
  http://www.phpunit.de/manual/current/fr/database.html*/
}