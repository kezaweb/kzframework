<?php
namespace Kzf\Engine;

use Kzf\Engine;

class KzfShellRun extends \Kzf\Engine\KzfShellTools
{
	protected $classmap = null;
	
	public function execute($argv, $argc, $classmap){
		$this->argv = $argv;
		$this->argc = $argc;
		$this->classmap = $classmap;
		$firstArg = (key_exists(0 ,$this->argv))?str_replace(" ", "", ucwords(str_replace("-", " ", $this->argv[0]))):"";
		$firstArg = ($firstArg=="")?"Help":$firstArg;
		if (method_exists($this, "process".$firstArg)) {
			// We unset the first argument. $argv contains only process parameters
			unset($argv[0]);
			$parameters = $argv;
			$method = "process".$firstArg;
			$this->$method($parameters);
		} else {
			$this->output(sprintf("Parameter \"%s\" doesn't exist for kzframework",$this->argv[0]),parent::$MSG_ERROR);
			$this->processHelp($argv);
		}
	}

	public function processPropel($argv){
		$this->output("# Using propel shell #",parent::$MSG_SUCCESS);
		exec(KZF_DIR."vendor/bin/propel-gen ".KZF_DIR."config ".implode(' ',$argv),&$output);
		$this->outputShell($output);
	}
	
	public function processPhpunit($argv){
		$this->output("# Using phpunit shell #",parent::$MSG_SUCCESS);
		exec(KZF_DIR."vendor/bin/phpunit ".implode(' ',$argv),&$output);
		$this->outputShell($output);
	}	
	
	public function processHelp($argv){
		// This function describes processes allowed by the shell
		$this->output("#################### How To Using Kzframework #######################",parent::$MSG_SUCCESS);
		$this->output(" ");
		$this->output("~~~ Kzframework Methods ~~~");
		$this->output("    -build");
		$this->output("            This method build your schema.xml and your model according database kzf_model and load a new schema kzf_fixtures");
		$this->output("    -build-and-migrate");
		$this->output("            This method build your schema according database kzf_model, load a new schema kzf_fixtures, and can modify your schema kzf and play units tests");
		$this->output("    -play-tests");
		$this->output("            This method play units tests");
		$this->output(" ");
		$this->output("~~~ Phpunit ~~~");		
		$this->output("    -phpunit");		
		$this->output("            You can use all arguments used for phpunit shell");
		$this->output(" ");
		$this->output("~~~ Propel ~~~");
		$this->output("    -propel-gen");		
		$this->output("            You can use all arguments used for propel-gen shell");		
		$this->output(" ");
		$this->output(" ");
		$this->output("########################## Enjoy coding ;-) #######################",parent::$MSG_SUCCESS);		
	}	
	
	public function processBuild($argv) {
		$propel_params = array('reverse');
		$this->output("# Generate schema according kzf_model #",parent::$MSG_SUCCESS);
		$this->processPropel($propel_params);		
		// Modify the schema to add namespace Kzf
		$this->addNamespaceInSchema();
		$this->output("# Generate model with propel according schema #",parent::$MSG_SUCCESS);
		$propel_params = array('om');
		$this->processPropel($propel_params);	
		$oKzfUnitTest = new KzfUnitTest();
		$this->output("# Generate test unit files for new classes #",parent::$MSG_SUCCESS);
		$oKzfUnitTest->generateFiles($this->classmap);
		$this->output("# Extract Database Model #",parent::$MSG_SUCCESS);
		$output = $oKzfUnitTest->extractDatabaseModel();
		$this->outputShell($output);
		$this->output("# Drop fixtures schema #",parent::$MSG_SUCCESS);
		$output = $oKzfUnitTest->dropFixturesSchema();
		$this->outputShell($output);		
		$this->output("# Create new fixtures schema #",parent::$MSG_SUCCESS);
		$output = $oKzfUnitTest->createNewFixturesSchema();
		$this->outputShell($output);		
		$this->output("# Load schema on database #",parent::$MSG_SUCCESS);		
		$output = $oKzfUnitTest->loadSchemaOnDatabase();
		$this->outputShell($output);
		$this->output("# Build routing of conf/routes.php #",parent::$MSG_SUCCESS);
		$this->processBuildRoutes($argv);
	}
	
	public function processPlayTests($argv) {
		$phpunit_params = array('--colors','-c',KZF_DIR.'test/phpunit.xml','--bootstrap',KZF_DIR.'test/bootstrap.php', KZF_DIR.'test/unit');
		$this->output("# Playing your unit test #",parent::$MSG_SUCCESS);
		$this->processPhpunit($phpunit_params);		
	}
	
	public function processBuildRoutes($argv) {
		$routes = include KZF_DIR.'build/conf/routes.php';
		$dumper = new \Symfony\Component\Routing\Matcher\Dumper\PhpMatcherDumper($routes);
		$this->output("# Building of build/classes/engine/base/BaseKzfUrlMatcher.php #",parent::$MSG_SUCCESS);
		$fp = fopen(KZF_DIR."build/classes/engine/base/BaseKzfUrlMatcher.php", 'w+');
		$search = "<?php";
		$replace = "<?php

namespace Kzf\Engine\Base;

use Symfony as Symfony;";
		$dump = str_replace($search, $replace, $dumper->dump(array('class'=>"BaseKzfUrlMatcher")));
		fwrite($fp, $dump);
		fclose($fp);
	}
	
	public function processBuildAndMigrate($argv) {
		$this->processBuild($argv);
		$propel_params = array('diff');
		$this->output("# Generate diff beetween schema kzf_model and kzf #",parent::$MSG_SUCCESS);
		$this->processPropel($propel_params);	
		$propel_params = array('migrate');
		$this->output("# Migrate the changes on kzf database #",parent::$MSG_SUCCESS);
		$this->processPropel($propel_params);			
		
	}
	
	public function addNamespaceInSchema() {
		$dom = new \DomDocument();
		$dom->load(KZF_DIR.'config/schema.xml');
		$db = $dom->getElementsByTagName('database')->item(0);
		$db->setAttribute("namespace","Kzf\Model");
		$dom->appendChild($db);
		$dom->save(KZF_DIR.'config/schema.xml');
		
	}
}