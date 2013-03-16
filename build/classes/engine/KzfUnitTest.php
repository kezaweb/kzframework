<?php
namespace Kzf\Engine;

class KzfUnitTest 
{

	public function generateFiles($aClassMap)
	{
        array_walk($aClassMap, function($val,$key) use (&$aClassMap){ 
        	if (strpos($val, 'map/')>0  || strpos($val, 'om/')>0 || strpos($val, 'Query')>0 || strpos($val, 'Peer')>0) { 
		        unset($aClassMap[$key]);
            }else{
                $aClassMap[$key] = lcfirst($key);
            }
		});
		exec("chmod 777 ".KZF_DIR."/test/unit");
		foreach($aClassMap as $class){
			if(!is_file(KZF_DIR."/test/unit/".$class."Test.php")){
				echo "\n#Create file of unit test ".$class."Test.php#";
				$this->createUnitFileTest($class);
			}
		}
	}
	
	protected function createUnitFileTest($class) {
								
		$sData = "<?php			\n";
		$sData.= "class ".ucfirst($class)."Test extends PHPUnit_Framework_TestCase\n";
		$sData.= "{\n";
		$sData.= "  /**\n";
		$sData.= "  @expectedException PHPUnit_Framework_Error\n";
		$sData.= "  */\n";
		$sData.= "  public function main()\n";
		$sData.= "  {\n";
		$sData.= " \n";
		$sData.= "  }\n";
		$sData.= "}\n";
		$sData.= "?>\n";
		
		$fp = fopen(KZF_DIR."/test/unit/".$class."Test.php", "w+");
		fwrite($fp, $sData);	
		fclose($fp);
		
	}
	
	public function extractDatabaseModel() {
		exec("mysqldump --user=root --password=#YOUR-PASSWORD# --no-data kzf_model > /tmp/kzf_new_fixtures.sql",&$output);
		return $output;
	}
	
	public function dropFixturesSchema() {
		exec("mysqladmin --user=root --password=#YOUR-PASSWORD# -f drop kzf_fixtures",&$output);
		return $output;
	}
	
	public function createNewFixturesSchema()	{
		exec("mysqladmin --user=root --password=#YOUR-PASSWORD# create kzf_fixtures",&$output);
		return $output;
	}
	
	public function loadSchemaOnDatabase() {
		exec("mysql --user=root --password=#YOUR-PASSWORD# -D kzf_fixtures < /tmp/kzf_new_fixtures.sql",&$output);
		return $output;
	}
	
}