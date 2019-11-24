<?php
/**
 * Created by PhpStorm.
 * User: Masya
 * Date: 24.11.2019
 * Time: 22:31
 */

namespace app\controllers;


use app\models\Activity;
use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionIndex()
    {

//        return "Контроллер активностей";
        $model = new Activity();
        return $this->render('index', [
          'model' => $model
        ]);
    }

    public function actionCreate()
    {
        return "Создание активности";
    }

}