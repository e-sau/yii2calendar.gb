<?php

namespace app\models;

use app\components\behaviors\ARCacheBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property int $started_at
 * @property int $finished_at
 * @property int $user_id
 * @property string|null $body
 * @property int|null $repeat
 * @property int|null $main
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'started_at', 'user_id'], 'required'],
            [['user_id', 'repeat', 'main'], 'integer'],
            [['started_at', 'finished_at'], 'date'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            ['finished_at', 'default', 'value' => function($model, $attribute) {
                return $model->started_at;
            }],
            [['started_at', 'finished_at'], 'filter', 'filter' => function($value) {
                return strtotime($value);
            }],
            ['finished_at', 'compare', 'compareAttribute' => 'started_at', 'operator' => '>=', 'type' => 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            ARCacheBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
            'body' => 'Body',
            'repeat' => 'Repeat',
            'main' => 'Main',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function findOne($condition)
    {
        $key = is_array($condition) ? serialize($condition) : $condition;

        if (\Yii::$app->cache->exists(self::class . "_" . $key)) {
            return \Yii::$app->cache->get(self::class . "_" . $key);
        } else {
            $result = parent::findOne($condition);
            \Yii::$app->cache->set(self::class . "_" . $key, $result);
            return $result;
        }
    }

    public static function findAll($condition)
    {
        $key = is_array($condition) ? serialize($condition) : $condition;

        if (\Yii::$app->cache->exists(self::class . "_" . $key)) {
            return \Yii::$app->cache->get(self::class . "_" . $key);
        } else {
            $result = parent::findAll($condition);
            \Yii::$app->cache->set(self::class . "_" . $key, $result);
            return $result;
        }
    }
}
