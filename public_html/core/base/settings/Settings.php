<?php
	
namespace core\base\settings;

use core\base\controller\Singleton;

class Settings
{
	
	use Singleton;
	
	private $routes = [
		'admin' => [
			'alias' => 'admin',
			'path' => 'core/admin/controller/',
			'hrUrl' => false
		],
		'settings' => [
			'path' => 'core/base/settings/'
		],
		'plugins' => [
			'path' => 'core/plugins/',
			'hrUrl' => false,
			'dir' => false
		],
		'user' => [
			'path' => 'core/user/controller/',
			'hrUrl' => true,
			'routes' => [
			
			]
		],
		'default' => [
			'controller' => 'IndexController',
			'inputMethod' => 'inputData',
			'outputMethod' => 'outputData'
		],
	];

	private $templateArr = [
		'text' => ['name'],
		'textarea' => ['content', 'keywords'],
		'radio' => ['visible'],
		'select' => ['menu_position', 'parent_id'],
		'checkboxlist' => ['filters'],
		'img' => ['img', 'main_img'],
		'gallery_img' => ['gallery_img']
	];

    private $fileTemplates = ['img', 'gallery_img'];

    private $translate = [
        'name' => ['Название', 'Не более 100 символов'],
        'keywords' => ['Ключевые слова', 'Не более 70 символов'],
    ];
    //разделитель блоков вёрстки
    private $blockSeparator = [
        'left-block' => [],
        'right-block' => ['img','main_img'],
        'content-block' => ['content'],
    ];

	private $manyToMany = [
		'goods_filters' => ['goods', 'filters'] // 'type' => 'child' || 'root'
	];
	
    private $validation = [
        'name' => ['empty' => true, 'trim' => true],
        'price' => ['int' => true],
        'login' => ['empty' => true],
        'password' => ['crypt' => true, 'empty' => true],
        'keywords' => ['count' => 70, 'trim' => true],
        'description' => ['count' => 160, 'trim' => true]
    ];
    //пункты меню
    private $projectTables = [
        'articles' => ['name' => 'Статьи'],
        'pages' => ['name' => 'Страницы'],
        'goods' => ['name' => 'Товары', 'img' => 'pages.png'],
        'filters' => ['name' => 'Фильтры'],
    ];

    private $radio = [
        'visible' => ['Нет', 'Да', 'default' => 'Да']
    ];
    private $rootItems = [
        'name' => 'Корневая',
        'tables' => ['articles', 'filters']
    ];
    private $defaultTable = 'goods';
    private $expansion = 'core/admin/expansion/';
    private $messages = 'core/base/messages/';
    private $formTemplates = PATH . 'core/admin/views/include/formTemplates/';

	public static function get($property){
		return self::instance()->$property;
	}
	
	public function clueProperties($class){
	
		$baseProperties = [];
		
		foreach($this as $name => $item){
			$property = $class::get($name);
			
			if(is_array($property) && is_array($item)){
				$baseProperties[$name] = $this->arrayMergeRecurcive($this->$name, $property);
				continue;
			}
			
			if(!$property){
				$baseProperties[$name] = $this->$name;
			}
		}
		return $baseProperties;
	}
	
	public function arrayMergeRecurcive(){
	
		$arrays = func_get_args();
		
		$base = array_shift($arrays);
		
		foreach($arrays as $array){
		
			foreach($array as $key => $value){
				
				if(is_array($value) && array_key_exists($key, $base) && is_array($base[$key])){
					
					$base[$key] = $this->arrayMergeRecurcive($base[$key], $value);
					
				}else{
				
					if(is_int($key)){
						
						if(!in_array($value, $base)){
							
							array_push($base, $value);
							
						}
						continue;
						
					}
					
					$base[$key] = $value;
				
				}
				
			}
		
		}
		
		return $base;
	
	}

}