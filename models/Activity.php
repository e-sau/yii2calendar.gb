<?php
/**
 * Created by PhpStorm.
 * User: Masya
 * Date: 24.11.2019
 * Time: 22:37
 */

namespace app\models;


use yii\base\Model;

/**
 * Class Activity
 * Сущность события календаря
 */
class Activity extends Model
{
    /**
     * id события
     *
     * @var integer
     */
    public $id;
    /**
     * Название события
     *
     * @var string
     */
    public $title;

    /**
     * День начала события. Хранится в Unix timestamp
     *
     * @var int
     */
    public $startDay;

    /**
     * День завершения события. Хранится в Unix timestamp
     *
     * @var int
     */
    public $endDay;

    /**
     * ID автора, создавшего события
     *
     * @var int
     */
    public $idAuthor;

    /**
     * Описание события
     *
     * @var string
     */
    public $body;

    /**
     * Повтор события
     *
     * @var string | array
     */
    public $repeat;

    /**
     * Основное событие (блокирующее)
     * - не позволяет создать другое событие в этот день
     *
     * @return boolean
     */
    public $main;

    public function attributeLabels()
    {
        return [
          'title' => 'Название события',
          'startDay' => 'Дата начала',
          'endDay' => 'Дата завершения',
          'idAuthor' => 'ID автора',
          'body' => 'Описание события'
        ];
    }

}