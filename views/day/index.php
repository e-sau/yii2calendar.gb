<h1>День: <?=$model->name; ?></h1>

<?php if($model->workday): ?>
    <p>рабочий день</p>
<?php else: ?>
    <p>выходной день</p>
<?php endif; ?>

<h3><?=$model->getAttributeLabel('activities') ?></h3>
<?php if($model->activities): ?>
    <?php foreach ($model->activities as $activity): ?>
    <p>
       <?= $activity ?>
    </p>
    <?php endforeach; ?>
<?php endif; ?>
