<?php

defined('ACCESS') or die('Access denied');

const MS_MODE = false; //определение браузера
const TEMPLATE = 'templates/default/';
const ADMIN_TEMPLATE = 'core/admin/views/';

const UPLOAD_DIR = 'userfiles/';

const COOKIE_VERSION = '1.0.0';
const COOKIE_TIME = 60;
const CRYPT_KEY = 'SDF*9879790SDDFsdf098098*&&^$%&^sdfsddsfsfDSFSF-SDF*9879790SDDFsdf098098*&&^$%&^sdfsddsfsfDSFSF-1';
const BLOCK_TIME = 3;

const QTY = 8;
const QTY_LINKS = 3;

const ADMIN_CSS_JS = [
	'styles' => ['css/main.css'],
	'scripts' => [
        'js/framework_functions.js',
        'js/scripts.js',
        'js/tinymce/tinymce.min.js',
        'js/tinymce/tinymce_init.js',
        ]
];
const USER_CSS_JS = [
	'styles' => ['css/style.css'],
	'scripts' => ['js/script.js']
];

use core\base\exceptions\RouteException;

function autoloadMainClasses($class_name){

	$class_name = str_replace('\\', '/', $class_name);
	
	if(!@include_once $class_name . '.php'){
		throw new RouteException('Не верное имя файла - ' . $class_name .' для подключения');
	}

}

spl_autoload_register('autoloadMainClasses');

