<?php
/**
 * Created by PhpStorm.
 * User: Masya
 * Date: 04.12.2019
 * Time: 20:01
 */

namespace app\commands;


use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * php yii rbac/init
     * @throws \Exception
     */
    public function actionInit()
    {
        $role = \Yii::$app->authManager->createRole('admin');
        $role->description = 'admin';
        \Yii::$app->authManager->add($role);

        $role = \Yii::$app->authManager->createRole('simple');
        $role->description = 'Simple User';
        \Yii::$app->authManager->add($role);
    }
}