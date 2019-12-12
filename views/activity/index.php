<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'started_at:date',
            'finished_at:date',
            [
                'attribute' => 'author',
                'label' => 'Author',
                'value' => function (\app\models\Activity $model) {
                    return $model->user->username;
                }
            ],
            'body:ntext',
            [
                'attribute' => 'repeat',
                'value' => function ($model) {
                    return $model->repeat ? 'Да' : 'Нет';
                }
            ],
            [
                'attribute' => 'main',
                'value' => function ($model) {
                    return $model->main ? 'Да' : 'Нет';
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
