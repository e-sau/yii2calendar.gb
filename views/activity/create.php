<?php
$form = \yii\widgets\ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
        'style' => 'width: 50%; margin: 0 auto;'
    ]
]);
$form->action = \yii\helpers\Url::to('submit');
?>
<?= $form->field($model, 'title'); ?>
<?= $form->field($model, 'startDay')->input('date'); ?>
<?= $form->field($model, 'endDay')->input('date'); ?>
<?= $form->field($model, 'body')->textarea(['style' => 'resize: vertical;']); ?>
<?= $form->field($model, 'repeat'); ?>
<?= $form->field($model, 'main')->checkbox(); ?>
<?= $form->field($model, 'files[]')->fileInput(['multiple' => 'multiple'])->label('Добавить файлы'); ?>
<?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-primary']); ?>
<?php
\yii\widgets\ActiveForm::end();
