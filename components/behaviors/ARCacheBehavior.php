<?php


namespace app\components\behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class ARCacheBehavior extends Behavior
{
    public function events()
    {
        return [
          ActiveRecord::EVENT_AFTER_INSERT => 'deleteCache',
          ActiveRecord::EVENT_AFTER_UPDATE => 'deleteCache',
          ActiveRecord::EVENT_AFTER_DELETE => 'deleteCache'
        ];
    }

    public function deleteCache()
    {
        \Yii::$app->cache->flush();
    }
}