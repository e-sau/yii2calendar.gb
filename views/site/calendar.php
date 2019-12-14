<?php

/* @var $this yii\web\View */
/* @var $events \edofre\fullcalendar\models\Event */

$this->title = 'Calendar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar">
    <h1><?= \yii\bootstrap\Html::encode($this->title) ?></h1>

    <?= edofre\fullcalendar\Fullcalendar::widget([
        'events' => \yii\helpers\Url::to(['calendar/events', 'id' => uniqid()]),
    ]);
    ?>
</div>

