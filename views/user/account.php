<?php

use yii\helpers\Html;

/* @var $model app\models\User */

$this->title = 'User account';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-account">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('User Profile', ['view', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('User Activities', ['activity/index'], ['class' => 'btn btn-success']) ?>
    </p>


</div>
