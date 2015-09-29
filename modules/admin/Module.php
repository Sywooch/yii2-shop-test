<?php

namespace app\modules\admin;

use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    public $layout = 'main_admin';
    public $controllerNamespace = 'app\modules\admin\controllers';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],//Если сделать RBAC с ролью admin, то достаточно поменять на 'roles' => ['admin']
                    ],
                ],
            ],
        ];
    }
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
