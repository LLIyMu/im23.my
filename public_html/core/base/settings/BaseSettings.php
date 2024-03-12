<?php
	
namespace core\base\settings;

use core\base\controller\Singleton;

trait BaseSettings
{
	
	use Singleton {
		instance as SingletonInstance;
	}
	
	private $baseSettings;
	
	public static function get($property) {
		$instance = self::instance();
		
		if (property_exists($instance, $property)) {
			
			if (is_array($instance->$property)) {
				return $instance->$property;
			}
			return $instance->$property;
		}
		return null;
	}
	
	public static function instance(){
		if(self::$_instance instanceof self){
			return self::$_instance;
		}
		
		self::SingletonInstance()->baseSettings = Settings::instance();
		
		$baseProperties = self::$_instance->baseSettings->clueProperties(get_class());
		
		self::$_instance->setProperty($baseProperties);
		
		return  self::$_instance;
	}
	
	protected function setProperty($properties){
		
		if($properties){
			
			foreach($properties as $name => $property){
				
				$this->$name = $property;
				
			}
			
		}
		
	}
	
}