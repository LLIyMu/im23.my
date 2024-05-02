<?php

namespace core\user\controller;

use core\admin\model\Model;

class IndexController extends BaseUser {
	
	protected function inputData(){

        parent::inputData();

        $sales = $this->model->get('sales', [
            'where' => ['visible' => 1],
            'order' => ['menu_position']
        ]);

        $advantages = $this->model->get('advantages', [
            'where' => ['visible' => 1],
            'order' => ['menu_position'],
            'limit' => 6
        ]);

        $news = $this->model->get('news', [
            'where' => ['visible' => 1],
            'order' => ['date'],
            'limit' => 3,
            'order_direction' => ['DESC']
        ]);

        $arrHits = [
            'hit' => [
                'name' => 'Хиты продаж',
                'icon' => '<svg>
						<use xlink:href="'. PATH .TEMPLATE .'assets/img/icons.svg#hit"></use>
					</svg>'
            ],
            'hot' => [
                'name' => 'Горячее предложение',
                'icon' => '<svg>
						<use xlink:href="'. PATH .TEMPLATE .'assets/img/icons.svg#hot"></use>
					</svg>'
            ],
            'sale' => [
                'name' => 'Распродажа',
                'icon' => '%'
            ],
            'new' => [
                'name' => 'Новинки',
                'icon' => 'new'
            ],
        ];

        $goods = [];

        foreach ($arrHits as $type => $item){

            $goods[$type] = $this->model->getGoods([
                'where' => [$type => 1, 'visible' => 1],
                'limit' => 6
            ]);

        }

        return compact('sales', 'arrHits', 'goods', 'advantages', 'news');

	}
	
}