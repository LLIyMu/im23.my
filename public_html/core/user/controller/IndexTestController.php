<?php

namespace core\user\controller;

class IndexTestController extends BaseUser
{

    protected function inputData()
    {
        parent::inputData();
        echo $this->getController();
        exit;

    }

}