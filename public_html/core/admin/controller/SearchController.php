<?php
namespace core\admin\controller;

class SearchController extends BaseAdmin{

    protected function inputData(){

        if(!$this->userId) $this->executeBase();

        $text = $this->clearStr($_GET['search']);

        if(!$text) $this->redirect();

        $table = $this->clearStr($_GET['search_table']);

        $this->data = $this->model->search($text, $table);

        $this->template = ADMIN_TEMPLATE . 'show';

        return $this->expansion();

    }

}