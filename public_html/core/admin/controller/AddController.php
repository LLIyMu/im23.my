<?php

namespace core\admin\controller;

class AddController extends BaseAdmin{

    protected $action = 'add';
    protected function inputData(){

        if (!$this->userId) $this->executeBase();

        $this->checkPost();

        $this->createTableData();

        $this->createForeignData();

        $this->createMenuPosition();

        $this->createRadio();

        $this->createOutputData();
		
		$this->createManyToMany();

        return $this->expansion();

    }



}