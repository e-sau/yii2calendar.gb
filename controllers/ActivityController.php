<?php
/**
 * Created by PhpStorm.
 * User: Masya
 * Date: 24.11.2019
 * Time: 22:31
 */

namespace app\controllers;


use app\models\Activity;
use app\models\ActivityForm;
use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionIndex()
    {
        $model = new Activity();
        return $this->render('index', [
          'model' => $model
        ]);
    }

    public function actionCreate()
    {
        return $this->render('create', ['model' => new ActivityForm()]);
    }

    public function actionUpdate()
    {
        return "Редактирование активности";
    }

    public function actionSubmit()
    {
        $model = new ActivityForm();

        if (\Yii::$app->request->isPost) {
            $model->save();
        }

        $errors = $model->getErrors();

        return $errors ? $this->render('submit', ['errors' => $errors]) :
            $this->render('submit', ['model' => $model]);
    }
}
























