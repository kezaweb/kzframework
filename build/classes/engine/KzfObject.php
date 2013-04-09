<?php

namespace Kzf\Engine;

class KzfObject
{
	/* CUD : Create Update or Delete an object */
	public static function CRUDObject($aData, $class){
		$classPeer = $class."Peer";
		$aResponse = array();
		$con = \Propel::getConnection($classPeer::DATABASE_NAME);
		$con->beginTransaction();
		$bReponseJsonForced = false;
		try {			
			if (!class_exists($class)) {
				throw new \Exception("Class ".$class." doesn't exist");
			}
	
			if (!array_key_exists('action', $aData)) {
				throw new \Exception("You have to define what action you want to execute");
			}
			
			switch ($aData['action']) {
				case 'create':
					$oObject = new $class();
					foreach ($aData as $key => $value) {
						$method_name = "set".self::convertFieldToCamelCase($key);
						if (method_exists($oObject, $method_name)) {
							$oObject->$method_name($value);
						}
					}
					$oObject->save();
					$aResponse['message'] = "Object ".$class." correctly created";					
					break;
				case 'read':
					if (array_key_exists('crud_from', $aData) && !method_exists($class, 'setCrudFrom')) {
						throw new \Exception("We want to affect crud_from attribute in your object [".$class."] but is not possible");
					}
					$classQuery = $class."Query";
					if (array_key_exists('id', $aData)) {
						$oObject = $classQuery::create()->findPk($aData['id']);
					} else {
						$oObject = new $class();
					}
					
					if (!is_object($oObject)) {
						throw new \Exception("Object [".$class."] with id [".$aData['id']."] doesn't exist.");
					}

					foreach ($aData as $key => $value) {
						$method_name = "set".self::convertFieldToCamelCase($key);
						if (method_exists($oObject, $method_name)) {
							$oObject->$method_name($value);
						} else {
							$method_name = "process".self::convertFieldToCamelCase($key);
							if (method_exists($oObject, $method_name)) {
								$oObject->$method_name($value);
							}
						}
					}
					
					if (!method_exists($class, 'setAction')) {
						throw new \Exception("You must to define a method setAction in your class [".$class."]");
					}
					
					$oObject->setAction('read');
					break;
				case 'update':
					if (!array_key_exists('id', $aData) || !is_int($aData['id'])) {
						throw new \Exception("You have to define attribute 'id' to update object ".$class);
					}
					$classQuery = $class."Query";
					$oObject = $classQuery::create()->findPk($aData['id']);
					if(!is_object($oObject)) {
						throw new \Exception("Id [".$aData['id']."] doesn't exist for a ".$class." object");
					}
					foreach ($aData as $key => $value) {
						$method_name = "set".self::convertFieldToCamelCase($key);
						if (method_exists($oObject, $method_name)) {
							$oObject->$method_name($value);
						} else {
							$method_name = "process".self::convertFieldToCamelCase($key);
							if (method_exists($oObject, $method_name)) {
								$oObject->$method_name($value);
							}
						}
					}
					$oObject->save();
					$aResponse['message'] = "Object ".$class." with id ".$aData['id']." correctly updated";
					break;			
				case 'delete':
					if (!array_key_exists('id', $aData) || !is_int($aData['id'])) {
						throw new \Exception("You have to define attribute 'id' to delete object ".$class);
					}				
					$classQuery = $class."Query";
					$oObject = $classQuery::create()->findPk($aData['id']);
					if(!is_object($oObject)) {
						throw new \Exception("Id [".$aData['id']."] doesn't exist for a ".$class." object");
					}				
					$oObject->delete();			
					$aResponse['message'] = "Object ".$class." with id ".$id." correctly removed";
					break;				
			}
			$aResponse['type'] = "Success";
			if (method_exists($oObject, "getDataResponse")) {
				$aResponse['data_response'] = $oObject->getDataResponse();
			}
			
			$con->commit();
		} catch (\Exception $e) {
			$con->rollback();
			$aResponse['type']    = "Error";
			$aResponse['message'] = $e->getMessage();
		}
		
		// Controle standard Kzf
		try 
		{
			self::controleStandardClassKzf($class);
		} catch (\Exception $e) {
			$aResponse['type']    = "Error";
			$aResponse['message'] = $e->getMessage();
			$bReponseJsonForced   = true;
		}

		if (!isset($oObject) || !is_object($oObject) || $bReponseJsonForced) {
			return json_encode($aResponse);
		}
		
		$oObject->addAJsonResponse($aResponse);
		return $oObject;
		
	}
	
	protected static function controleStandardClassKzf($class) {
		// Exception if we don't respect standard of Kzf
		if (!method_exists($class, 'addAJsonResponse')) {
			$bReponseJsonForced = true;
			throw new \Exception("Your object haven't got method addAJsonResponse. You have to create it");
		}
		
		if (!method_exists($class, 'getFormat')) {
			$bReponseJsonForced = true;
			throw new \Exception("Your object haven't got method getFormat. You have to create it");
		}
			
		if (!method_exists($class, 'getRenderTemplate')) {
			$bReponseJsonForced = true;
			throw new \Exception("Your object haven't got method getRenderTemplate. You have to create it");
		}
			
		if (!method_exists($class, 'getJsonResponse')) {
			$bReponseJsonForced = true;
			throw new \Exception("Your object haven't got method getJsonResponse. You have to create it");
		}
		
		if (!method_exists($class, 'hasInternalError')) {
			$bReponseJsonForced = true;
			throw new \Exception("Your object haven't got method hasInternalError. You have to create it");
		}
	}
	
	
	/* $aData contains the id of the object, and for few object, an attribute CrudFrom ( if templating si different according place in the application )*/
	public static function findByData($aData, $class) {
		if (!array_key_exists('id', $aData)) {
			throw new \Exception("We can't hydrate your object [".$class."] without here id");
		}
		if (array_key_exists('crud_from', $aData) && !method_exists($class, 'setCrudFrom')) {
			throw new \Exception("We want to affect crud_from attribute in your object [".$class."] but is not possible");
		}
		$classQuery = $class."Query";
		$oObject = $classQuery::create()->findPk($aData['id']);
		if (!is_object($oObject)) {
			throw new \Exception("Object [".$class."] with id [".$aData['id']."] doesn't exist.");
		}
		
		if (array_key_exists('crud_from', $aData)) {
			$oObject->setCrudFrom($aData['crud_from']);
		}
		
		if (!method_exists($class, 'setAction')) {
			throw new \Exception("You must to define a method setAction in your class [".$class."]");
		}
		
		$oObject->setAction('read');
		
		
		return $oObject;
	}	
	
	public static function convertFieldToCamelCase($string){
		$string = str_replace('_', ' ', $string);
		$string = ucwords($string);
		return str_replace(' ', '', $string);
	}
}