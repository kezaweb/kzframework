<?php
abstract class Generic_Tests_DatabaseTestCase extends PHPUnit_Extensions_Database_TestCase
{
	// instancie pdo seulement une fois pour le nettoyage du test/le chargement de la fixture
	static private $pdo = null;

	// instancie PHPUnit_Extensions_Database_DB_IDatabaseConnection seulement une fois par test
	private $conn = null;

	final public function getConnection()
	{
		if ($this->conn === null) {
			if (self::$pdo == null) {
				self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
			}
			$this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
			Propel::init(KZF_DIR."build/conf/kzf-unit-test-conf.php");
		}

		return $this->conn;
	}
}