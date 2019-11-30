<?php
/**
 * Created by PhpStorm.
 * User: Masya
 * Date: 24.11.2019
 * Time: 22:57
 */

namespace app\models;


use yii\base\Model;

class Day extends Model
{
    /**
     * id дня
     *
     * @var integer
     */
    public $id;
    /**
     * Название дня
     *
     * @var string
     */
    public $name;

    /**
     * Рабочий или выходной день
     *
     * @var boolean
     */
    public $workday;

    /**
     * Привязанные события
     *
     * @var array
     */
    public $activities;

    public function attributeLabels()
    {
        return [
          'name' => 'День недели',
          'workday' => 'Рабочий день',
          'activities' => 'События дня',
        ];
    }
}