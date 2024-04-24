<?php

namespace core\admin\controller;

use core\base\controller\BaseController;
use core\base\model\UserModel;
use core\base\settings\Settings;

class LoginController extends BaseController
{

    protected $model;

    protected function inputData(){

        $this->model = UserModel::instance();

        $this->model->setAdmin();

        if (isset($this->parameters['logout'])){

            $this->checkAuth(true);

            $userLog = 'Выход пользователя ' . $this->userId['name'];

            $this->writeLog($userLog, 'user_log.txt');

            $this->model->logOut();

            $this->redirect(PATH);

        }



        $timeClean = (new \DateTime())->modify('-' . BLOCK_TIME . ' hour')->format('Y-m-d H:i:s');

        $this->model->delete($this->model->getBlockedTable(), [
            'where' => ['time' => $timeClean],
            'operand' => ['<']
        ]);

        if ($this->isPost()){

            if (empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
                exit('Куку ошибка');
            }

            $userIp = filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP) ?:
                (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP) ?: @$_SERVER['REMOTE_ADDR']);

            $trying = $this->model->get($this->model->getBlockedTable(), [
                'fields' => ['trying'],
                'where' => ['ip' => $userIp]
            ]);

            $trying = !empty($trying) ? $this->clearNum($trying['0']['trying']) : 0;

            $success = 0;

            if (!empty($_POST['login']) && !empty($_POST['password']) && $trying < 3){



            }elseif ($trying >= 3){
                $error = 'Превышено максимальное количество попыток ввода пароля - ' . $userIp;
            }else{
                $error = 'Заполните обязательные поля';
            }

        }

        return $this->render('', ['adminPath' => Settings::get('routes')['admin']['alias']]);

    }

}