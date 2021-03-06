<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'started_at')->widget(\kartik\date\DatePicker::class, [
        'options' => [
            'placeholder' => 'Выберите дату начала события',
            'value' => $model->started_at ? date('d.m.Y', $model->started_at) : null,
        ],
        'pluginOptions' => [
            'format' => 'dd.mm.yyyy',
            'autoclose' => true,
            'todayHighlight' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'finished_at')->widget(\kartik\date\DatePicker::class, [
      'options' => [
        'placeholder' => 'Выберите дату окончания события',
          'value' => $model->started_at ? date('d.m.Y', $model->finished_at) : null,
      ],
      'pluginOptions' => [
        'format' => 'dd.mm.yyyy',
        'autoclose' => true,
        'todayHighlight' => true,
      ]
    ]) ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'repeat')->checkbox() ?>

    <?= $form->field($model, 'main')->checkbox() ?>

    <?php // echo $form->field($model, 'created_at')->textInput() ?>

    <?php // echo $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
