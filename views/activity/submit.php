<?php if ($errors): ?>
    <?= \yii\helpers\Html::tag('h3', 'При отправке формы возникли следующие ошибки:') ?>
    <ul>
    <?php foreach ($errors as $field_errors) : ?>
        <?php foreach ($field_errors as $error) : ?>
            <li><?= \yii\helpers\Html::encode($error) ?></li>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <?= \yii\helpers\Html::tag('h3', 'Форма отправлена') ?>
    <p><strong>Название события: </strong><?= \yii\helpers\Html::encode($model->title); ?></p>
    <p><strong>Дата начала: </strong><?= \yii\helpers\Html::encode($model->startDay); ?></p>
    <p><strong>Дата завершения: </strong><?= \yii\helpers\Html::encode($model->endDay); ?></p>
    <p><strong>Описание события: </strong><?= \yii\helpers\Html::encode($model->body); ?></p>
    <p><strong>Повтор: </strong><?= \yii\helpers\Html::encode($model->repeat) ?: 'нет'; ?></p>
    <p><strong>Весь день: </strong><?= \yii\helpers\Html::encode($model->main) ? 'да' : 'нет'; ?></p>
    <p><strong>Файлы: </strong></p>
    <?php foreach ($model->files as $file) : ?>
        <p style="margin: -5px 0 15px 15px;"><?= \yii\helpers\Html::encode($file) ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<?= \yii\helpers\Html::a('Создать новое событие', \yii\helpers\Url::to('create'), ['class' => 'btn btn-primary']) ?>
