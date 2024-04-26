<?php

namespace core\user\controller;

use core\base\controller\BaseController;
use core\user\model\Model;

abstract class BaseUser extends BaseController
{

    protected $model;

    protected $table;

    protected function inputData(){

        $this->init();

        !$this->model && $this->model = Model::instance();

    }

    protected function outputData()
    {
        
    }

}