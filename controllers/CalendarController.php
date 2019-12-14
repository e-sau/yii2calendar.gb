<?php

namespace app\controllers;

use app\models\search\ActivitySearch;
use Yii;
use edofre\fullcalendar\models\Event;
use yii\helpers\Url;
use yii\web\Controller;

class CalendarController extends Controller
{
    public function actionEvents($id, $start, $end)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $events = [];
        $activities = (new ActivitySearch())->search(['start' => $start, 'end' => $end]);

        foreach ($activities->models as $activity) {
            $events[] = new Event([
                'id' => uniqid(),
                'title' => $activity->title,
                'start' => Yii::$app->formatter->asDate($activity->started_at, 'php:c'),
                'end' => Yii::$app->formatter->asDate($activity->finished_at, 'php:c'),
                'allDay' => $activity->main,
                'url' => Url::to(['activity/view', 'id' => $activity->id]),
            ]);
        }

        return $events;
    }
}