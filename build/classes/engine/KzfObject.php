<?php

namespace Kzf\Engine;

class KzfObject
{
	/* CUD : Create Update or Delete an object */
	public static function CUDObject($aData, $class){
		$classPeer = $class."Peer";
		$aResponse = array();
		$con = \Propel::getConnection($classPeer::DATABASE_NAME);
		$con->beginTransaction();
		try {			
			if (!class_exists($class)) {
				throw new \Exception("Class ".$class." doesn't exist");
			}
	
			if (!array_key_exists('action', $aData)) {
				throw new \Exception("You have to define what action you want to execute");
			}
			
			switch ($aData['action']) {
				case 'create':
					$object = new $class();
					foreach ($aData as $key => $value) {
						$method_name = "set".self::convertFieldToCamelCase($key);
						if (method_exists($object, $method_name)) {
							$object->$method_name($value);
						}
					}
					$object->save();
					$aResponse['message'] = "Object ".$class." correctly created";
					break;
				case 'update':
					if (!array_key_exists('id', $aData) || !is_int($aData['id'])) {
						throw new \Exception("You have to define attribute 'id' to update object ".$class);
					}
					$classQuery = $class."Query";
					$object = $classQuery::create()->findPk($aData['id']);
					if(!is_object($object)) {
						throw new \Exception("Id [".$aData['id']."] doesn't exist for a ".$class." object");
					}
					foreach ($aData as $key => $value) {
						$method_name = "set".self::convertFieldToCamelCase($key);
						if (method_exists($object, $method_name)) {
							$object->$method_name($value);
						} else {
							$method_name = "process".self::convertFieldToCamelCase($key);
							if (method_exists($object, $method_name)) {
								$object->$method_name($value);
							}
						}
					}
					$object->save();
					$aResponse['message'] = "Object ".$class." with id ".$id." correctly updated";
					break;			
				case 'delete':
					if (!array_key_exists('id', $aData) || !is_int($aData['id'])) {
						throw new \Exception("You have to define attribute 'id' to delete object ".$class);
					}				
					$classQuery = $class."Query";
					$object = $classQuery::create()->findPk($aData['id']);
					if(!is_object($object)) {
						throw new \Exception("Id [".$aData['id']."] doesn't exist for a ".$class." object");
					}				
					$object->delete();			
					$aResponse['message'] = "Object ".$class." with id ".$id." correctly removed";
					break;				
			}
			$aResponse['type'] = "Success";
			$con->commit();
		} catch (\Exception $e) {
			$con->rollback();
			$aResponse['type']    = "Error";
			$aResponse['message'] = $e->getMessage();
		}
		
		return json_encode($aResponse);
		
	}
	
	public static function convertFieldToCamelCase($string){
		$string = str_replace('_', ' ', $string);
		$string = ucwords($string);
		return str_replace(' ', '', $string);
	}
}