<?php
	
namespace core\base\settings;

use core\base\controller\Singleton;

class Settings{
	
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

    //пункты меню админ панели
    private $projectTables = [
        'catalog' => ['name' => 'Каталог'],
        'goods' => ['name' => 'Товары', 'img' => 'pages.png'],
        'filters' => ['name' => 'Фильтры'],
        'articles' => ['name' => 'Статьи'],
        'sales' => ['name' => 'Акции'],
        'pages' => ['name' => 'Страницы'],

        'information' => ['name' => 'Информация'],
        'socials' => ['name' => 'Социальные сети'],
        'settings' => ['name' => 'Настройки системы'],

    ];

    private $templateArr = [
        'text' => ['name', 'phone', 'email', 'alias', 'external_alias', 'sub_title', 'number_of_years', 'price', 'discount'],
        'textarea' => ['content', 'keywords', 'address', 'description', 'short_content'],
        'radio' => ['visible', 'show_top_menu', 'hit', 'sale', 'new', 'hot'],
        'select' => ['menu_position', 'parent_id'],
        'checkboxlist' => ['filters'],
        'img' => ['img', 'main_img', 'img_years'],
        'gallery_img' => ['gallery_img'],

    ];

    private $fileTemplates = ['img', 'gallery_img'];

    private $translate = [
        'name' => ['Название', 'Не более 100 символов'],
        'keywords' => ['Ключевые слова', 'Не более 70 символов'],
	    'content' => ['Описание'],
	    'description' => ['SEO описание'],
	    'phone' => ['Телефон'],
	    'email' => ['Email'],
	    'address' => ['Адрес'],
        'alias' => ['Ссылка ЧПУ'],
        'show_top_menu' => ['Показывать в верхнем меню'],
        'external_alias' => ['Внешняя ссылка'],
        'img' => ['Изображение'],
        'gallery_img' => ['Галерея изображений'],
        'visible' => ['Показывать на сайте'],
        'menu_position' => ['Позиция в меню'],
        'sub_title' => ['Подзаголовок'],
        'short_content' => ['Краткое описание'],
        'img_years' => ['Изображение количества лет на рынке'],
        'number_of_years' => ['Количество лет на рынке'],
        'price' => ['Цена'],
        'hit' => ['Хит продаж'],
        'sale' => ['Акция'],
        'new' => ['Новинка'],
        'hot' => ['Горячее предложение'],
        'discount' => ['Скидка']

    ];
    //разделитель блоков вёрстки
    private $blockSeparator = [
        'left-block' => [],
        'right-block' => ['img','main_img','img_years','number_of_years'],
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

    private $radio = [
        'visible' => ['Нет', 'Да', 'default' => 'Да'],
        'show_top_menu' => ['Нет', 'Да', 'default' => 'Да'],
        'hit' => ['Нет', 'Да', 'default' => 'Нет'],
        'sale' => ['Нет', 'Да', 'default' => 'Нет'],
        'new' => ['Нет', 'Да', 'default' => 'Нет'],
        'hot' => ['Нет', 'Да', 'default' => 'Нет'],
    ];
    private $rootItems = [
        'name' => 'Корневая',
        'tables' => ['articles', 'filters', 'catalog']
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