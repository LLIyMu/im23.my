<?php

namespace core\admin\controller;

use core\base\settings\Settings;

class ShowController extends BaseAdmin
{

    protected function inputData()
    {
        if (!$this->userId) $this->executeBase();

        $this->createTableData();

        $this->createData();

        return $this->expansion();

    }
	
	protected function createData($arr = []){
		
		$fields = [];
		$order = [];
		$order_direction = [];
	
		
		if (!$this->columns['id_row']) return $this->data = [];
		
		$fields[] = $this->columns['id_row'] . ' as id';
		
		if (isset($this->columns['name'])) $fields['name'] = 'name';
		if (isset($this->columns['img'])) $fields['img'] = 'img';
		
		if (count($fields) < 3){
			foreach ($this->columns as $name => $value){
				if (!isset($fields['name']) && strpos($name, 'name') !== false){
					$fields['name'] = $name . ' as name';
				}
				if (!isset($fields['img']) && strpos($name, 'img') === 0){
					$fields['img'] = $name . ' as img';
				}
			}
		}
		
		if (isset($arr['fields'])){
			if (is_array($arr['fields'])){
				$fields = Settings::instance()->arrayMergeRecurcive($fields, $arr['fields']);
			}else{
				$fields[] = $arr['fields'];
			}
			
		}
		
		if (isset($this->columns['parent_id'])){
			if (!in_array('parent_id', $fields)) {
				$fields[] = 'parent_id';
			}
			$order[] = 'parent_id';
		}
		
		if (isset($this->columns['menu_position'])) {
			$order[] = 'menu_position';
		}elseif (isset($this->columns['date'])){
			if ($order) $order_direction = ['ASC', 'DESC'];
			else $order_direction[] = 'DESC';
			
			$order[] = 'date';
		}
		
		if (isset($arr['order'])){
			if (is_array($arr['order'])){
				$order = Settings::instance()->arrayMergeRecurcive($order, $arr['order']);
			}else{
				$order[] = $arr['order'];
			}
		}
		if (isset($arr['order_direction'])){
			if (is_array($arr['order'])){
				$order_direction = Settings::instance()->arrayMergeRecurcive($order_direction, $arr['order_direction']);
			}else{
				$order_direction[] = $arr['order_direction'];
			}
		}
		
		$this->data = $this->model->get($this->table, [
			'fields' => $fields,
			'order' => $order,
			'order_direction' => $order_direction
		]);
		
	}

}