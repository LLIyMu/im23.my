<?php
	
namespace core\base\settings;

use core\base\controller\Singleton;

class ShopSettings
{
	use BaseSettings;
	private $routes = [
		'plugins' => [
			'dir' => false,
			'routes' => [
			
			]
		],
	];
	private $templateArr = [
		'text' => ['price', 'about_us'],
		'textarea' => ['goods_content'],
	];

    private $expansion = 'core/plugin/expansion/';

    

}