<?php
/**
 * Created by PhpStorm.
 * User: Masya
 * Date: 24.11.2019
 * Time: 23:03
 */

namespace app\controllers;


use app\models\Day;
use yii\web\Controller;

class DayController extends Controller
{
    public function actionIndex()
    {
//        return 'Контроллер дней';
        $model = new Day();
        return $this->render('index', [
          'model' => $model
        ]);
    }
}